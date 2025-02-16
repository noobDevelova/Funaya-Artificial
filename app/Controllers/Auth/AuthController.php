<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Core\Adapters\EnvAdapter;
use App\Core\Domains\Auth\DTOs\AuthDTOFactory;
use App\Core\Domains\Auth\Usecases\AuthenticateUserUseCase;
use App\Core\Shared\Exception\BaseException;
use App\Core\Shared\Http\Response;
use App\Schemas\LoginSchema;
use Config\Services;

class AuthController extends BaseController
{

    protected $ENV_ADAPTER;
    protected $validation;
    protected AuthDTOFactory $authDTOFactory;
    protected AuthenticateUserUseCase $authenticateUserUseCase;
    protected $unAuthenticateUseCase;

    public function __construct()
    {
        $this->ENV_ADAPTER = new EnvAdapter();
        $this->validation = Services::validation();

        $this->authDTOFactory = Services::authDTOFactory();

        $this->authenticateUserUseCase = Services::authenticateUserUseCase();
        $this->unAuthenticateUseCase = Services::unAuthenticateUserUseCase();
    }

    public function index()
    {
        $metadata = [
            'title' => 'Login - Admin | ' . $this->ENV_ADAPTER->getAppName(),
        ];

        return view('auth/index', $metadata);
    }

    public function login()
    {
        $requestData = $this->request->getJSON(true);

        $this->validation->setRules(LoginSchema::getRules());

        if (!$this->validation->run($requestData)) {
            return Response::error(
                "Invalid Input Data",
                'INVALID_INPUT',
                400,
                $this->validation->getErrors()
            );
        }

        try {
            $dto = $this->authDTOFactory->createRequest($requestData);

            $authenticate = $this->authenticateUserUseCase->execute($dto);

            return Response::success('Login Successful', [
                'username' => $authenticate->username,
                'email' => $authenticate->email,
                'role_id' => $authenticate->role_id
            ], 200);
        } catch (BaseException $e) {
            if ($e->getErrorCode() == 'ACCOUNT_NOT_ACTIVE') {
                return Response::error(
                    'Account is not active. Please contact the administrator.',
                    'ACCOUNT_NOT_ACTIVE',
                    400,
                );
            }

            return Response::error(
                $e->getErrorMessage(),
                $e->getErrorCode(),
                400
            );
        }
    }

    public function logout()
    {

        $userId = session()->get('id');

        $this->unAuthenticateUseCase->execute($userId);

        return redirect()->to('auth/login');
    }
}
