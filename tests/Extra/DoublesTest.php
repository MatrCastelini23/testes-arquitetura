<?php

namespace Extra;

use DateTime;
use Mockery;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(DateTime::class)]
class DoublesTest extends TestCase
{
    public function testDoubles(): void
    {
          // Stub
//        $dateTime = $this->createStub(DateTime::class);
//        $dateTime->method('format')
//                 ->willReturn('2020-02-01 22:22:22');

        // Mock
        $dateTime = $this->createMock(DateTime::class);
        $dateTime
            ->expects($this->once())
            ->method('format')
            ->with($this->equalTo('Y-m-d H:i:s'))
            ->willReturn('2020-02-01 22:22:22')
        ;

        $this->assertSame('2020-02-01 22:22:22', $dateTime->format('Y-m-d H:i:s'));
    }

    public function testDoublesSpy(): void
    {
        // Spy
        $dateTime = Mockery::spy(DateTime::class);

        $dateString = $dateTime->format('Y-m-d H:i:s');

        // Verificação após o uso do metodo(spy)
        $dateTime->shouldHaveReceived('format')
            ->with('Y-m-d H:i:s')
            ->once()
        ;

        $this->assertSame('', $dateTime->format('Y-m-d H:i:s'));
    }

    protected function tearDown(): void
    {
        // Ajuste de validações do Mockery
        Mockery::close();
    }
}
