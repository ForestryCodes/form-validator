<?php

namespace Forestry\FormValidator;

interface RuleInterface
{
    public function validate($value);

    public function getMessage($customMessage = null);
}
