<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use Vairogs\Core\Tests\VairogsTestCase;
use Vairogs\Functions\Json;
use Vairogs\Functions\Tests\DataProvider\JsonDataProvider;

class JsonTest extends VairogsTestCase
{
    /**
     * @noinspection PhpUnhandledExceptionInspection
     */
    #[DataProviderExternal(JsonDataProvider::class, 'providerJson')]
    public function testJson(mixed $data, int $flags): void
    {
        $this->assertEquals(expected: $data, actual: (new Json())->decode(json: (new Json())->encode(value: $data, flags: $flags), flags: $flags));
    }
}
