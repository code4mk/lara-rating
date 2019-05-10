<?php

namespace Code4mk\LaraRate;

use Code4mk\LaraRate\Model\Krate;
use Config;
use DB;

class Rate
{

  public function create($productID,$userID,$rate,$comment)
  {
    $findRate = Krate::where('product_id',$productID)
                    ->where('user_id',$userID)
                    ->first();
    if(is_null($findRate)){
      $rateNow = new Krate;
      $rateNow->product_id = $productID;
      $rateNow->user_id = $userID;
      $rateNow->rating = $rate;
      $rateNow->comment = $comment;
      $rateNow->save();
    }else{
      return $findRate;
    }
  }

  public function update($productID,$userID,$rate,$comment)
  {
    $rateNow = Krate::where('product_id',$productID)
                    ->where('user_id',$userID)
                    ->first();
    $rateNow->product_id = $productID;
    $rateNow->user_id = $userID;
    $rateNow->rating = $rate;
    $rateNow->comment = $comment;
    $rateNow->save();
  }

  public function getRatings($productID)
  {
    $rates = Krate::where('product_id',$productID)->get();
      if (!empty(Config::get('laraRate.customer_table_name'))){
        foreach ($rates as $key => $v) {
          $user = DB::table(Config::get('laraRate.customer_table_name'))->where('id',$v['user_id'])->first(Config::get('laraRate.customer_retrive_column'));
          $v["customer"] = $user;
        }
      }

    return  $rates;
  }

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
