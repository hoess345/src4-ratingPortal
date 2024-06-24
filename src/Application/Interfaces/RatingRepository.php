<?php

namespace Application\Interfaces;

interface RatingRepository
{
    public function getRatingsForProduct(int $productId): array;
    public function addRating(\Application\Entities\Rating $rating): void;
    public function getRatingForUserAndProduct(int $productId, string $userName): \Application\Util\RatingData;
    public function updateRating(\Application\Util\RatingData $rating): void;

    public function deleteRating(int $productId, string $userName);

    public function increaseRating(int $productId, string $userName);

    public function updateRatingForProduct(int $productId);

    public function decreaseRatingCount(int $productId);
}