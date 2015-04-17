<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\MessageTrait;
use Forestry\FormValidator\SimpleRuleInterface;

class IntegerRule implements SimpleRuleInterface
{
    use MessageTrait;

    /**
     * Set default message for this rule.
     */
    public function __construct()
    {
        $this->defaultMessage = 'value is not a valid integer';
    }

    /**
     * Validates if the value is an integer value.
     *
     * @param mixed $value
     * @return boolean
     */
    public function validate($value)
    {
        return (bool)filter_var($value, \FILTER_VALIDATE_INT);
    }
}
