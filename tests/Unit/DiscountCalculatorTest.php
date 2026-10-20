<?php

declare(strict_types=1);

namespace Unit;

use DifferDev\Domain\Entity\DiscountCalculator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(DiscountCalculator::class)]
class DiscountCalculatorTest extends TestCase
{
    public function testDiscountCalculatorShouldApplyADiscount(): void
    {
        // 1. Construção
        $discountCalculator = new DiscountCalculator(10 / 100);

        // 2. Execução
        $result = $discountCalculator->calculate(100.00);

        // 3. Verificação
        $this->assertEquals(90.00, $result);
    }
}
