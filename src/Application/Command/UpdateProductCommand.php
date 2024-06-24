<?php

namespace Application\Command;

class UpdateProductCommand
{
    public function __construct(
        private \Application\Interfaces\ProductRepository $productRepository
    )
    {
    }

    public function execute(int $id, string $producer, string $productName): void
    {
        $this->productRepository->updateProduct($id, $producer, $productName);
    }
}