<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\ParameterRuleInterface;

class SameRule implements ParameterRuleInterface
{
    private $defaultMessage = 'values are not the same';

    /**
     * Validates if two values are equal.
     *
     * @param mixed $value
     * @param mixed $compareValue
     * @return boolean
     */
    public function validate($value, $compareValue)
    {
        return ($value == $compareValue);
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
