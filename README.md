<h1 align="center"> Thinkphp query </h1>
<p align="center">:rainbow: 用于tp5的查询封装</p>

[![Total Downloads](https://poser.pugx.org/mitirrli/tp-query/downloads)](https://packagist.org/packages/mitirrli/tp-query)
[![Latest Stable Version](https://poser.pugx.org/mitirrli/tp-query/v/stable)](https://packagist.org/packages/mitirrli/tp-query)
[![Latest Unstable Version](https://poser.pugx.org/mitirrli/tp-query/v/unstable)](https://packagist.org/packages/mitirrli/tp-query)
<a href="https://packagist.org/packages/mitirrli/tp-query"><img src="https://poser.pugx.org/mitirrli/tp-query/license" alt="License"></a>
  
### QuickStart
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
  