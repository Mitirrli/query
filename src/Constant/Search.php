<?php

declare(strict_types=1);

namespace Mitirrli\TpQuery\Constant;

abstract class Search
{
    /**
     * @const 精确查询
     */
    const PERCENT_NONE = 0;

    /**
     * @const 左右模糊查询
     */
    const PERCENT_ALL = 1;

    /**
     * @const 右模糊查询
     */
    const PERCENT_RIGHT = 2;
}
