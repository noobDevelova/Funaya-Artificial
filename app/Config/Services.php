<?php

namespace Config;

use App\Core\Domains\Auth\Repositories\AuthRepository;
use App\Core\Domains\Auth\Repositories\AuthRepositoryInterface;
use App\Core\Domains\Auth\Usecases\AuthenticateUserUseCase;
use App\Core\Domains\Auth\Usecases\UnAuthenticateUserUseCase;
use App\Core\Domains\User\Repositories\UserRepository;
use App\Core\Domains\User\Usecases\CreateEmployeeUseCase;
use App\Core\Domains\User\Usecases\DeleteEmployeeUseCase;
use App\Core\Domains\User\Usecases\GetListEmployeesUseCase;
use CodeIgniter\Config\BaseService;

/**
 * Services Configuration file.
 *
 * Services are simply other classes/libraries that the system uses
 * to do its job. This is used by CodeIgniter to allow the core of the
 * framework to be swapped out easily without affecting the usage within
 * the rest of your application.
 *
 * This file holds any application-specific services, or service overrides
 * that you might need. An example has been included with the general
 * method format you should use for your service methods. For more examples,
 * see the core Services file at system/Config/Services.php.
 */
class Services extends BaseService
{
    // Repository
    public static function authRepository($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('authRepository');
        }

        return new AuthRepository();
    }

    public static function userRepository($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('userRepository');
        }

        return new UserRepository();
    }

    // Usecase
    public static function authenticateUserUseCase($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('authenticateUserUseCase');
        }

        return new AuthenticateUserUseCase(service('authRepository'));
    }

    public static function unAuthenticateUserUseCase($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('unAuthenticateUserUseCase');
        }

        return new UnAuthenticateUserUseCase(service('authRepository'));
    }

    public static function createEmployeeUseCase($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('createEmployeeUseCase');
        }

        return new CreateEmployeeUseCase(service('userRepository'));
    }

    public static function getListEmployeesUseCase($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('getListEmployeesUseCase');
        }

        return new GetListEmployeesUseCase(service('userRepository'));
    }

    public static function deleteEmployeeUseCase($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('deleteEmployeeUseCase');
        }

        return new DeleteEmployeeUseCase(service('userRepository'));
    }
}