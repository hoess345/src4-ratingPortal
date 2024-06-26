<?php

namespace Application\Util;

class ProductData {
    public function __construct(
        public int $id,
        public string $producer,
        public string $productName,
        public string $username,
        public float $rating,
        public int $ratingCount
    ) {}
}