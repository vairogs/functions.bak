<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests;

use DateTimeInterface;
use Exception;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProviderExternal;
use Vairogs\Core\Tests\VairogsTestCase;
use Vairogs\Functions\Date;
use Vairogs\Functions\Tests\DataProvider\DateDataProvider;

class DateTest extends VairogsTestCase
{
    #[DataProviderExternal(DateDataProvider::class, 'providerValidateDate')]
    public function testValidateDate(string $date, bool $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Date())->validateDate(date: $date));
    }

    #[DataProviderExternal(DateDataProvider::class, 'providerGetDateWithoutFormat')]
    public function testGetDateWithoutFormat(string $date): void
    {
        $this->assertInstanceOf(expected: DateTimeInterface::class, actual: (new Date())->getDateWithoutFormat(date: $date));
    }

    #[DataProviderExternal(DateDataProvider::class, 'providerGetDateWithoutFormatWrong')]
    public function testGetDateWithoutFormatWrong(string $date): void
    {
        $this->assertNotInstanceOf(expected: DateTimeInterface::class, actual: (new Date())->getDateWithoutFormat(date: $date));
    }

    #[DataProviderExternal(DateDataProvider::class, 'providerExcelDate')]
    public function testExcelDate(int $timestamp, string $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Date())->excelDate($timestamp));
    }

    #[DataProviderExternal(DateDataProvider::class, 'providerFormatDate')]
    public function testFormatDate(string $date, string $format, string $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Date())->formatDate(string: $date, format: $format));
    }

    #[DataProviderExternal(DateDataProvider::class, 'providerFormatDateWrong')]
    public function testFormatDateWrong(string $date, string $format): void
    {
        $this->assertFalse(condition: (new Date())->formatDate(string: $date, format: $format));
    }

    /**
     * @throws Exception
     */
    #[DataProviderExternal(DateDataProvider::class, 'providerCreateFromUnixTimestamp')]
    public function testCreateFromUnixTimestamp(int $timestamp, ?string $format, string $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Date())->createFromUnixTimestamp(timestamp: $timestamp, format: $format));
    }

    #[DataProviderExternal(DateDataProvider::class, 'providerGetDateNullable')]
    public function testGetDateNullable(?string $date, ?string $format, ?string $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Date())->getDateNullable(dateString: $date, format: $format)?->format(format: Date::FORMAT));
    }

    #[DataProviderExternal(DateDataProvider::class, 'providerGetDate')]
    public function testGetDate(string $date, string $format, string $expected): void
    {
        $this->assertEquals(expected: $expected, actual: (new Date())->getDate(dateString: $date, format: $format)->format(format: $format));
    }

    #[DataProviderExternal(DateDataProvider::class, 'providerGetDateWrong')]
    public function testGetDateWrong(?string $date, ?string $format): void
    {
        $this->expectException(exception: InvalidArgumentException::class);
        (new Date())->getDate(dateString: $date, format: $format);
    }
}
