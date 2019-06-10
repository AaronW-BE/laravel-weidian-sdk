### Weidian SDK for Laravel

#### 安装
```
composer require 
```

#### 配置
* 在 config/app.php 注册 ServiceProvider 和 Facade (Laravel 5.5 + 无需手动注册)
```php
'providers' => [
    // ...
],
'aliases' => [
    // ...
],
```
* 发布配置文件
```
php artisan vendor:publish --provider=""
```
* 修改配置文件中的参数

#### 使用
```php
        $cmd = "微店接口名";
        $param = [];// 接口参数，公共参数已处理，仅需传递接口参数
        $v = "1.0";
        $res = Weidian::request($cmd, $param, $v)->send();
        return $this->success($res);
```