<?php

namespace Api\Acl\Services;

use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher;
use Api\Acl\Exceptions\PermissionNotFoundException;
use Api\Acl\Events\PermissionWasCreated;
use Api\Acl\Events\PermissionWasDeleted;
use Api\Acl\Events\PermissionWasUpdated;
use Api\Acl\Repositories\PermissionRepository;

class PermissionService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $permissionRepository;

    public function __construct(
        AuthManager $auth,
        DatabaseManager $database,
        Dispatcher $dispatcher,
        PermissionRepository $permissionRepository
    ) {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this->permissionRepository = $permissionRepository;
    }

    public function getAll($options = [])
    {
        return $this->permissionRepository->get($options);
    }

    public function getById($permissionId, array $options = [])
    {
        $permission = $this->getRequestedPermission($permissionId);

        return $permission;
    }

    public function create($data)
    {
        $permission = $this->permissionRepository->create($data);

        $this->dispatcher->fire(new PermissionWasCreated($permission));

        return $permission;
    }

    public function update($permissionId, array $data)
    {
        $permission = $this->getRequestedPermission($permissionId);

        $this->permissionRepository->update($permission, $data);

        $this->dispatcher->fire(new PermissionWasUpdated($permission));

        return $permission;
    }

    public function delete($permissionId)
    {
        $permission = $this->getRequestedPermission($permissionId);

        $this->permissionRepository->delete($permissionId);

        $this->dispatcher->fire(new PermissionWasDeleted($permission));
    }

    private function getRequestedPermission($permissionId)
    {
        $permission = $this->permissionRepository->getById($permissionId);

        if (is_null($permission)) {
            throw new PermissionNotFoundException();
        }

        return $permission;
    }
}
