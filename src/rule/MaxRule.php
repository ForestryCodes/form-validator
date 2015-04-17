<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\MessageTrait;
use Forestry\FormValidator\ParameterRuleInterface;

class MaxRule implements ParameterRuleInterface
{
    use MessageTrait;

    /**
     * Set default message for this rule.
     */
    public function __construct()
    {
        $this->defaultMessage = 'value to long';
    }

    /**
     * Validates if the value is within the maximum length.
     *
     * @param mixed $value
     * @param integer $length
     * @return boolean
     */
    public function validate($value, $length)
    {
        return ($length >= strlen(trim($value)));
    }
}
