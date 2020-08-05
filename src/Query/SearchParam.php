<?php

declare(strict_types=1);

namespace Mitirrli\TpQuery\Query;

use Mitirrli\TpQuery\Constant\Search;

final class SearchParam
{
    /**
     * 生成不同的待查询参数.
     */
    public static function getParam(string $key, int $fuzzy): string
    {
        switch ($fuzzy) {
            case Search::PERCENT_RIGHT:
                return $key . '%';
            default:
                return '%' . $key . '%';
        }
    }
}
