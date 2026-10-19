<?php

namespace DifferDev\Domain\Entity;

use InvalidArgumentException;

final class Order
{
    private float $discount = 0.0;

    public function __construct(
        private readonly array $items
    ) {
        if ($items === []) {
            throw new InvalidArgumentException('Order must have items');
        }

        foreach ($items as $index => $item) {
            if (!is_array($item)) {
                throw new InvalidArgumentException(
                    sprintf('Order item "%s" must be an array', $index)
                );
            }

            if (!array_key_exists('price', $item)) {
                throw new InvalidArgumentException(
                    sprintf('Order item "%s" must have a price', $index)
                );
            }

            if (!array_key_exists('quantity', $item)) {
                throw new InvalidArgumentException(
                    sprintf('Order item "%s" must have a quantity', $index)
                );
            }

            $price = $item['price'];
            $quantity = $item['quantity'];

            if (
                (!is_int($price) && !is_float($price))
                || !is_finite((float) $price)
                || $price < 0
            ) {
                throw new InvalidArgumentException(
                    sprintf('Order item "%s" must have a non-negative numeric price', $index)
                );
            }

            if (!is_int($quantity) || $quantity < 1) {
                throw new InvalidArgumentException(
                    sprintf('Order item "%s" must have a positive integer quantity', $index)
                );
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
}
