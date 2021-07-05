<?php

namespace App\Http\Services;

use App\Http\Repositories\AuthRepository;
use DateInterval;
use DateTime;
use Exception;
use Firebase\JWT\JWT;

class AuthService
{
    /**
     * @var AuthRepository
     */
    protected $repository;

    /**
     * Create a new controller instance.
     *
     * @param AuthRepository $repository
     */
    public function __construct(AuthRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $params
     * @return mixed
     * @throws Exception
     */
    public function getUser(array $params)
    {
        $user = $this->repository->get($params);

        if (!$user) {
            throw new Exception('Login does not exist.');
        }

        return $user;
    }

    /**
     * Create a new token.
     *
     * @param object $user
     * @return array
     * @throws Exception
     */
    public function jwt(object $user): array
    {
        $expiryPeriod = (new DateTime())->add(new DateInterval(env('JWT_EXPIRY_PERIOD')))->getTimestamp();

        $payload = [
            'sub' => $user->id,
            'iss' => 'https:localdomain.dev',
            'aud' => 'https:localdomain.dev',
            'iat' => (new DateTime())->getTimestamp(),
            'nbf' => (new DateTime())->getTimestamp(),
            'exp' => $expiryPeriod
        ];

        $token = JWT::encode($payload, ENV('JWT_SECRET'));

        return [
            'resource' => 'Authorization',
            'token' => $token,
            'expires' => $expiryPeriod,
        ];
    }
}
