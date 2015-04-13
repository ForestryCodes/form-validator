<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\RuleInterface;

class AlphanumRule implements RuleInterface
{
    private $defaultMessage = 'value is not a valid alphanumerical value';

    /**
     * Validates if the value is valid alphanumerical value.
     *
     * @param mixed $value
     * @return boolean
     */
    public function validate($value)
    {
        return (bool)preg_match('/^[\pL\pN \.-]+$/', $value);
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