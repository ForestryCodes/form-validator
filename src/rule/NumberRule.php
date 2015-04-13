<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\RuleInterface;

class NumberRule implements RuleInterface
{
    private $defaultMessage = 'value is not a valid number';

    /**
     * Validates if the value is valid email address.
     *
     * @param mixed $value
     * @return boolean
     */
    public function validate($value)
    {
        return (bool)preg_match('/^-?\d+(\.\d+)?$/', $value);
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