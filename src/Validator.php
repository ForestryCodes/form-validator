<?php

namespace Forestry\FormValidator;

class Validator
{
    /**
     * List of standard rules delivered with the library.
     *
     * @var array
     */
    private $builtinRules = [
        'alpha' => 'Forestry\FormValidator\Rule\AlphaRule',
        'alphanum' => 'Forestry\FormValidator\Rule\AlphanumRule',
        'boolean' => 'Forestry\FormValidator\Rule\BooleanRule',
        'date' => 'Forestry\FormValidator\Rule\DateRule',
        'email' => 'Forestry\FormValidator\Rule\EmailRule',
        'float' => 'Forestry\FormValidator\Rule\FloatRule',
        'integer' => 'Forestry\FormValidator\Rule\IntegerRule',
        'ip' => 'Forestry\FormValidator\Rule\IpRule',
        'max' => 'Forestry\FormValidator\Rule\MaxRule',
        'min' => 'Forestry\FormValidator\Rule\MinRule',
        'natural' => 'Forestry\FormValidator\Rule\NaturalRule',
        'number' => 'Forestry\FormValidator\Rule\NumberRule',
        'phone' => 'Forestry\FormValidator\Rule\PhoneRule',
        'required' => 'Forestry\FormValidator\Rule\RequiredRule',
        'same' => 'Forestry\FormValidator\Rule\SameRule',
        'url' => 'Forestry\FormValidator\Rule\UrlRule'
    ];

    /**
     * List of registered rules.
     *
     * @var array
     */
    private $registeredRules = [];

    /**
     * Errors of the last validation run.
     *
     * @var array
     */
    private static $errors = [];

    /**
     * @var Validator
     */
    private static $instance;

    /**
     * Constructor
     *
     * Registers the built-in rules.
     */
    public function __construct()
    {
        foreach ($this->builtinRules as $rule => $class) {
            $this->registerRule($rule, $class);
        }

        static::$instance = $this;
    }

    /**
     * Registers a rule with it's name and the class with full namespace.
     *
     * @param string $key
     * @param string $class
     * @return bool
     * @throws \Exception
     */
    public function registerRule($key, $class)
    {
        if (isset($this->registeredRules[$key])) {
            throw new \Exception('rule already registered');
        }

        $this->updateRule($key, $class);

        return true;
    }

    /**
     * Updates an already registered rule.
     *
     * @param string $key
     * @param string $class
     *
     * @return bool
     * @throws \Exception
     */
    public function updateRule($key, $class)
    {
        if (!in_array('Forestry\FormValidator\RuleInterface', class_implements($class))) {
            throw new \Exception('rule must implement a RuleInterface');
        }
        $this->registeredRules[$key] = $class;

        return true;
    }

    /**
     * Check if validation revealed any errors.
     *
     * @return bool
     */
    public function hasErrors()
    {
        return !empty(static::$errors);
    }

    /**
     * Runs validation against given ruleset.
     *
     * @param array $data
     * @param array $ruleset
     * @return $this
     */
    public function validate(array $data, array $ruleset)
    {
        foreach ($ruleset as $field => $rules) {
            $value = null;
            if (array_key_exists($field, $data)) {
                $value = $data[$field];
            }

            $rules = explode('|', $rules);
            foreach ($rules as $rule) {
                // Extract custom message and parameter for field.
                list($rule, $customMessage) = $this->extractRulePartial($rule, '--');
                list($rule, $parameter) = $this->extractRulePartial($rule, ':');

                $ruleObject = new $this->registeredRules[$rule]();
                // Handle special rules first.
                if ('required' == $rule) {
                    $result = $ruleObject->validate($value);
                } elseif ('same' == $rule) {
                    $result = $ruleObject->validate($value, $data[$parameter]);
                } elseif ($ruleObject instanceof \Forestry\FormValidator\ParameterRuleInterface
                    && !(empty($value) && !is_numeric($value))) {
                    $result = $ruleObject->validate($value, $parameter);
                } elseif ($ruleObject instanceof \Forestry\FormValidator\SimpleRuleInterface
                    && !(empty($value) && !is_numeric($value))) {
                    $result = $ruleObject->validate($value);
                }

                if (!$result) {
                    static::$errors[$field] = $ruleObject->getMessage($customMessage);
                }
            }
        }

        return $this;
    }

    /**
     * Get array with all error messages.
     *
     * @return array
     */
    public function getErrors()
    {
        return self::$errors;
    }

    public static function error($field, $format = null)
    {
        $return = false;

        if (isset(self::$errors[$field])) {
            $message = self::$errors[$field];
            if (!is_null($format)) {
                $message = str_ireplace('{message}', $message, $format);
            }

            $return = $message;
        }

        return $return;
    }

    /**
     * Extracts a part of the rule string such as a parameter or custom message.
     *
     * @param string $rule
     * @param string $separator
     * @return array
     */
    private function extractRulePartial($rule, $separator) {
        $return = [$rule, null];
        if (false !== strpos($rule, $separator)) {
            $return = explode($separator, $rule, 2);
        }

        return $return;
    }
}
