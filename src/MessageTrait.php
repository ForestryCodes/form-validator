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
        $message = $this->defaultMessage;
        if (!empty($customMessage)) {
            $message = $customMessage;
        }

        return $message;
    }
}
