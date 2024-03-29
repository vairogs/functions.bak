<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests\DataProvider;

use Vairogs\Functions\Iteration;
use Vairogs\Functions\Util;

class FunctionHandlerDataProvider
{
    public static function provider(): array
    {
        return [
            ['is_string', null, true, 'vairogs', ],
            ['getIfSet', new Iteration(), null, [], 'vairogs', ],
            ['isPrime', new Util(), true, 3, ],
        ];
    }
}
