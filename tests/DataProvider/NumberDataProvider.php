<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests\DataProvider;

class NumberDataProvider
{
    public static function providerGreatestCommonDivisor(): array
    {
        return [
            [30, 24, 6, ],
            [75, 15, 15, ],
        ];
    }

    public static function providerLeastCommonMultiple(): array
    {
        return [
            [12, 15, 60, ],
            [12, 75, 300, ],
        ];
    }

    public static function providerIsIntFloat(): array
    {
        return [
            [1, true, ],
            [128, true, ],
            [0, true, ],
            [128.5, false, ],
        ];
    }

    public static function providerEncryption(): array
    {
        return [
            ['Vairogs! 盾牌！ Štít', 'testVAIROGS789', ],
            ['', '123', ],
            ['Vairogs!', '123', ],
        ];
    }
}
