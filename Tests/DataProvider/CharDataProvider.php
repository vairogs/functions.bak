<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests\DataProvider;

class CharDataProvider
{
    public static function providerSanitizeFloat(): array
    {
        return [
            ['0.56', 0.56, ],
            ['1', 1.00, ],
            ['a', 0.00, ],
            ['a1', 1.00, ],
        ];
    }

    public static function providerToSnakeCase(): array
    {
        return [
            ['VairogsHelper', false, 'vairogshelper', ],
            ['VairogsHelper', true, 'vairogs_helper', ],
        ];
    }

    public static function providerFromCamelCase(): array
    {
        return [
            ['VairogsHelper', '_', 'vairogs_helper', ],
            ['VairogsHelper', '', 'vairogshelper', ],
        ];
    }

    public static function providerToCamelCaseLCFirst(): array
    {
        return [
            ['vairogs_helper', 'vairogsHelper', ],
        ];
    }

    public static function providerToCamelCaseUCFirst(): array
    {
        return [
            ['vairogshelper', 'Vairogshelper', ],
            ['hello_world', 'HelloWorld', ],
        ];
    }
}
