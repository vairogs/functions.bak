<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests;

use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use Vairogs\Core\Tests\VairogsTestCase;
use Vairogs\Functions\Order;
use Vairogs\Functions\Tests\Assets\Model\Entity;
use Vairogs\Functions\Tests\DataProvider\OrderDataProvider;

class OrderTest extends VairogsTestCase
{
    #[DataProviderExternal(OrderDataProvider::class, 'providerSort')]
    public function testSort(array|object $data, string $parameter, string $order, array $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Order())->sort(data: $data, parameter: $parameter, order: $order));
    }

    #[DataProviderExternal(OrderDataProvider::class, 'providerSortException')]
    public function testSortException(iterable|object $data, string $parameter, string $order): void
    {
        $this->expectException(exception: InvalidArgumentException::class);
        (new Order())->sort(data: $data, parameter: $parameter, order: $order);
    }

    public function testIsSortable(): void
    {
        $entity = (new Entity())
            ->setId(id: 1);

        $this->assertFalse(condition: (new Order())->isSortable(item: 1, field: 'value'));
        $this->assertFalse(condition: (new Order())->isSortable(item: $entity, field: 'test'));
        $this->assertTrue(condition: (new Order())->isSortable(item: $entity, field: 'id'));
    }
}
