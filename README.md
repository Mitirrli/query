## Trait实现多继承，实现代码的复用，链式调用简化了代码，易于调试
  
### quickStart
```
use Mitirrli\TpQuery\Constant\Search;

$this->param($params)
     ->initial(['inital' => 0]) //用于给定一个初始值
     ->key('name', 1) //key()用于给定查询的字段,第二个参数为1左右模糊查询,2右模糊查询
     ->key('avatar')
     ->key('phone', Search::PERCENT_ALL)
     ->key('province')
     ->key('city')
     ->key('country')
     ->result(); //获取最后的数组集
```  
  