<?php

namespace Application\Entities;

class Rating
{
    public function __construct(
        private string $username,
        private int    $rating,
        private string $comment,
        private string $date,
        private string $productId
    )
    {
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function getComment(): string
    {
        return $this->comment;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getDate(): string
    {
        return $this->date;
    }
}