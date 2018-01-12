<?php

namespace Api\Acl\Exceptions;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PermissionNotFoundException extends NotFoundHttpException
{
    public function __construct()
    {
        parent::__construct('The permission was not found.',null,404);
    }
}
