<?php

namespace app\common\traits;

/**
 * 查询Trait
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
    private $params;

    /**
     * 获取用户参数.
     *
     * @param array $params
     *
     * @return SearchTrait
     */
    public function param($params)
    {
        $this->params = $params;

        return $this;
    }

    /**
     * 设置当前默认数组.
     *
     * @param $init array
     *
     * @return SearchTrait
     */
    public function initial($init)
    {
        $this->init = $init;

        return $this;
    }

    /**
     * 赋值
     *
     * @param string $key   参数名
     * @param int    $fuzzy 0精确查询,1模糊查询
     *
     * @return SearchTrait
     */
    public function key($key, $fuzzy = 0)
    {
        if (isset($this->params[$key]) && !empty($this->params[$key])) {
            $this->init[$key] = $fuzzy ? ['LIKE', '%'.$this->params[$key].'%'] : $this->params[$key];
        }

        return $this;
    }

    /**
     * orWhere查询.
     *
     * @param string $key   参数名
     * @param int    $fuzzy 0精确查询,1模糊查询
     * @param string $name  统一的参数名
     *
     * @return SearchTrait
     */
    public function orKey($key, $fuzzy = 0, $name = '')
    {
        if (isset($this->params[$name]) && !empty($this->params[$name])) {
            $this->init[$key] = $fuzzy ? ['LIKE', '%'.$this->params[$name].'%'] : $this->params[$name];
        }

        return $this;
    }

    /**
     * 获取结果.
     *
     * @return array
     */
    public function result()
    {
        return $this->init;
    }
}
