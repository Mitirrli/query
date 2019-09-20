通过trait实现多继承，实现代码的复用
通过链式调用简化了代码，易于调试

使用方法：$this->param($params)->initial(['is_delete' => 1, 'uid' => $params['uid']])
            ->key('name', 1)->key('department')->key('company', 1)->key('province')->key('city')->key('country')
            ->result();

initial()用于给定一个初始值
key()用于给定查询的字段,key的第二个参数若为1,则为模糊查询
result()用于获取最后的数组集
