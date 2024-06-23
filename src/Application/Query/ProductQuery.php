<?php

namespace Application\Query;

use Application\Util\ProductData;

class ProductQuery {
    public function __construct(
        private \Application\Interfaces\ProductRepository $productRepository,
        private \Application\Interfaces\UserRepository $userRepository,
    ) { }

    public function execute(): array {
        $products = $this->productRepository->getAllProducts();
        $productData = [];
        foreach ($products as $product) {
            $user = $this->userRepository->getUserForUserName($product->getUsername());
            $productData[] = new ProductData(
                $product->getProducer(),
                $product->getProductName(),
                $user->getUserName(),
                $product->getRating(),
                $product->getRatingCount()
            );
        }
        return $productData;
    }
}
