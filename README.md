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
"rater_table_name" => "users",
"rater_retrive_columns" =>["id","email"]
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

## `getRatings()`

* get specific product's rating details

```php
Krate::getRatings($productID);
```
* output

~ `Krate::getRatings(3)`

```json
[
  {
    "id": 1,
    "product_id": 3,
    "rater_id": 3,
    "rating": 5,
    "comment": "5star",
    "created_at": "2019-05-10 16:25:10",
    "updated_at": "2019-05-10 16:25:10",
    "rater": {
      "id": 3,
      "email": "maruf@gmail.com"
    }
  },
  {
    "id": 2,
    "product_id": 3,
    "rater_id": 2,
    "rating": 2,
    "comment": "2star",
    "created_at": "2019-05-10 16:26:58",
    "updated_at": "2019-05-10 16:26:58",
    "rater": {
      "id": 2,
      "email": "jamal@gmail.com"
    }
  }
]
```


## `getRatingStat()`

* rating type

```php
Krate::getRatingStat($productID);
```


* output  

~ `Krate::getRatingStat(3)`

```json
{
    "rateType": {
        "one_star": {
            "star": 0,
            "percent": 0
        },
        "two_star": {
            "star": 1,
            "percent": 50
        },
        "three_star": {
            "star": 0,
            "percent": 0
        },
        "four_star": {
            "star": 0,
            "percent": 0
        },
        "five_star": {
            "star": 1,
            "percent": 50
        }
    },
    "total_rater": 2,
    "rating": 4
}
```



<a href="https://twitter.com/0devco" target="_blank" ><p align="center" ><img src="https://raw.githubusercontent.com/0devco/docs/master/.devco-images/logo-transparent.png"></p></a>
