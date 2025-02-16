<?php

namespace App\Core\Domains\Auth\Repositories\Implementation;

use App\Core\Domains\Auth\DTOs\AuthDTOFactory;
use App\Core\Domains\Auth\DTOs\Frame\AuthRequest;
use App\Core\Domains\Auth\DTOs\Frame\AuthResponse;
use App\Core\Domains\Auth\Repositories\AuthRepository;
use App\Core\Domains\Auth\Repositories\Model\AuthModel;
use App\Core\Shared\Enums\AuthError;
use App\Core\Shared\Exception\BaseException;

class AuthRepositoryImpl implements AuthRepository
{
    protected AuthModel $authModel;
    protected AuthDTOFactory $authDTOFactory;

    public function __construct(
        AuthModel $authModel,
        AuthDTOFactory $authDTOFactory
    ) {
        $this->authModel = $authModel;
        $this->authDTOFactory = $authDTOFactory;
    }

    public function authenticate(AuthRequest $loginRequest): AuthResponse | BaseException
    {
        $userData = $this->authModel->where('email', $loginRequest->email)->where('deleted_at', null)->first();

        if (!$userData) {
            throw new BaseException(AuthError::ACCOUNT_NOT_FOUND->value, 'ACCOUNT_NOT_FOUND');
        }

        $user = $this->authDTOFactory->createResponse($userData);

        if (!password_verify($loginRequest->password, $user->password)) {
            throw new BaseException(AuthError::INVALID_PASSWORD->value, 'INVALID_PASSWORD');
        }

        if ($userData['is_active'] == 0) {
            throw new BaseException(AuthError::ACCOUNT_NOT_ACTIVE->value, 'ACCOUNT_NOT_ACTIVE');
        }

        session()->set([
            'id' => $user->id,
            'username' => $user->username,
            'role' => $user->role_id,
            'isLoggedIn' => true
        ]);

        $this->authModel->update($user->id, ['last_login' => date('Y-m-d H:i:s')]);

        return $user;
    }

    public function unAuthenticate(int $userId): bool
    {
        session()->remove('id');
        session()->remove('username');
        session()->remove('role');
        session()->remove('isLoggedIn');
        session()->destroy();

        return $this->authModel->update($userId, ['last_login' => date('Y-m-d H:i:s')]);
    }
}
