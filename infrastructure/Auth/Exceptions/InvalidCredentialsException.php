<?php

namespace Infrastructure\Auth\Exceptions;

use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class InvalidCredentialsException extends UnauthorizedHttpException
{
    public function __construct($message = 'maricoelquelolea', \Exception $previous = null, $code = 400)
    {
        parent::__construct('', $message, $previous, $code);
    }
}