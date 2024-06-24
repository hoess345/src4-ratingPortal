<?php

namespace Application\Command;

class DeleteRatingCommand
{
    public function __construct(
        private \Application\Interfaces\RatingRepository $ratingRepository
    )
    {
    }

    public function execute(int $productId, string $userName): void
    {
        $this->ratingRepository->deleteRating($productId, $userName);
        $this->ratingRepository->decreaseRatingCount($productId);
        $this->ratingRepository->updateRatingForProduct($productId);
    }
}