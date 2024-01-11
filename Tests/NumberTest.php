<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use Vairogs\Core\Tests\VairogsTestCase;
use Vairogs\Functions\Number;
use Vairogs\Functions\Tests\DataProvider\NumberDataProvider;

class NumberTest extends VairogsTestCase
{
    #[DataProviderExternal(NumberDataProvider::class, 'providerIsIntFloat')]
    public function testIsInt(int|float $number, bool $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Number())->isInt(value: $number));
    }

    #[DataProviderExternal(NumberDataProvider::class, 'providerIsIntFloat')]
    public function testIsFloat(int|float $number, bool $expected): void
    {
        $this->assertEquals(expected: !$expected, actual: (new Number())->isFloat(value: $number));
    }

    #[DataProviderExternal(NumberDataProvider::class, 'providerGreatestCommonDivisor')]
    public function testGreatestCommonDivisor(int $x, int $y, int $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Number())->greatestCommonDivisor(first: $x, second: $y));
    }

    #[DataProviderExternal(NumberDataProvider::class, 'providerLeastCommonMultiple')]
    public function testLeastCommonMultiple(int $x, int $y, int $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Number())->leastCommonMultiple(first: $x, second: $y));
    }
}
