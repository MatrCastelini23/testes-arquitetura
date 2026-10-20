<?php

namespace DifferDev\Domain\Entity;

final class ShippingCalculator
{
    public function calculate(float $amount): float
    {
        if ($amount > 200) {
            return 0.0;
        }
        if ($amount >= 100) {
            return 15.00;
        }
        return 25.00;
    }
}
