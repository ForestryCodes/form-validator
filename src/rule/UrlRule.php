<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\SimpleRuleInterface;

class UrlRule implements SimpleRuleInterface
{
    private $defaultMessage = 'value is not a valid URL';

    /**
     * Validates if the value is valid URL.
     *
     * @param mixed $value
     * @return boolean
     */
    public function validate($value)
    {
        return (bool)filter_var($value, \FILTER_VALIDATE_URL);
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
