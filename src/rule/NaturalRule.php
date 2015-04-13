<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\SimpleRuleInterface;

class NaturalRule implements SimpleRuleInterface
{
    private $defaultMessage = 'value is not a valid natural number';

    /**
     * Validates if the value is valid email address.
     *
     * @param mixed $value
     * @return boolean
     */
    public function validate($value)
    {
        return (bool)preg_match('/^\d+$/', $value);
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
