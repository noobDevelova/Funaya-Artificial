<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;
use App\Core\Adapters\EnvAdapter;
use App\Core\Domains\User\DTOs\UserDTOFactory;
use App\Core\Domains\User\Usecases\CreateUserUseCase;
use App\Core\Domains\User\Usecases\DeleteUserUseCase;
use App\Core\Domains\User\Usecases\GetListRolesUseCase;
use App\Core\Domains\User\Usecases\GetListUsersUseCase;
use App\Core\Domains\User\Usecases\GetUserUseCase;
use App\Core\Domains\User\Usecases\ToggleActiveUserUseCase;
use App\Core\Domains\User\Usecases\UpdateUserUseCase;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\Response;
use App\Schemas\CreateUserSchema;
use App\Schemas\EditUserSchema;
use Config\Services;

class UsersController extends BaseController
{
    protected $ENV_ADAPTER;
    protected $validation;

    protected UserDTOFactory $userDTOFactory;

    protected GetListUsersUseCase $getListUsersUseCase;
    protected GetListRolesUseCase $getListRolesUseCase;
    protected CreateUserUseCase $createUserUseCase;
    protected GetUserUseCase $getUserUseCase;
    protected UpdateUserUseCase $updateUserUseCase;
    protected ToggleActiveUserUseCase $toggleActiveUserUseCase;
    protected DeleteUserUseCase $deleteUserUseCase;

    public function __construct()
    {
        $this->ENV_ADAPTER = new EnvAdapter();
        $this->validation = Services::validation();

        $this->userDTOFactory = Services::userDTOFactory();

        $this->getListUsersUseCase = Services::getListUsersUseCase();
        $this->getListRolesUseCase = Services::getListRolesUseCase();
        $this->createUserUseCase = Services::createUserUseCase();
        $this->getUserUseCase = Services::getUserUseCase();
        $this->updateUserUseCase = Services::updateUserUseCase();
        $this->toggleActiveUserUseCase = Services::toggleActiveUserUseCase();
        $this->deleteUserUseCase = Services::deleteUserUseCase();
    }

    private function getIndexData()
    {
        $params = new BaseListParams([
            'page' => (int) $this->request->getVar('page') ?: 1,
            'limit' => (int) $this->request->getVar('limit') ?: 10
        ]);

        try {
            $response = $this->getListUsersUseCase->execute($params);

            return [
                'users' => $response->getItems(),
                'pagination' => $response->getPagination(),
                'error_message' => ''
            ];
        } catch (BaseException $e) {
            return [
                'users' => [],
                'pagination' => [],
                'error_message' => $e->getMessage()
            ];
        }
    }

    public function index()
    {
        $metadata = [
            'title' => 'List Staff | ' . $this->ENV_ADAPTER->getAppName(),
            'current' => 'Staff',
        ];

        $indexData = $this->getIndexData();

        return view('users/list/index', [
            'users' => $indexData['users'],
            'pagination' => $indexData['pagination'],
            'error_message' => $indexData['error_message'],
        ] + $metadata);
    }

    public function create()
    {
        $metadata = [
            'title' => 'List Staff | ' . $this->ENV_ADAPTER->getAppName(),
            'current' => 'Staff',
        ];

        $roles = $this->getListRolesUseCase->execute();

        return view('users/create/index', [
            'roles' => $roles->getItems()
        ] + $metadata);
    }

    public function store()
    {
        $requestData = $this->request->getJSON(true);

        $this->validation->setRules(CreateUserSchema::getRules());

        if (!$this->validation->run($requestData)) {
            return Response::error(
                "Invalid Input Data",
                'INVALID_INPUT',
                400,
                $this->validation->getErrors()
            );
        }

        try {
            $dto = $this->userDTOFactory->createRequest($requestData);

            $this->createUserUseCase->execute($dto);

            return Response::success(
                'Success creating user!',
                [],
                200
            );
        } catch (BaseException $e) {
            return Response::error(
                $e->getErrorMessage(),
                $e->getErrorCode(),
                400
            );
        }
    }

    public function edit($id)
    {
        $metadata = [
            'title' => 'Edit Staff | ' . $this->ENV_ADAPTER->getAppName(),
            'current' => 'Staff',
        ];

        $user = $this->getUserUseCase->execute($id);

        $roles = $this->getListRolesUseCase->execute();

        return view('users/edit/index', [
            'roles' => $roles->getItems(),
            'user' => $user->getObj()
        ] + $metadata);
    }

    public function update()
    {
        $requestData = $this->request->getJSON(true);

        log_message('debug', 'Request Data: ' . print_r($requestData, true));


        $this->validation->setRules(EditUserSchema::getRules());

        if (!$this->validation->run($requestData)) {
            return Response::error(
                "Invalid Input Data",
                'INVALID_INPUT',
                400,
                $this->validation->getErrors()
            );
        }

        try {
            $dto = $this->userDTOFactory->createRequest($requestData);

            log_message('debug', 'DTO: ' . print_r($dto, true));

            $this->updateUserUseCase->execute($dto);

            return Response::success(
                'Success updating user!',
                [],
                200
            );
        } catch (BaseException $e) {
            return Response::error(
                $e->getErrorMessage(),
                $e->getErrorCode(),
                400
            );
        }
    }

    public function toggleActive()
    {
        $requestData = $this->request->getJSON(true);

        $id = $requestData['id'];

        if (!$id) {
            return Response::error(
                "Parameter ID is required",
                'PARAMETER_ID_REQUIRED',
                400,
                []
            );
        }

        try {
            $this->toggleActiveUserUseCase->execute($id);

            return Response::success(
                'Success toggling active user!',
                [],
                200
            );
        } catch (BaseException $e) {
            return Response::error($e->getErrorMessage(), $e->getErrorCode(), 400);
        }
    }

    public function delete()
    {
        $requestData = $this->request->getJSON(true);

        $id = $requestData['id'];

        if (!$id) {
            return Response::error(
                "Parameter ID is required",
                'PARAMETER_ID_REQUIRED',
                400,
            );
        }

        try {
            $this->deleteUserUseCase->execute($id);

            return Response::success(
                'Success deleting user!',
                [],
                200
            );
        } catch (BaseException $e) {
            return Response::error($e->getErrorMessage(), $e->getErrorCode(), 400);
        }
    }
}
