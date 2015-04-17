<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\MessageTrait;
use Forestry\FormValidator\SimpleRuleInterface;

class AlphanumRule implements SimpleRuleInterface
{
    use MessageTrait;

    /**
     * Set default message for this rule.
     */
    public function __construct()
    {
        $this->defaultMessage = 'value is not a valid alphanumerical value';
    }

    /**
     * Validates if the value is a alphanumerical value.
     *
     * @param mixed $value
     * @return boolean
     */
    public function validate($value)
    {
        return (bool)preg_match('/^[\pL\pN \.-]+$/', $value);
    }
}
