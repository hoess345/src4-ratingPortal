<?php

namespace Application\Command;

use Application\Util\RatingData;

class UpdateRatingCommand
{
    public function __construct(
        private \Application\Interfaces\RatingRepository $ratingRepository
    )
    {
    }

    public function execute(RatingData $ratingData): void
    {
        $this->ratingRepository->updateRating($ratingData);
        $this->ratingRepository->updateRatingForProduct($ratingData->productId);
    }
}