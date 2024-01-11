<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use Vairogs\Core\Tests\VairogsTestCase;
use Vairogs\Functions\Handler\FunctionHandler;
use Vairogs\Functions\Tests\DataProvider\FunctionHandlerDataProvider;

class FunctionHandlerTest extends VairogsTestCase
{
    #[DataProviderExternal(FunctionHandlerDataProvider::class, 'provider')]
    public function test(string $function, ?object $object, mixed $expected, ...$arguments): void
    {
        $this->assertEquals(expected: $expected, actual: (new FunctionHandler(function: $function, instance: $object))->handle(...$arguments));
    }
}
