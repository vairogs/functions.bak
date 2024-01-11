<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use Vairogs\Core\Tests\VairogsTestCase;
use Vairogs\Functions\Sort;
use Vairogs\Functions\Tests\DataProvider\SortDataProvider;

class SortTest extends VairogsTestCase
{
    #[DataProviderExternal(SortDataProvider::class, 'providerSwap')]
    public function testSwap(int $a, int $b): void
    {
        $value = [$b, $a, ];
        (new Sort())->swap(foo: $a, bar: $b);
        $this->assertEquals(expected: $value, actual: [$a, $b]);
    }

    #[DataProviderExternal(SortDataProvider::class, 'providerSwap')]
    public function testSwapArray(int $a, int $b): void
    {
        $expected = [$a, $b, ];
        $actual = [$b, $a, ];
        (new Sort())->swapArray(array: $actual, foo: 0, bar: 1);
        $this->assertEquals(expected: $expected, actual: $actual);
    }

    #[DataProviderExternal(SortDataProvider::class, 'providerBubbleSort')]
    public function testBubbleSort(array $unsorted, array $sorted): void
    {
        (new Sort())->bubbleSort(array: $unsorted);
        $this->assertEquals(expected: $sorted, actual: $unsorted);
    }

    #[DataProviderExternal(SortDataProvider::class, 'providerBubbleSort')]
    public function testMergeSort(array $unsorted, array $sorted): void
    {
        $this->assertEquals(expected: $sorted, actual: (new Sort())->mergeSort(array: $unsorted));
    }
}
