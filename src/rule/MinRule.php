<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\ParameterRuleInterface;

class MinRule implements ParameterRuleInterface
{
    private $defaultMessage = 'value to short';

    /**
     * Validates if the value is valid alphanumerical value.
     *
     * @param mixed $value
     * @param integer $length
     * @return boolean
     */
    public function validate($value, $length)
    {
        return ($length <= strlen(trim($value)));
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
