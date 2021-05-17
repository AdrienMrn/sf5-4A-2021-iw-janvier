<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class TestService
{
    private $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function PwdIsValid($pwd, $user)
    {
        if (!$user instanceof User) {
            return false;
        }

        dump($this->hasher->hashPassword($user, $pwd), $user->getPassword());

        return $user->getPassword() === $this->hasher->hashPassword($user, $pwd);
    }
}