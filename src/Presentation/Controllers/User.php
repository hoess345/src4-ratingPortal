<?php

namespace Presentation\Controllers;

class User extends \Presentation\MVC\Controller
{
    const PARAM_USER_NAME = 'un';
    const PARAM_PASSWORD = 'password';

    public function __construct(
        private \Application\Command\SignInCommand $signInCommand,
        private \Application\Command\RegisterCommand $registerCommand,
        private \Application\Command\SignOutCommand $signOutCommand,
        private \Application\Query\SignedInUserQuery $signedInUserQuery
    )
    {
    }

    public function GET_LogIn(): \Presentation\MVC\ActionResult
    {
        return $this->view('login', [
            'user' => $this->signedInUserQuery->execute(),
            'userName' => $this->tryGetParam(self::PARAM_USER_NAME, $value) ? $value : ''
        ]);
    }

    public function POST_LogIn(): \Presentation\MVC\ActionResult
    {
        if (!$this->signInCommand->execute($this->getParam(self::PARAM_USER_NAME), $this->getParam(self::PARAM_PASSWORD))) {
            return $this->view('login', [
                'user' => $this->signedInUserQuery->execute(),
                'userName' => $this->getParam(self::PARAM_USER_NAME),
                'errors' => ['Invalid username or password']
            ]);
        } else {
            return $this->redirect('Products', 'Index');
        }
    }

    public function GET_Register(): \Presentation\MVC\ActionResult
    {
        return $this->view('register', [
            'user' => null,
            'userName' => $this->tryGetParam(self::PARAM_USER_NAME, $value) ? $value : ''
        ]);
    }

    public function POST_Register(): \Presentation\MVC\ActionResult
    {
        if (!$this->registerCommand->execute($this->getParam(self::PARAM_USER_NAME), $this->getParam(self::PARAM_PASSWORD))) {
            return $this->view('register', [
                'user' => null,
                'userName' => $this->getParam(self::PARAM_USER_NAME),
                'errors' => ['Username already exists']
            ]);
        } else {
            return $this->redirect('Home', 'Index');
        }
    }

    public function POST_LogOut(): \Presentation\MVC\ActionResult
    {
        $this->signOutCommand->execute();
        return $this->redirect('Home', 'Index');
    }
}
