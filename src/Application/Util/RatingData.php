<?php

namespace Application\Util;

class RatingData {
    public function __construct(
        public string $username,
        public float $rating,
        public string $comment,
        public string $date,
        public int $productId
    ) {}
}