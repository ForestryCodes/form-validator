<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\ParameterRuleInterface;

class DateRule implements ParameterRuleInterface
{
    private $defaultFormat = 'Y-m-d';
    private $defaultMessage = 'value is not a valid date';

    /**
     * Validates if the value is valid alphanumerical value.
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

    /**
     * Gets the error message for this rule.
     *
     * @param mixed $customMessage
     * @return string
     */
    public function getMessage($customMessage = null)
    {
        if (!empty($customMessage)) {
            $message = $customMessage;
        } else {
            $message = $this->defaultMessage;
        }

        return $message;
    }
}
