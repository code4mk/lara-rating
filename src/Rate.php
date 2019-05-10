<?php

namespace Code4mk\LaraRate;

/**
 * @author    @code4mk <hiremostafa@gmail.com>
 * @author    @0devco <with@0dev.co>
 * @copyright 0dev.co (https://0dev.co)
 */

use Code4mk\LaraRate\Model\Krate;
use Config;
use DB;

class Rate
{
  /**
   * Create a rating for a product
   *
   * @param int $productID
   * @param int $raterID
   * @param int $rate
   * @param str $comment
   * @return void
   */
  public function create($productID,$raterID,$rate,$comment)
  {
    $rateNow = new Krate;
    $rateNow->product_id = $productID;
    $rateNow->user_id = $raterID;
    $rateNow->rating = $rate;
    $rateNow->comment = $comment;
    $rateNow->save();
  }

  /**
   * Update a rating with given  product id and rater id
   *
   * @param int $productID
   * @param int $raterID
   * @param int $rate
   * @param str $comment
   * @return void
   */
  public function update($productID,$raterID,$rate,$comment)
  {
    $rateNow = Krate::where('product_id',$productID)
                    ->where('user_id',$raterID)
                    ->first();
    $rateNow->product_id = $productID;
    $rateNow->user_id = $raterID;
    $rateNow->rating = $rate;
    $rateNow->comment = $comment;
    $rateNow->save();
  }

  /**
   * Get rating lists with product id
   *
   * @param $productID integer
   * @return array $rates
   */
  public function getRatings($productID)
  {
    $rates = Krate::where('product_id',$productID)->get();
      if (!empty(Config::get('laraRate.customer_table_name'))){
        foreach ($rates as $key => $v) {
          $user = DB::table(Config::get('laraRate.customer_table_name'))
                    ->where('id',$v['user_id'])
                    ->first(Config::get('laraRate.customer_retrive_columns'));
          $v["rater"] = $user;
        }
      }
    return  $rates;
  }

  /**
   * Get rating statistics with product id
   *
   * @param $productID integer
   * @return array $rates
   */
  public function getRatingStat($productID)
  {
    $rates = Krate::where('product_id',$productID)->get();

    $oneStar = collect($rates)->where('rating',1)->count();
    $twoStar = collect($rates)->where('rating',2)->count();
    $threeStar = collect($rates)->where('rating',3)->count();
    $fourStar = collect($rates)->where('rating',4)->count();
    $fiveStar = collect($rates)->where('rating',5)->count();
    $sum = collect($rates)->sum('rating');
    $person = collect($rates)->count();
    $rate = $sum / $person;

    return [
      'rateType' => [
        "one_star" => [
          "star" => $oneStar,
          "percent" => round((100/$person) * $oneStar)
        ],
        "two_star" => [
          "star" => $twoStar,
          "percent" => round((100/$person) * $twoStar)
        ],
        "three_star" => [
          "star" => $threeStar,
          "percent" => round((100/$person) * $threeStar)
        ],
        "four_star" => [
          "star" => $fourStar,
          "percent" => round((100/$person) * $fourStar)
        ],
        "five_star" => [
          "star" => $fiveStar,
          "percent" => round((100/$person) * $fiveStar)
        ],
      ],
      "total_rater" => $person,
      "rating" => round($rate),
    ];
  }
}
