<?php

namespace Forestry\FormValidator;

/**
 * Interface RuleInterface
 *
 * Basic interface for all rules. The validation method is defined by more
 * specific interfaces.
 *
 * @package Forestry\FormValidator
 */
interface RuleInterface
{
    public function getMessage($customMessage = null);
}
