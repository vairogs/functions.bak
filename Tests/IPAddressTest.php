<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use Symfony\Component\HttpFoundation\Request;
use Vairogs\Core\Tests\VairogsTestCase;
use Vairogs\Functions\Constants\Definition;
use Vairogs\Functions\Constants\Http;
use Vairogs\Functions\IPAddress;
use Vairogs\Functions\Tests\DataProvider\IPAddressDataProvider;

class IPAddressTest extends VairogsTestCase
{
    #[DataProviderExternal(IPAddressDataProvider::class, 'providerGetCIDRRange')]
    public function testGetCIDRRange(string $cidr, bool $int, ?array $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new IPAddress())->getCIDRRange(cidr: $cidr, int: $int));
    }

    #[DataProviderExternal(IPAddressDataProvider::class, 'providerGetRemoteIpCF')]
    public function testGetRemoteIpCF(?string $ipHeader, ?string $ipCF, bool $trust, string $expected): void
    {
        $request = Request::create(uri: Definition::IDENT);

        if (null !== $ipHeader) {
            $request->server->set(key: Http::HTTP_X_REAL_IP, value: $ipHeader);
        }

        if (null !== $ipCF) {
            $request->server->set(key: Http::HTTP_CF_CONNECTING_IP, value: $ipCF);
        }

        $this->assertEquals(expected: $expected, actual: (new IPAddress())->getRemoteIpCF(request: $request, trust: $trust));
    }
}
