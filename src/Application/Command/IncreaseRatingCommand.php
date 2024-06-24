<?php

namespace Application\Command;

class IncreaseRatingCommand
{
    public function __construct(
        private \Application\Interfaces\RatingRepository $ratingRepository
    )
    {
    }

    public function execute(int $productId, string $userName): void
    {
        $this->ratingRepository->increaseRating($productId, $userName);
        $this->ratingRepository->updateRatingForProduct($productId);
    }
}