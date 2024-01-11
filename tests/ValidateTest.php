<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests;

use PHPUnit\Framework\Attributes\DataProviderExternal;
use Vairogs\Core\Tests\VairogsTestCase;
use Vairogs\Functions\Tests\DataProvider\ValidateDataProvider;
use Vairogs\Functions\Validate;

class ValidateTest extends VairogsTestCase
{
    #[DataProviderExternal(ValidateDataProvider::class, 'providerValidateEmail')]
    public function testValidateEmail(string $email, bool $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Validate())->validateEmail(email: $email));
    }

    #[DataProviderExternal(ValidateDataProvider::class, 'providerValidateIP')]
    public function testValidateIP(string $ip, bool $deny, bool $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Validate())->validateIPAddress(ipAddress: $ip, deny: $deny));
    }

    #[DataProviderExternal(ValidateDataProvider::class, 'providerValidateCIDR')]
    public function testValidateCIDR(string $cidr, bool $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Validate())->validateCIDR(cidr: $cidr));
    }
}
