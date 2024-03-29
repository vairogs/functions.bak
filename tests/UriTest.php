<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests;

use Exception;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Vairogs\Core\Tests\VairogsTestCase;
use Vairogs\Functions\Constants\Definition;
use Vairogs\Functions\Tests\DataProvider\UriDataProvider;
use Vairogs\Functions\Uri;

class UriTest extends VairogsTestCase
{
    #[DataProviderExternal(UriDataProvider::class, 'providerArrayFromQueryString')]
    public function testArrayFromQueryString(string $query, array $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Uri())->arrayFromQueryString(query: $query));
    }

    #[DataProviderExternal(UriDataProvider::class, 'providerGetSchema')]
    public function testGetSchema(string $url, string $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Uri())->getSchema(request: Request::create(uri: $url)));
    }

    #[DataProviderExternal(UriDataProvider::class, 'dataUrlEncode')]
    public function testUrlEncode(string $url): void
    {
        $this->assertEquals(expected: $url, actual: (new Uri())->urlEncode(url: $url));
    }

    /**
     * @throws Exception
     */
    #[DataProviderExternal(UriDataProvider::class, 'providerRouteExists')]
    public function testRouteExists(string $route, bool $expected): void
    {
        $this->assertInstanceOf(expected: RouterInterface::class, actual: $router = $this->container->get(id: 'router', invalidBehavior: ContainerInterface::NULL_ON_INVALID_REFERENCE));
        /* @var RouterInterface $router */
        $this->assertEquals(expected: $expected, actual: (new Uri())->routeExists(router: $router, route: $route));
    }

    #[DataProviderExternal(UriDataProvider::class, 'providerIsUrl')]
    public function testIsUrl(string $url, bool $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Uri())->isUrl(url: $url));
    }

    #[DataProviderExternal(UriDataProvider::class, 'providerIsUrl')]
    public function testIsAbsolute(string $url, bool $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Uri())->isAbsolute(path: $url));
    }

    public function testGetRawParseHeaders(): void
    {
        $headers = Request::create(uri: Definition::IDENT)->headers;
        $headers->set(key: 'test', values: null);
        $this->assertIsArray(actual: $headers = (new Uri())->parseHeaders(rawHeaders: (new Uri())->getRawHeaders(headerBag: $headers)));
        $this->assertArrayHasKey(key: 'user-agent', array: $headers);
        $this->assertEquals(expected: 'Symfony', actual: $headers['user-agent']);
    }
}
