<?php

namespace Application\Interfaces;

interface ProductRepository
{
    public function getAllProducts() : array;
    public function getProductsForFilter(string $filter) : array;
}