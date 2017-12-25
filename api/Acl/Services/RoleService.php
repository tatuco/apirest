<?php

namespace Api\Acl\Services;

use Exception;
use Illuminate\Auth\AuthManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher;
use Api\Acl\Exceptions\RoleNotFoundException;
use Api\Acl\Events\RoleWasCreated;
use Api\Acl\Events\RoleWasDeleted;
use Api\Acl\Events\RoleWasUpdated;
use Api\Acl\Repositories\RoleRepository;

class RoleService
{
    private $auth;

    private $database;

    private $dispatcher;

    private $roleRepository;

    public function __construct(
        AuthManager $auth,
        DatabaseManager $database,
        Dispatcher $dispatcher,
        RoleRepository $roleRepository
    ) {
        $this->auth = $auth;
        $this->database = $database;
        $this->dispatcher = $dispatcher;
        $this->roleRepository = $roleRepository;
    }

    public function getAll($options = [])
    {
        return $this->roleRepository->get($options);
    }

    public function getById($roleId, array $options = [])
    {
        $role = $this->getRequestedRole($roleId);

        return $role;
    }

    public function create($data)
    {
        $role = $this->roleRepository->create($data);

        $this->dispatcher->fire(new RoleWasCreated($role));

        return $role;
    }

    public function update($roleId, array $data)
    {
        $role = $this->getRequestedRole($roleId);

        $this->roleRepository->update($role, $data);

        $this->dispatcher->fire(new RoleWasUpdated($role));

        return $role;
    }

    public function delete($roleId)
    {
        $role = $this->getRequestedRole($roleId);

        $this->roleRepository->delete($roleId);

        $this->dispatcher->fire(new RoleWasDeleted($role));
    }

    private function getRequestedRole($roleId)
    {
        $role = $this->roleRepository->getById($roleId);

        if (is_null($role)) {
            throw new RoleNotFoundException();
        }

        return $role;
    }
}
