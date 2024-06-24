<?php

namespace Application\Command;

use Application\Entities\Rating;

class CreateRatingCommand {
    public function __construct(
        private \Application\Interfaces\RatingRepository $ratingRepository
    ) { }

    public function execute(string $username, int $rating, string $comment, string $date, int $productId): void {
        $this->ratingRepository->addRating(new Rating($username, $rating, $comment, $date, $productId));
        $this->ratingRepository->increaseRating($productId, $username);
        $this->ratingRepository->updateRatingForProduct($productId);
    }
}