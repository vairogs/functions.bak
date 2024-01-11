<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use Vairogs\Core\Tests\VairogsTestCase;
use Vairogs\Functions\Pagination;
use Vairogs\Functions\Tests\DataProvider\PaginationDataProvider;

class PaginationTest extends VairogsTestCase
{
    #[DataProviderExternal(PaginationDataProvider::class, 'provider')]
    public function testPagination(int $visible, int $total, int $current, int $indicator, array $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Pagination())->paginate(visible: $visible, total: $total, current: $current, indicator: $indicator));
    }

    #[DataProviderExternal(PaginationDataProvider::class, 'providerException')]
    public function testPaginationException(int $visible, int $total, int $current, int $indicator, array $expected): void
    {
        try {
            $this->assertEquals(expected: $expected, actual: (new Pagination())->paginate(visible: $visible, total: $total, current: $current, indicator: $indicator));
        } catch (InvalidArgumentException $exception) {
            $this->assertInstanceOf(expected: InvalidArgumentException::class, actual: $exception);
        }
    }
}
