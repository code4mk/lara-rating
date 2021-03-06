<?php

namespace Code4mk\LaraRate;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\AliasLoader;
use Code4mk\LaraRate\Rate;

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
       // Publish migrations
       __DIR__ . '/../migrations/' => base_path('/database/migrations'),
      ], 'migrations');
     // Publish config
     $this->publishes([
       __DIR__ . '/../config/laraRate.php' => config_path('laraRate.php'),
     ], 'config');
     // Set alias
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
      return new Rate;
     });
   }
}
