<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use Vairogs\Core\Tests\VairogsTestCase;
use Vairogs\Functions\Char;
use Vairogs\Functions\Tests\DataProvider\CharDataProvider;

class CharTest extends VairogsTestCase
{
    #[DataProviderExternal(CharDataProvider::class, 'providerSanitizeFloat')]
    public function testSanitizeFloat(string $string, float $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Char())->sanitizeFloat(string: $string));
    }

    #[DataProviderExternal(CharDataProvider::class, 'providerToSnakeCase')]
    public function testToSnakeCase(string $string, bool $skip, string $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Char())->toSnakeCase(string: $string, skipCamel: $skip));
    }

    #[DataProviderExternal(CharDataProvider::class, 'providerFromCamelCase')]
    public function testFromCamelCase(string $string, string $sep, string $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Char())->fromCamelCase(string: $string, separator: $sep));
    }

    #[DataProviderExternal(CharDataProvider::class, 'providerToCamelCaseLCFirst')]
    public function testToCamelCaseLCFirst(string $input, string $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Char())->toCamelCaseLCFirst(string: $input));
    }

    #[DataProviderExternal(CharDataProvider::class, 'providerToCamelCaseUCFirst')]
    public function testToCamelCaseUCFirst(string $input, string $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Char())->toCamelCaseLCFirstUCFirst(string: $input));
    }
}
