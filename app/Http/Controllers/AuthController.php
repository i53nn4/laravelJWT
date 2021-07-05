<?php

namespace App\Http\Controllers;

use App\Http\Services\AuthService;
use App\Http\Repositories\AuthRepository;
use App\Http\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;

class AuthController extends BaseController
{
    /**
     * The response trait
     */
    use ResponseTrait;

    /**
     * The request instance.
     *
     * @var Request
     */
    private $request;

    /**
     * @var AuthRepository
     */
    protected $service;

    /**
     * Create a new controller instance.
     *
     * @param Request $request
     * @param AuthService $service
     */
    public function __construct(Request $request, AuthService $service)
    {
        $this->request = $request;
        $this->service = $service;
    }

    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     *
     * @return JsonResponse
     */
    public function auth(): JsonResponse
    {
        try {
            $validator = Validator::make($this->request->all(), [
                'login' => 'required|email',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                return $this->errorResponse($validator->errors()->toArray(), 422);
            }

            $user = $this->service->getUser($this->request->all());

            if (Hash::check($this->request->input('password'), $user->password)) {
                return $this->successResponse($this->service->jwt($user));
            }

            throw new Exception('Login or password is wrong.');
        } catch (Exception $exception) {
            return $this->errorResponse(['message' => [$exception->getMessage()]]);
        }
    }
}
