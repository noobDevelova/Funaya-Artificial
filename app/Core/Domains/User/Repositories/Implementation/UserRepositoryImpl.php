<?php

namespace App\Core\Domains\User\Repositories\Implementation;

use App\Core\Domains\User\DTOs\Frame\UserRequest;
use App\Core\Domains\User\DTOs\Frame\UserResponse;
use App\Core\Domains\User\DTOs\Frame\UserRoleResponse;
use App\Core\Domains\User\DTOs\UserDTOFactory;
use App\Core\Domains\User\Repositories\Model\RolesModel;
use App\Core\Domains\User\Repositories\Model\UserModel;
use App\Core\Domains\User\Repositories\UserRepository;
use App\Core\Shared\Enums\UserError;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\BaseListParams;
use App\Core\Shared\Http\BaseListResponse;

class UserRepositoryImpl implements UserRepository
{
    protected UserModel $userModel;
    protected RolesModel $rolesModel;
    protected UserDTOFactory $userDTOFactory;

    public function __construct(
        UserModel $userModel,
        RolesModel $rolesModel,
        UserDTOFactory $userDTOFactory
    ) {
        $this->userModel = $userModel;
        $this->rolesModel = $rolesModel;
        $this->userDTOFactory = $userDTOFactory;
    }

    public function getUsers(BaseListParams $params): BaseListResponse
    {
        $users = $this->userModel->select('users.*, roles.role_name')
            ->join('roles', 'roles.id = users.role_id', 'left')
            ->paginate($params->limit, 'default', $params->page);

        $countData = $this->userModel->countAllResults();

        $listUser = array_map(function ($data) {
            return $this->userDTOFactory->createResponse($data)->getObj();
        }, $users);

        return new BaseListResponse($listUser, [
            'current_page' => $params->page,
            'total_count' => $countData,
            'total_pages' => ceil($countData / $params->limit),
            'limit' => $params->limit
        ]);
    }

    public function getRoles(): BaseListResponse
    {
        $response = $this->rolesModel->findAll();

        $roles = array_map(function ($data) {
            return $this->userDTOFactory->createResponseRoles($data);
        }, $response);

        return new BaseListResponse($roles, []);
    }

    public function createUser(UserRequest $request): bool | BaseException
    {
        $existingUser = $this->userModel->where('email', $request->email)->first();

        if ($existingUser) {
            throw new BaseException(UserError::USER_ALREADY_EXISTS->value, 'USER_ALREADY_EXISTS', 400);
        }

        $request->password = password_hash($request->password, PASSWORD_DEFAULT);

        return $this->userModel->insert($request->getAssoc());
    }

    public function getUserById(int $id): UserResponse | BaseException
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw new BaseException(UserError::USER_NOT_FOUND->value, 'USER_NOT_FOUND', 404);
        }

        return $this->userDTOFactory->createResponse($user);
    }

    public function updateUser(UserRequest $request): bool | BaseException
    {
        log_message('debug', 'Request: ' . print_r($request, true));

        $existingUser = $this->userModel->where('email', $request->email)->where('id !=', $request->id)->first();

        if ($existingUser) {
            throw new BaseException(UserError::USER_ALREADY_EXISTS->value, 'USER_ALREADY_EXISTS', 400);
        }

        return $this->userModel->update($request->id, $request->getUpdateAssoc());
    }

    public function toggleActiveUser(int $id): bool | BaseException
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw new BaseException(UserError::USER_NOT_FOUND->value, 'USER_NOT_FOUND', 404);
        }

        return $this->userModel->update($id, ['is_active' => $user['is_active'] == 1 ? 0 : 1]);
    }

    public function deleteUser(int $id): bool | BaseException
    {
        $user = $this->userModel->find($id);

        if (!$user) {
            throw new BaseException(UserError::USER_NOT_FOUND->value, 'USER_NOT_FOUND', 404);
        }

        return $this->userModel->delete($id);
    }
}
