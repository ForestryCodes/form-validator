<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\SimpleRuleInterface;

class EmailRule implements SimpleRuleInterface
{
    private $defaultMessage = 'value is not a valid email';

    /**
     * Validates if the value is valid email address.
     *
     * @param mixed $value
     * @return boolean
     */
    public function validate($value)
    {
        return (bool)filter_var($value, \FILTER_VALIDATE_EMAIL);
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
