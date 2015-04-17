<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\MessageTrait;
use Forestry\FormValidator\SimpleRuleInterface;

class BooleanRule implements SimpleRuleInterface
{
    use MessageTrait;

    /**
     * Set default message for this rule.
     */
    public function __construct()
    {
        $this->defaultMessage = 'value is not set';
    }

    /**
     * Validates if the value is boolean true.
     *
     * @param mixed $value
     * @return boolean
     */
    public function validate($value)
    {
        return filter_var($value, \FILTER_VALIDATE_BOOLEAN);
    }
}
