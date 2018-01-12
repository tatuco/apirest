<?php

namespace Api\Acl\Events;

use Infrastructure\Events\Event;
use Api\Acl\Models\Role;

class RoleWasDeleted extends Event
{
    public $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }
}
