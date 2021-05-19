<?php

namespace App\Exception;

use DomainException;

class NotFoundUserException extends DomainException
{
    public function __construct(string $message, int $code = 404)
    {
        parent::__construct($message, 404);
    }
}