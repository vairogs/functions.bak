<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use Vairogs\Core\Tests\VairogsTestCase;
use Vairogs\Functions\SortLatvian;
use Vairogs\Functions\Tests\DataProvider\SortLatvianDataProvider;

class SortLatvianTest extends VairogsTestCase
{
    #[DataProviderExternal(SortLatvianDataProvider::class, 'providerSortLatvian')]
    public function testSortLatvian(array|object $unsorted, string|int $field, array|object $sorted): void
    {
        (new SortLatvian())->sortLatvian(names: $unsorted, field: $field);
        $this->assertEquals(expected: $sorted, actual: $unsorted);
    }
}
