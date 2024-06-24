<?php

namespace Application\Command;

class CreateProductCommand
{
    public function __construct(
        private \Application\Interfaces\ProductRepository $productRepository
    )
    {
    }

    public function execute(string $productName, string $producer): int
    {
        $productName = trim($productName);
        $producer = trim($producer);

        return $this->productRepository->createProduct($productName, $producer);
    }
}