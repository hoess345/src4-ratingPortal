<?php

namespace Application\Entities;

class Product
{
    public function __construct(
        private int    $id,
        private string $producer,
        private string $productName,
        private string $username,
        private string $rating,
        private int    $ratingCount
    )
    {
    }

    public function get(): int
    {
        return $this->id;
    }

    public function getProducer(): string
    {
        return $this->producer;
    }

    public function getProductName(): string
    {
        return $this->productName;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getRating(): string
    {
        return $this->rating;
    }

    public function getRatingCount(): int
    {
        return $this->ratingCount;
    }

}