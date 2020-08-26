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
     *
     * @var array
     */
    private $init = [];

    /**
     * 用户参数.
     *
     * @var
     */
    private $params = [];

    /**
     * 获取用户参数.
     */
    public function param(array $params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * 设置当前默认数组.
     *
     * @param $init array
     */
    public function initial(array $init)
    {
        $this->init = $init;

        return $this;
    }

    /**
     * 赋值.
     *
     * @param string $key   参数名
     * @param int    $fuzzy 0精确查询,1模糊查询,2右模糊查询
     */
    public function key(string $key, int $fuzzy = Search::PERCENT_NONE)
    {
        if (isset($this->params[$key]) && !empty($this->params[$key])) {
            $this->init[$key] = $fuzzy ? ['LIKE', SearchParam::getParam($this->params[$key], $fuzzy)] : $this->params[$key];
        }

        return $this;
    }

    /**
     * 重命名参数并赋值.
     *
     * @param string $key   参数名
     * @param string $name  先前的参数名
     * @param int    $fuzzy 0精确查询,1左右模糊查询,2右模糊查询
     */
    public function renameKey(string $key, string $name = '', int $fuzzy = Search::PERCENT_NONE)
    {
        if (isset($this->params[$name]) && !empty($this->params[$name])) {
            $this->init[$key] = $fuzzy ? ['LIKE', SearchParam::getParam($this->params[$name], $fuzzy)] : $this->params[$name];
        }

        return $this;
    }

    /**
     * In查询.
     *
     * @param string $key 参数名
     */
    public function inKey(string $key)
    {
        if (isset($this->params[$key]) && !empty($this->params[$key])) {
            if (is_string($this->params[$key])) {
                $this->params[$key] = explode(',', $this->params[$key]);
            }
            $this->init[$key] = ['IN', array_unique($this->params[$key])];
        }

        return $this;
    }

    /**
     * Between查询.
     *
     * @param string $key 参数名
     */
    public function betweenKey(string $key, string $start = '', string $end = '')
    {
        if (isset($this->params[$end]) && isset($this->params[$start])) {
            $this->init[$key] = ['BETWEEN', [$this->params[$start], $this->params[$end]]];
        }

        if (!isset($this->params[$end]) && isset($this->params[$start])) {
            $this->init[$key] = ['>=', $this->params[$start]];
        }
        if (!isset($this->params[$start]) && isset($this->params[$end])) {
            $this->init[$key] = ['<=', $this->params[$end]];
        }

        return $this;
    }

    /**
     * 正序某Key之前.
     *
     * @return $this
     */
    public function beforeKey(string $key)
    {
        if (isset($this->params[$key]) && !empty($this->params[$key])) {
            $this->init[$key] = ['<', $this->params[$key]];
        }

        return $this;
    }

    /**
     * 正序某Key之后.
     *
     * @return $this
     */
    public function afterKey(string $key)
    {
        if (isset($this->params[$key]) && !empty($this->params[$key])) {
            $this->init[$key] = ['>', $this->params[$key]];
        }

        return $this;
    }

    /**
     * Unset无用的参数.
     *
     * @param string $key 参数名
     */
    public function unsetKey(...$key)
    {
        array_map(function ($value) {
            unset($this->init[$value]);
        }, $key);

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
