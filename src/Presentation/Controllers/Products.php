<?php

namespace Presentation\Controllers;

class Products extends \Presentation\MVC\Controller
{
    const PARAM_FILTER = 'f';

    public function __construct(
        private \Application\Query\SignedInUserQuery $signedInUserQuery,
        private \Application\Query\ProductSearchQuery $productSearchQuery,
        private \Application\Query\ProductQuery $productQuery
    )
    {
    }

    public function GET_index(): \Presentation\MVC\ActionResult
    {
        return $this->view('productList', [
            'user' => $this->signedInUserQuery->execute(),
            'products' => $this->productQuery->execute(),
            'context' => $this->getRequestUri()
        ]);
    }

    public function GET_Search(): \Presentation\MVC\ActionResult {
        return $this->view('productSearch', [
            'user' => $this->signedInUserQuery->execute(),
            'filter' => $this->tryGetParam(self::PARAM_FILTER, $value) ? $value : '',
            'products' => $this->tryGetParam(self::PARAM_FILTER, $value) ? $this->productSearchQuery->execute($value) : null,
            'context' => $this->getRequestUri()
        ]);
    }
}