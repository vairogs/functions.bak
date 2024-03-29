<?php declare(strict_types = 1);

namespace Vairogs\Functions\Tests\DataProvider;

use Vairogs\Functions\Iteration;

use const PHP_INT_MAX;

class IterationDataProvider
{
    public static function providerIsEmpty(): array
    {
        return [
            [0, true, ],
            [[], true, ],
            [[[], ], true, ],
            [[['', ], ], true, ],
            [['vairogs', ], false, ],
        ];
    }

    public static function providerMakeMultiDimensional(): array
    {
        return [
            [[], [], ],
            [['vairogs', ], [['vairogs', ], ], ],
            [[['vairogs', ]], [['vairogs', ], ], ],
        ];
    }

    public static function providerUniqueMap(): array
    {
        return [
            [['vairogs', 'test', 'vairogs', ], ['vairogs', 'test', ], ],
            [['vairogs', 'test', ], ['vairogs', 'test', ], ],
            [[['vairogs', ], ['test', ], ['vairogs', ], ], [['vairogs', ], ['test', ], ], ],
        ];
    }

    public static function providerUnique(): array
    {
        return [
            [['vairogs', 'test', 'vairogs', ], ['vairogs', 'test', ], true, ],
            [['vairogs', 'test', ], ['vairogs', 'test', ], false, ],
            [[['vairogs', ], ['test', ], ['vairogs', ], ], [['vairogs', ], ['test', ], ['vairogs', ], ], false, ],
        ];
    }

    public static function providerArrayIntersectKeyRecursive(): array
    {
        return [
            [[1 => 'test', 2 => 'data', ], ['test', 'test2', ], [1 => 'test', ], ],
            [[['test', ], 'test2', ], [['test', ], 'test2', ], [['test', ], 'test2', ], ],
        ];
    }

    public static function providerArrayFlipRecursive(): array
    {
        return [
            [[1 => 'a', 2 => 'b', 'c' => 3, ], ['a' => 1, 'b' => 2, 3 => 'c', ], ],
            [['1' => new Iteration(), 2 => 'test', ], [1 => new Iteration(), 'test' => 2, ], ],
        ];
    }

    public static function providerMakeOneDimension(): array
    {
        $array = [
            'vairogs' => [
                'cache' => [
                    'enabled' => true,
                ],
            ],
        ];

        return [
            [
                $array, false, 0, PHP_INT_MAX,
                [
                    'vairogs.cache.enabled' => true,
                    'vairogs.cache' => [
                        'enabled' => true,
                    ],
                    'vairogs' => [
                        'cache' => [
                            'enabled' => true,
                        ],
                    ],
                ],
            ],
            [
                $array, true, 1, PHP_INT_MAX,
                [
                    'vairogs.cache.enabled' => true,
                ],
            ],
            [
                $array, false, 0, 0, $array,
            ],
        ];
    }
}
