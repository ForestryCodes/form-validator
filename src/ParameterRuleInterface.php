<?php

namespace Forestry\FormValidator;

/**
 * Interface ParameterRuleInterface
 *
 * Interface for rules with parameters.
 *
 * @package Forestry\FormValidator
 * @extends RuleInterface
 */
interface ParameterRuleInterface extends RuleInterface
{
    public function validate($value, $param);
}
