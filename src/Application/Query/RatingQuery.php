<?php

namespace Application\Query;

class RatingQuery {
    public function __construct(
        private \Application\Interfaces\RatingRepository $ratingRepository
    ) { }

    public function execute(int $productId): array {
        return $this->ratingRepository->getRatingsForProduct($productId);
    }
}