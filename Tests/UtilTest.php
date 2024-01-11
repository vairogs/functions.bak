<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use Vairogs\Core\Tests\VairogsTestCase;
use Vairogs\Functions\Tests\DataProvider\UtilDataProvider;
use Vairogs\Functions\Util;

class UtilTest extends VairogsTestCase
{
    #[DataProviderExternal(UtilDataProvider::class, 'providerIsPrime')]
    public function testIsPrime(int $number, bool $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Util())->isPrime(number: $number));
    }

    #[DataProviderExternal(UtilDataProvider::class, 'providerIsPrime')]
    public function testIsPrimeNoGMP(int $number, bool $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Util())->isPrime(number: $number, override: true));
    }

    #[DataProviderExternal(UtilDataProvider::class, 'providerIsPrimeBelow1000')]
    public function testIsPrimeBelow1000(int $number, ?bool $expectedBelow): void
    {
        $this->assertEquals(expected: $expectedBelow, actual: (new Util())->isPrimeBelow1000(number: $number));
    }

    #[DataProviderExternal(UtilDataProvider::class, 'providerDistanceBetweenPoints')]
    public function testDistanceBetweenPoints(float $latitude1, float $longitude1, float $latitude2, float $longitude2, bool $km, float $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Util())->distanceBetweenPoints(latitude1: $latitude1, longitude1: $longitude1, latitude2: $latitude2, longitude2: $longitude2, km: $km));
    }
}
