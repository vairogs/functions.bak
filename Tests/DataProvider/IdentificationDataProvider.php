<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests\DataProvider;

class IdentificationDataProvider
{
    public static function providerValidatePersonCode(): array
    {
        return [
            ['150193-10933', true, ],
            ['11111', false, ],
            ['323232', false, ],
            ['320511-36626', true, ],
            ['320312-34357', false, ],
            ['330312-34357', false, ],
        ];
    }

    public static function providerHash(): array
    {
        return [
            ['vairogs', true, 'vairogs', ],
            ['', true, '', ],
            ['vairogs', false, 'vairogs2', ],
        ];
    }
}
