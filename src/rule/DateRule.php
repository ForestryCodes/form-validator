<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\MessageTrait;
use Forestry\FormValidator\ParameterRuleInterface;

class DateRule implements ParameterRuleInterface
{
    use MessageTrait;
    private $defaultFormat = 'Y-m-d';

    /**
     * Set default message for this rule.
     */
    public function __construct()
    {
        $this->defaultMessage = 'value is not a valid date';
    }

    /**
     * Validates if the value is a valid date and/or time value.
     *
     * @param mixed $value
     * @param mixed $format
     * @return boolean
     */
    public function validate($value, $format = null)
    {
        if (is_null($format)) {
            $format = $this->defaultFormat;
        }
        $date = \DateTime::createFromFormat($format, $value);
        $warnings = \DateTime::getLastErrors()['warning_count'];
        $errors = \DateTime::getLastErrors()['error_count'];

        return $date && 0 == $warnings && 0 == $errors;
    }
}
