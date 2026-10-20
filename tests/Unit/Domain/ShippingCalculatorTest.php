<?php

namespace Unit\Domain;

use DifferDev\Domain\Entity\ShippingCalculator;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

#[CoversClass(ShippingCalculator::class)]
class ShippingCalculatorTest extends TestCase
{
    public static function dataCalculateProvider(): \Generator
    {
        yield [210.00, 0.00];
        yield [100.00, 15.00];
        yield [200.00, 15.00];
        yield [300.00, 0.00];
    }

    #[DataProvider('dataCalculateProvider')]
    public function testShouldCalculateShippingValue(
        float $value,
        float $expected
    ) {
        $shippingCalculator = new ShippingCalculator();

        $result = $shippingCalculator->calculate($value);

        $this->assertSame($expected, $result);
    }

}
