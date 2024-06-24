<?php

namespace Application\Interfaces;

interface ProductRepository
{
    public function getAllProducts() : array;
    public function getProductsForFilter(string $filter) : array;
    public function createProduct(string $productName, string $producer) : int;

    public function getProductById(int $id) : \Application\Util\ProductData;

    public function updateProduct(int $id, string $producer, string $productName);
}