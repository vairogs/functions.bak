<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests\DataProvider;

use Vairogs\Functions\Text;

class ReflectionDataProvider
{
    private const HELPER_NAMESPACE = 'Vairogs\Functions';

    public static function providerGetNamespace(): array
    {
        return [
            [Text::class, self::HELPER_NAMESPACE, ],
            ['Test', '\\', ],
        ];
    }
}
