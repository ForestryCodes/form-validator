<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\SimpleRuleInterface;

class PhoneRule implements SimpleRuleInterface
{
    private $defaultMessage = 'value is not a valid phone number';

    /**
     * Validates if the value is boolean.
     *
     * @param mixed $value
     * @return boolean
     */
    public function validate($value)
    {
        return (bool)preg_match('/^(\+|\()?(\d+[ \+\(\)\/-]*)+$/', $value);
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
