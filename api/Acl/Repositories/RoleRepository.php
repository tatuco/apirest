<?php

namespace Api\Acl\Repositories;

use Api\Acl\Models\Role;
use Infrastructure\Database\Eloquent\Repository;

class RoleRepository extends Repository
{
    public function getModel()
    {
        return new Role();
    }

    public function create(array $data)
    {
        $role = $this->getModel();
        $role->fill($data);
        $role->save();

        return $role;
    }

    public function update(Role $role, array $data)
    {
        $role->fill($data);

        $role->save();

        return $role;
    }
}
