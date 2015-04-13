<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\RuleInterface;

class RequiredRule implements RuleInterface
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
        return !(empty($value) && !is_numeric($value));
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
