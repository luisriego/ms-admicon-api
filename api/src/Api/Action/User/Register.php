<?php

declare(strict_types=1);

namespace App\Api\Action\User;

use App\Entity\User;
use App\Service\Request\RequestService;
use App\Service\User\UserRegisterService;
use Symfony\Component\HttpFoundation\Request;

class Register
{

    public function __construct(private UserRegisterService $userRegisterService)
    { }

    public function __invoke(Request $request): User
    {
        return $this->userRegisterService->create(
            RequestService::getField($request, 'name'),
            RequestService::getField($request, 'email'),
            RequestService::getField($request, 'password')
        );
    }
}
