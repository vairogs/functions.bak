<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests;

use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use Symfony\Component\HttpFoundation\Request;
use Vairogs\Core\Tests\VairogsTestCase;
use Vairogs\Functions\Constants\Definition;
use Vairogs\Functions\Iteration;
use Vairogs\Functions\Php;
use Vairogs\Functions\Tests\DataProvider\IterationDataProvider;

class IterationTest extends VairogsTestCase
{
    #[DataProviderExternal(IterationDataProvider::class, 'providerIsEmpty')]
    public function testIsEmpty(mixed $value, bool $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Iteration())->isEmpty(variable: $value));
    }

    #[DataProviderExternal(IterationDataProvider::class, 'providerMakeMultiDimensional')]
    public function testMakeMultiDimensional(array $input, array $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Iteration())->makeMultiDimensional(array: $input));
    }

    #[DataProviderExternal(IterationDataProvider::class, 'providerUniqueMap')]
    public function testUniqueMap(array $input, array $expected): void
    {
        (new Iteration())->uniqueMap(array: $input);
        $this->assertEquals(expected: $expected, actual: $input);
    }

    #[DataProviderExternal(IterationDataProvider::class, 'providerUnique')]
    public function testUnique(array $input, array $expected, bool $keep): void
    {
        $this->assertEquals(expected: $expected, actual: (new Iteration())->unique(input: $input, keepKeys: $keep));
    }

    public function testRemoveFromArray(): void
    {
        $clean = $input = ['one', 'two', 'three', 'four', ];
        (new Iteration())->removeFromArray(input: $clean, value: 'two');
        $this->assertNotEquals(expected: $input, actual: $clean);
    }

    public function testFilterKeyEndsWith(): void
    {
        $this->assertEquals(expected: Request::METHOD_POST, actual: (new Iteration())->filterKeyEndsWith(input: (new Php())->getClassConstants(class: Request::class), endsWith: Request::METHOD_POST)['METHOD_POST'] ?? null);
    }

    #[DataProviderExternal(IterationDataProvider::class, 'providerArrayIntersectKeyRecursive')]
    public function testArrayIntersectKeyRecursive(array $input, array $second, array $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Iteration())->arrayIntersectKeyRecursive(first: $input, second: $second));
    }

    #[DataProviderExternal(IterationDataProvider::class, 'providerArrayFlipRecursive')]
    public function testArrayFlipRecursive(array $input, array $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Iteration())->arrayFlipRecursive(input: $input));
    }

    public function testArrayFlipRecursiveException(): void
    {
        try {
            (new Iteration())->arrayFlipRecursive(input: ['1' => false]);
        } catch (Exception $exception) {
            $this->assertEquals(expected: InvalidArgumentException::class, actual: $exception::class);
        }
    }

    public function testGetFirstAsString(): void
    {
        $request = Request::create(uri: Definition::IDENT);
        $request->initialize();
        $this->assertEquals(expected: null, actual: (new Iteration())->getFirstMatchAsString(keys: ['AAA'], haystack: $request->server->all()));
    }

    #[DataProviderExternal(IterationDataProvider::class, 'providerMakeOneDimension')]
    public function testMakeOneDimension(array $input, bool $onlyLast, int $depth, int $maxDepth, array $expected): void
    {
        $this->assertEquals($expected, (new Iteration())->makeOneDimension(array: $input, onlyLast: $onlyLast, depth: $depth, maxDepth: $maxDepth));
    }
}
