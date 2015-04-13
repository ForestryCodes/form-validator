<?php

namespace Forestry\FormValidator;

/**
 * Interface SimpleRuleInterface
 *
 * Interface for simple rules without parameters.
 *
 * @package Forestry\FormValidator
 * @extends RuleInterface
 */
interface SimpleRuleInterface extends RuleInterface
{
    public function validate($value);
}
