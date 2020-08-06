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
}
