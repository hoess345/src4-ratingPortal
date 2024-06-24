<?php

namespace Application\Query;

use Application\Util\ProductData;

class ProductSearchQuery {
    public function __construct(
        private \Application\Interfaces\ProductRepository $productRepository
    ) {}

    public function execute(string $filter): array {
      $res = [];
        foreach($this->productRepository->getProductsForFilter($filter) as $p) {
            $res[] = new ProductData($p->getId(), $p->getProducer(), $p->getProductName(), $p->getUsername(), $p->getRating(), $p->getRatingCount());
            }

      return $res;
    }
}