<p align="center" ><img src="https://user-images.githubusercontent.com/17185462/57544423-1ad64d80-7379-11e9-8191-3916f389032e.png"></p>

# Rating system Laravel

Easily setup rating system in your laravel poject

# installation

```bash
composer require code4mk/lara-rating
```

# setup

## 1) vendor publish

```bash
php artisan vendor:publish --provider="Code4mk\LaraRate\LaraRateServiceProvider" --tag=config
php artisan vendor:publish --provider="Code4mk\LaraRate\LaraRateServiceProvider" --tag=migrations
```

## 2) config

* `config/laraRate.php`


```php
"expired" => "PT12M",
"isCodePrefix" => true,
"codePrefix" => "PMM-",
"codeLenght" => 10
```

* `php artisan config:clear`

# method

## `create()`

```php
use Krate;
Krate::create($productID,$userID,$rate,$comment)
```

## `update()`

```php
use Krate;
Krate::update($productID,$userID,$rate,$comment);
```

## `get()`

```php
Krate::get($productID);
```

## `getRate()`

```php
Krate::getRate($productID);
```

<a href="https://twitter.com/0devco" target="_blank" ><p align="center" ><img src="https://raw.githubusercontent.com/0devco/docs/master/.devco-images/logo-transparent.png"></p></a>
