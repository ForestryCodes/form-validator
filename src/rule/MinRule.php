<?php

namespace Forestry\FormValidator\Rule;

use Forestry\FormValidator\MessageTrait;
use Forestry\FormValidator\ParameterRuleInterface;

class MinRule implements ParameterRuleInterface
{
    use MessageTrait;

    /**
     * Set default message for this rule.
     */
    public function __construct()
    {
        $this->defaultMessage = 'value to short';
    }

    /**
     * Validates if the value has the minimum length.
     *
     * @param mixed $value
     * @param integer $length
     * @return boolean
     */
    public function validate($value, $length)
    {
        return ($length <= strlen(trim($value)));
    }
}
