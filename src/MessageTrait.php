<?php

namespace Forestry\FormValidator;

trait MessageTrait
{
    private $defaultMessage;

    /**
     * Get the error message for a rule.
     *
     * If set, uses a custom message insted the default one.
     *
     * @param mixed $customMessage
     * @return string
     */
    public function getMessage($customMessage = null)
    {
        if (!empty($customMessage)) {
            $message = $customMessage;
        } else {
            $message = $this->defaultMessage;
        }

        return $message;
    }
}
