<?php

declare(strict_types=1);

namespace DifferDev\Domain\Entity;

final class DiscountCalculator
{
    public function __construct(
        public float $amount,
        public string $name = 'default',
        public string|null $id = null
    ) {
    }

    public function calculate(float $price): float
    {
        return $price - ($price * $this->amount);
    }
}
