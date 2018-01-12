<?php

namespace Api\Acl\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RoleNotFoundException extends NotFoundHttpException
{
    public function __construct()
    {
        parent::__construct('The role was not found.',null,404);
    }
}
