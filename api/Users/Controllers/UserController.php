<?php

namespace Api\Users\Controllers;

use Illuminate\Http\Request;
use Infrastructure\Http\Controller;
use Api\Users\Requests\CreateUserRequest;
use Api\Users\Services\UserService;

class UserController extends Controller
{
    private $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @return \Optimus\Bruno\JsonResponse
     * el parseResouceOptions() Analizar las opciones de recursos dadas por los parámetros GET
     * con el getAll mandamos a  consultar todo
     * la consulta se la pasamos al parseData (optimus) el filtrado+ la llave del json
     * y se responde el json
     */
    public function getAll()
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->userService->getAll($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'users');

        return $this->response($parsedData);
    }

    public function getById($userId)
    {
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->userService->getById($userId, $resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'user');

        return $this->response($parsedData);
    }

    public function create(CreateUserRequest $request)
    {
        $data = $request->get('user', []);

        return $this->response($this->userService->create($data), 201);
    }

    public function update($userId, Request $request)
    {
        $data = $request->get('user', []);

        return $this->response($this->userService->update($userId, $data));
    }

    public function delete($userId)
    {
        return $this->response($this->userService->delete($userId));
    }

    /**
     * @return \Optimus\Bruno\JsonResponse
     * parseData metodo del Architect
     * Ejemplo:$books = Book::with('Author')->get();

    $architect = new \Optimus\Architect\Architect;
    $parsed = $architect->parseData($books, [
    'author' => 'sideload' // can also be embed or ids (embed is default)
    ], 'books');
     */
    public function usersRoles()
    {
        $resourceOptions = $this->parseResourceOptions();
        $data = $this->userService->usersRoles($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'users');
        return $this->response($parsedData);
    }

    public function createJson(){
        $resourceOptions = $this->parseResourceOptions();

        $data = $this->userService->createJson($resourceOptions);
        $parsedData = $this->parseData($data, $resourceOptions, 'user');

        return $this->response($parsedData);
    }
}
