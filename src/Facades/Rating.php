<?php

namespace Code4mk\LaraRate\Facades;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

use Illuminate\Support\Facades\Facade;

/**
 * @method static void create($productID,$raterID,$rate,$comment)
 * @method static void update($productID,$raterID,$rate,$comment)
 * @method static array getRatings($productID)
 * @method statis array getRatingStat($productID)
 *
 * @see Code4mk\LaraRate\Rate
 */
class Rating extends Facade
{
  /**
   * Get the registered name of the component.
   *
   * @return string
   */
  protected static function getFacadeAccessor()
  {
      return 'lara_rate';
  }
}
