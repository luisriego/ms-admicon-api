<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\User;
use App\Exception\User\UserNotFoundException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class UserRepository extends DoctrineBaseRepository
{
    protected static function entityClass(): string
    {
        return User::class;
    }

    public function findOneByEmailOrFail(string $email): User
    {
        $query = $this->getEntityManager()->createQuery('SELECT u FROM App\Entity\User u WHERE u.email = :email');
        $query->setParameter('email', $email);

        if (null === $user = $query->getOneOrNullResult()) {
            throw UserNotFoundException::fromEmail($email);
        }

        return $user;
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function save(User $user): void
    {
        $this->saveEntity($user);
    }

    /**
     * @throws OptimisticLockException
     * @throws ORMException
     */
    public function remove(User $user): void
    {
        $this->removeEntity($user);
    }
}
