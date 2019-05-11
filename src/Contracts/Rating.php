<?php

namespace Code4mk\LaraRate\Contracts;

/**
 * Rating interface
 */
interface Rating
{
  /**
   * Create a rating for a product.
   *
   * @param int $productID
   * @param int $raterID
   * @param int $rate
   * @param string $comment
   * @return void
   */
  public function create($productID,$raterID,$rate,$comment);

  /**
   * Update a rating with given  product id and rater id.
   *
   * @param int $productID
   * @param int $raterID
   * @param int $rate
   * @param string $comment
   * @return void
   */
  public function update($productID,$raterID,$rate,$comment);

  /**
   * Get rating lists with product id.
   *
   * @param int $productID
   * @return array $rates
   */
  public function getRatings($productID);

  /**
   * Get rating statistics with product id.
   *
   * @param $productID integer
   * @return array $rates
   */
  public function getRatingStat($productID);
}
