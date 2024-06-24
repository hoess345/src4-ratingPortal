<?php

namespace Presentation\Controllers;

class Products extends \Presentation\MVC\Controller
{
    const PARAM_FILTER = 'f';

    const PARAM_PRODUCT_NAME = 'pn';
    const PARAM_PRODUCER = 'pr';

    public function __construct(
        private \Application\Query\SignedInUserQuery  $signedInUserQuery,
        private \Application\Query\ProductSearchQuery $productSearchQuery,
        private \Application\Query\ProductQuery       $productQuery,
        private \Application\Command\CreateProductCommand $createProductCommand,
        private \Application\Interfaces\ProductRepository $productRepository
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

    public function GET_Search(): \Presentation\MVC\ActionResult
    {
        return $this->view('productSearch', [
            'user' => $this->signedInUserQuery->execute(),
            'filter' => $this->tryGetParam(self::PARAM_FILTER, $value) ? $value : '',
            'products' => $this->tryGetParam(self::PARAM_FILTER, $value) ? $this->productSearchQuery->execute($value) : null,
            'context' => $this->getRequestUri()
        ]);
    }

    public function GET_Create(): \Presentation\MVC\ActionResult
    {
        // user needs to be logged in to create a product
        if (!$this->signedInUserQuery->execute()) {
            return $this->view('login', [
                'user' => $this->signedInUserQuery->execute(),
                'userName' => $this->signedInUserQuery->execute() ?? '',
                'context' => $this->getRequestUri(),
                'errors' => ['You need to be logged in to create a product']
            ]);
        }
        return $this->view('productCreate', [
            'user' => $this->signedInUserQuery->execute(),
            'context' => $this->getRequestUri()
        ]);
    }

    public function POST_Create(): \Presentation\MVC\ActionResult
    {
        $productName = $this->getParam(self::PARAM_PRODUCT_NAME);
        $producer = $this->getParam(self::PARAM_PRODUCER);
        if (empty($productName) || empty($producer)) {
            return $this->view('productCreate', [
                'user' => $this->signedInUserQuery->execute(),
                'productName' => $productName,
                'producer' => $producer,
                'errors' => ['Product name and producer must be provided']
            ]);
        }
        $productId = $this->createProductCommand->execute($productName, $producer);
        return $this->redirect('Products', 'Index');
    }

    public function GET_Edit() : \Presentation\MVC\ActionResult
    {
        return $this->view('productEdit', [
            'user' => $this->signedInUserQuery->execute(),
            'id' => $this->getParam('id'),
            'productName' => $this->productRepository->getProductById($this->getParam('id'))->productName,
            'producer' => $this->productRepository->getProductById($this->getParam('id'))->producer,
            'context' => $this->getRequestUri()
        ]);
    }

    public function POST_Edit() : \Presentation\MVC\ActionResult
    {
        $id = $this->getParam('id');
        $newProductName = $this->getParam('productName');
        $newProducer = $this->getParam('producer');
        $this->productRepository->updateProduct($id, $newProducer, $newProductName);
        return $this->view('productList', [
            'user' => $this->signedInUserQuery->execute(),
            'products' => $this->productQuery->execute(),
            'context' => $this->getRequestUri()
        ]);
    }
}