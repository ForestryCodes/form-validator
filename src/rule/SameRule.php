<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\MessageTrait;
use Forestry\FormValidator\ParameterRuleInterface;

class SameRule implements ParameterRuleInterface
{
    use MessageTrait;

    /**
     * Set default message for this rule.
     */
    public function __construct()
    {
        $this->defaultMessage = 'values are not the same';
    }

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
}
