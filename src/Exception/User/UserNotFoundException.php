<?php

declare(strict_types=1);

namespace App\Exception\User;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserNotFoundException extends NotFoundHttpException
{
    private const MESSAGE = 'Usuário com email %s não encotrado';

    public static function fromEmail(string $email)
    {
        throw new self(\sprintf(self::MESSAGE, $email));
    }
}
