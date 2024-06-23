<?php

namespace Application\Query;

class ProductSearchQuery {
    public function __construct(
        private \Application\Interfaces\ProductRepository $productRepository
//        private Interfaces\BookRepository $bookRepository,
//        private Services\CartService $cartService
    ) {}

    public function execute(string $filter): array {
      $res = [];
        foreach($this->productRepository->getProductsForFilter($filter) as $p) {
            $res[] = new ProductData($p->getProducer(), $p->getProductName(), $p->getUsername(), $p->getRating(), $p->getRatingCount());
            }

      return $res;
    }
}