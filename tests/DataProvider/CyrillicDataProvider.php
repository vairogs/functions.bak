<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests\DataProvider;

class CyrillicDataProvider
{
    public static function providerCyrillicToLatin(): array
    {
        return [
            ['юнит-тест', 'yunit-tyest', ],
            ['интеграция', 'intyegratsiya', ],
        ];
    }

    public static function providerLatinToCyrillic(): array
    {
        return [
            ['yunit-tyest', 'юнит-тест', ],
            ['intyegratsiya', 'интеграция', ],
        ];
    }

    public static function providerGetCountryName(): array
    {
        return [
            ['LV', 'en', 'Latvia', ],
            ['lv', 'lv', 'Latvija', ],
        ];
    }
}
