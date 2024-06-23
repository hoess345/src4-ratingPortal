<?php

namespace Application\Command;

class RegisterCommand
{
    public function __construct(
        private \Application\Interfaces\UserRepository $userRepository
    ) {
    }

    public function execute(string $userName, string $password): bool
    {
        if ($this->userRepository->getUserForUserName($userName) != null) {
            return false;
        }

        $this->userRepository->addUser($userName, password_hash($password, PASSWORD_DEFAULT));
        return true;
    }

}