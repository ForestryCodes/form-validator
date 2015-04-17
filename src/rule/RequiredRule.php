<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\MessageTrait;
use Forestry\FormValidator\SimpleRuleInterface;

class RequiredRule implements SimpleRuleInterface
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
     * Validates if the value is set.
     *
     * @param mixed $value
     * @return boolean
     */
    public function validate($value)
    {
        return !(empty($value) && !is_numeric($value));
    }
}
