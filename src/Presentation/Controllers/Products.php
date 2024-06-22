<?php

namespace Presentation\Controllers;

class Products extends \Presentation\MVC\Controller
{
    const PARAM_FILTER = 'f';

    public function __construct(
//        private \Application\SignedInUserQuery $signedInUserQuery
        private \Application\Query\ProductSearchQuery $productSearchQuery
    )
    {
    }

    public function GET_index(): \Presentation\MVC\ActionResult
    {
        return $this->view('product', [
//            'user' => $this->signedInUserQuery->execute()
            'user' => null
        ]);
    }

    public function GET_Search(): \Presentation\MVC\ActionResult {
        return $this->view('productSearch', [
//            'user' => $this->signedInUserQuery->execute(),
            'user' => null,
            'filter' => $this->tryGetParam(self::PARAM_FILTER, $value) ? $value : '',
            'books' => $this->tryGetParam(self::PARAM_FILTER, $value) ? $this->productSearchQuery->execute($value) : null,
            'context' => $this->getRequestUri()
        ]);
    }
}