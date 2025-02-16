<?php

namespace App\Core\Domains\User\Usecases\Implementation;

use App\Core\Domains\User\DTOs\Frame\UserRequest;
use App\Core\Domains\User\Repositories\UserRepository;
use App\Core\Domains\User\Usecases\UpdateUserUseCase;
use App\Core\Shared\Exception\BaseException;
use Config\Database;

class UpdateUserUseCaseImpl implements UpdateUserUseCase
{
    protected UserRepository $userRepository;
    protected $db;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->db = Database::connect();
    }

    public function execute(UserRequest $request): bool | BaseException
    {
        $this->db->transBegin();

        try {
            $this->userRepository->updateUser($request);

            return $this->db->transCommit();
        } catch (BaseException $e) {
            $this->db->transRollback();

            throw new BaseException($e->getMessage(), $e->getCode(), 400);
        } catch (\Exception $e) {
            $this->db->transRollback();

            throw new BaseException($e->getMessage(), $e->getCode(), 400);
        }
    }
}
