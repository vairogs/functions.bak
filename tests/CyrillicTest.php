<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use Vairogs\Core\Tests\VairogsTestCase;
use Vairogs\Functions\Cyrillic;
use Vairogs\Functions\Tests\DataProvider\CyrillicDataProvider;

class CyrillicTest extends VairogsTestCase
{
    #[DataProviderExternal(CyrillicDataProvider::class, 'providerCyrillicToLatin')]
    public function testCyrillicToLatin(string $string, string $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Cyrillic())->cyrillic2latin(text: $string));
    }

    #[DataProviderExternal(CyrillicDataProvider::class, 'providerLatinToCyrillic')]
    public function testLatinToCyrillic(string $string, string $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Cyrillic())->latin2cyrillic(text: $string));
    }

    #[DataProviderExternal(CyrillicDataProvider::class, 'providerGetCountryName')]
    public function testGetCountryName(string $country, string $locale, string $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Cyrillic())->getCountryName(country: $country, locale: $locale));
    }
}
