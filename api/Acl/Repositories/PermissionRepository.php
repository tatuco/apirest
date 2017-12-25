<?php

namespace Api\Acl\Repositories;

use Api\Acl\Models\Permission;
use Infrastructure\Database\Eloquent\Repository;

class PermissionRepository extends Repository
{
    public function getModel()
    {
        return new Permission();
    }

    public function create(array $data)
    {
        $permission = $this->getModel();

        //$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $permission->fill($data);
        $permission->save();

        return $permission;
    }

    public function update(Permission $permission, array $data)
    {
        $permission->fill($data);

        $permission->save();

        return $permission;
    }
}
