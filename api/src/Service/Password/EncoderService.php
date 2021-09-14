<?php

declare(strict_types=1);

namespace App\Service\Password;

use App\Entity\User;
use App\Exception\Password\PasswordException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class EncoderService
{
    private const MIN_LENGTH = 6;

    public function __construct(private UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function generateEncodedPassword(User $user, string $password): string
    {
        if (strlen($password) < self::MIN_LENGTH) {
            throw PasswordException::invalidLength();
        }

        return $this->userPasswordHasher->hashPassword($user, $password);
    }

    public function isValidPassword(User $user, $oldPassword): bool
    {
        return $this->userPasswordHasher->isPasswordValid($user, $oldPassword);
    }
}
