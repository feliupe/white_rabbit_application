<?php

class WhiteRabbit2
{
    /**
     * return a php array, that contains the amount of each type of coin, required to fulfill the amount.
     * The returned array should use as few coins as possible.
     * The coins available for use is: 1, 2, 5, 10, 20, 50, 100
     * You can assume that $amount will be an int
     */
    public function findCashPayment($amount){

      $payment = array(
          '1'   => 0,
          '2'   => 0,
          '5'   => 0,
          '10'  => 0,
          '20'  => 0,
          '50'  => 0,
          '100' => 0
      );

      if ($amount <= 0){

        return $payment;
      }

      $coins = array(1,2,5,10,20,50,100);

      $greatestValue = end($coins);

      while ($amount != 0){

        if ($amount < $greatestValue){

          $greatestValue = prev($coins);
        }

        $payment[$greatestValue] = floor($amount / $greatestValue);

        $amount = $amount % $greatestValue;
      }

      return $payment;
    }
}

?>
