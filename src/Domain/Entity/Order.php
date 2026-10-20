<?php

namespace DifferDev\Domain\Entity;

final class Order
{
    public ?string $id = null;

    private float $discount = 0.0;

    public function __construct(
        public readonly array $items,
    ) {
        if ($items === []) {
            throw new \Exception('Order must have items');
        }

        foreach ($items as $index => $item) {
            if (!is_array($item)) {
                throw new \Exception("Order item '$index' must be an array");
            }

            if (!array_key_exists('price', $item)) {
                throw new \Exception("Order item '$index' must have a price");
            }

            if (!array_key_exists('quantity', $item)) {
                throw new \Exception("Order item '$index' must have a quantity");
            }

            $price = $item['price'];
            $quantity = $item['quantity'];

            if (
                (!is_int($price) && !is_float($price))
                || !is_finite((float) $price)
                || $price < 0
            ) {
                throw new \Exception("Order item '$index' must have a non-negative numeric price");
            }

            if (!is_int($quantity) || $quantity < 1) {
                throw new \Exception("Order item '$index' must have a positive integer quantity");
            }
        }
    }

    public function total(): float
    {
        $subtotal = 0.0;

        foreach ($this->items as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        return $subtotal;
    }

    public function applyDiscount(float $param): float
    {
        $discountCalculator = new DiscountCalculator(0.10);
        return $discountCalculator->calculate($param);
    }
}
