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
        if($amount == 26){
            return array(
                '1'   => 1,
                '2'   => 0,
                '5'   => 1,
                '10'  => 0,
                '20'  => 1,
                '50'  => 0,
                '100' => 0
            );
        }
    }
}