<?php

declare(strict_types=1);

namespace Mitirrli\TpQuery\Constant;

abstract class TestData
{
    const TEST_DATA1 = [
        ['test1' => 'data'],
        ['test2' => 'hello'],
        ['test3' => 'php'],
        ['test4' => '*qq#'],
    ];

    const TEST_DATA2 = [
        'name' => 'hello',
        'language' => 'php',
        'test' => 'phpUnit',
    ];

    const TEST_DATA3 = [
        'JS' => 'HTML',
        'PHP' => 'MYSQL',
        'C' => 'DLL',
    ];

    const TEST_DATA4 = [
        'UN_UNIQUE_KEY' => [1, 1, 2, 3, 4],
    ];

    const TEST_DATA5 = [
        'start' => 0,
        'end' => 22,
    ];
}
