<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests\DataProvider;

use DateTimeImmutable;
use DateTimeInterface;
use Vairogs\Functions\Date;

class DateDataProvider
{
    public static function providerValidateDate(): array
    {
        return [
            ['08.04.2022', true, ],
            ['08.13.2022', false, ],
            ['00.00.0000', false, ],
        ];
    }

    public static function providerGetDateWithoutFormat(): array
    {
        return [
            [(new DateTimeImmutable())->format(format: DateTimeInterface::ATOM), ],
            [(new DateTimeImmutable())->format(format: DateTimeInterface::RFC1123), ],
            [(new DateTimeImmutable())->format(format: DateTimeInterface::RFC3339_EXTENDED), ],
            [(new DateTimeImmutable())->format(format: DateTimeInterface::W3C), ],
        ];
    }

    public static function providerGetDateWithoutFormatWrong(): array
    {
        return [
            ['02-02-98', ],
            ['08-04-2022', ],
            ['08-08-02', ],
            ['12-13-2022', ],
        ];
    }

    public static function providerExcelDate(): array
    {
        return [
            [25559, '25559', ],
            [25569, '01-01-1970 00:00:00', ],
            [44659, '08-04-2022 00:00:00', ],
        ];
    }

    public static function providerFormatDate(): array
    {
        $dateTime = new DateTimeImmutable();

        return [
            [$dateTime->format(format: DateTimeInterface::ATOM),  DateTimeInterface::ATOM, $dateTime->format(format: Date::FORMAT)],
            [$dateTime->format(format: DateTimeInterface::RFC3339_EXTENDED), DateTimeInterface::RFC3339_EXTENDED, $dateTime->format(format: Date::FORMAT)],
        ];
    }

    public static function providerFormatDateWrong(): array
    {
        $dateTime = new DateTimeImmutable();

        return [
            [$dateTime->format(format: DateTimeInterface::ATOM), DateTimeInterface::RFC1036],
            [$dateTime->format(format: DateTimeInterface::RFC3339_EXTENDED), DateTimeInterface::ATOM],
        ];
    }

    public static function providerCreateFromUnixTimestamp(): array
    {
        return [
            [1649403032, DateTimeInterface::ATOM, (new DateTimeImmutable())->setTimestamp(timestamp: 1649403032)->format(format: DateTimeInterface::ATOM)],
            [1649403032, null, (new DateTimeImmutable())->setTimestamp(timestamp: 1649403032)->format(format: Date::FORMAT)],
        ];
    }

    public static function providerGetDateNullable(): array
    {
        $dateTime = new DateTimeImmutable();

        return [
            [$dateTime->format(format: DateTimeInterface::ATOM), DateTimeInterface::ATOM, $dateTime->format(format: Date::FORMAT)],
            [null, null, null],
        ];
    }

    public static function providerGetDate(): array
    {
        $dateTime = new DateTimeImmutable();

        return [
            [$dateTime->format(format: DateTimeInterface::ATOM), DateTimeInterface::ATOM, $dateTime->format(format: DateTimeInterface::ATOM)],
        ];
    }

    public static function providerGetDateWrong(): array
    {
        return [
            [null, null],
            ['test', DateTimeInterface::ATOM],
        ];
    }
}
