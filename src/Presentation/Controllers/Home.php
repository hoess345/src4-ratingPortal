<?php

namespace Presentation\Controllers;

class Home extends \Presentation\MVC\Controller
{
    public function __construct(
        private \Application\Query\SignedInUserQuery $signedInUserQuery
    )
    {
    }

    public function GET_index(): \Presentation\MVC\ActionResult
    {
        return $this->view('home', [
            'user' => $this->signedInUserQuery->execute()
        ]);
    }
}