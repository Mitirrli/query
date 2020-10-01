<h1 align="center"> Orm Query </h1>
<p align="center">:rainbow: This package is deprecated, please use Mitirrli/build-query.</p>

[![Build Status](https://travis-ci.org/Mitirrli/query.svg?branch=master)](https://travis-ci.org/Mitirrli/query)
![StyleCI build status](https://github.styleci.io/repos/209699257/shield) 
[![Total Downloads](https://poser.pugx.org/mitirrli/tp-query/downloads)](https://packagist.org/packages/mitirrli/tp-query)
[![Latest Stable Version](https://poser.pugx.org/mitirrli/tp-query/v/stable)](https://packagist.org/packages/mitirrli/tp-query)
[![Latest Unstable Version](https://poser.pugx.org/mitirrli/tp-query/v/unstable)](https://packagist.org/packages/mitirrli/tp-query)
<a href="https://packagist.org/packages/mitirrli/tp-query"><img src="https://poser.pugx.org/mitirrli/tp-query/license" alt="License"></a>

## Environment

- PHP >= 7.0

## Installation

```shell
$ composer require "mitirrli/tp-query"
```

## QuickStart
```
use Mitirrli\TpQuery\Constant\Search;

$this->param($params)
     ->initial(['initial' => 0]) //Set an initial value
     ->key('name', Search::PERCENT_RIGHT) //Right fuzzy search
     ->key('avatar') //Accurate search
     ->key('phone', Search::PERCENT_ALL) //All fuzzy search
     ->inKey('type') //Array search
     ->betweenKey('created_at', 'started_at', 'ended_at') //Between search
     ->beforeKey('id'), //Before Key
     ->afterKey('id'), //After kay
     ->renameKey('backend', 'frontend') //Rename param
     ->unsetKey('initial') //Unset param
     ->result(); //Get result
```  
  
