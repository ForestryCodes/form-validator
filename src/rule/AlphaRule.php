<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\MessageTrait;
use Forestry\FormValidator\SimpleRuleInterface;

class AlphaRule implements SimpleRuleInterface
{
    use MessageTrait;

    /**
     * Set default message for this rule.
     */
    public function __construct()
    {
        $this->defaultMessage = 'value is not a valid alphabetical value';
    }

    /**
     * Validates if the value is alphabetical-only value.
     *
     * @param mixed $value
     * @return boolean
     */
    public function validate($value)
    {
        return (bool)preg_match('/^[\pL \.-]+$/u', $value);
    }
}
