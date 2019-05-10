<?php

namespace Code4mk\LaraRate;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Code4mk\LaraRate\Rate as LaraRating;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @since     2019
 * @copyright 0dev.co (https://0dev.co)
 */

class LaraRateServiceProvider extends ServiceProvider
{
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
   public function boot()
   {
     // publish database
     $this->publishes([
       __DIR__ . '/../migrations/' => base_path('/database/migrations'),
      ], 'migrations');
     // publish config
     $this->publishes([
       __DIR__ . '/../config/laraRate.php' => config_path('laraRate.php'),
     ], 'config');

      AliasLoader::getInstance()->alias('Krate', 'Code4mk\LaraRate\Facades\Rating');
   }

  /**
   * Register any application services.
   *
   * @return void
   */
   public function register()
   {
     $this->app->bind('lara_rate', function () {
      return new LaraRating;
     });
   }
}
