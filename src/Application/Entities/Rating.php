<?php

namespace Application\Entities;

class Rating
{
    public function __construct(
        private string $username,
        private string $productName,
        private int    $rating,
        private string $comment
    )
    {
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function getRating(): int
    {
        return $this->rating;
    }

    public function getComment(): string
    {
        return $this->comment;
    }
}