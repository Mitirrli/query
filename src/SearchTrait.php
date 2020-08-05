<?php

declare(strict_types=1);

namespace Mitirrli\TpQuery;

use Mitirrli\TpQuery\Constant\Search;
use Mitirrli\TpQuery\Query\SearchParam;

/**
 * Trait SearchTrait.
 */
trait SearchTrait
{
    /**
     * 初始数组 默认为空数组.
     * @var array
     */
    private $init = [];

    /**
     * 用户参数.
     * @var
     */
    private $params = [];

    /**
     * 获取用户参数.
     */
    public function param(array $params): SearchTrait
    {
        $this->params = $params;

        return $this;
    }

    /**
     * 设置当前默认数组.
     * @param $init array
     */
    public function initial(array $init): SearchTrait
    {
        $this->init = $init;

        return $this;
    }

    /**
     * 赋值
     * @param string $key 参数名
     * @param int $fuzzy 0精确查询,1模糊查询,2右模糊查询
     */
    public function key(string $key, int $fuzzy = Search::PERCENT_NONE): SearchTrait
    {
        if (isset($this->params[$key]) && ! empty($this->params[$key])) {
            $this->init[$key] = $fuzzy ? ['LIKE', SearchParam::getParam($this->params['key'], $fuzzy)] : $this->params[$key];
        }

        return $this;
    }

    /**
     * orWhere查询.
     * @param string $key 参数名
     * @param int $fuzzy 0精确查询,1左右模糊查询,2右模糊查询
     * @param string $name 统一的参数名
     */
    public function orKey(string $key, int $fuzzy = Search::PERCENT_NONE, string $name = ''): SearchTrait
    {
        if (isset($this->params[$name]) && ! empty($this->params[$name])) {
            $this->init[$key] = $fuzzy ? ['LIKE', SearchParam::getParam($this->params['key'], $fuzzy)] : $this->params[$name];
        }

        return $this;
    }

    /**
     * 获取结果.
     */
    public function result(): array
    {
        return $this->init;
    }
}
