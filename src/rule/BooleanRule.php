<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\RuleInterface;

class BooleanRule implements RuleInterface
{
    private $defaultMessage = 'value is not set';

    /**
     * Validates if the value is boolean.
     *
     * @param mixed $value
     * @return boolean
     */
    public function validate($value)
    {
        return filter_var($value, \FILTER_VALIDATE_BOOLEAN);
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
