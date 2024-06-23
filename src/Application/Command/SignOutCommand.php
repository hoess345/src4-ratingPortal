<?php

namespace Application\Command;

class SignOutCommand {
    public function __construct(
        private \Application\Services\AuthenticationService $authenticationService
    ) { }

    public function execute() {
        $this->authenticationService->signOut();
    }
}