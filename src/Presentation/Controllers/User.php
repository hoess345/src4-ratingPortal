<?php

namespace Presentation\Controllers;

class User extends \Presentation\MVC\Controller
{
    const PARAM_USER_NAME = 'un';
    const PARAM_PASSWORD = 'password';

    public function __construct(
//        private \Application\SignInCommand $signInCommand,
//        private \Application\SignOutCommand $signOutCommand,
//        private \Application\SignedInUserQuery $signedInUserQuery
    )
    {
    }

    public function GET_LogIn(): \Presentation\MVC\ActionResult
    {
        return $this->view('login', [
//            'user' => $this->signedInUserQuery->execute(),
            'user' => null,
//            'userName' => $this->tryGetParam(self::PARAM_USER_NAME, $value) ? $value : ''
        ]);
    }

    public function POST_LogOut(): \Presentation\MVC\ActionResult
    {
//        $this->signOutCommand->execute();
        return $this->redirect('Home', 'Index');
    }
}
