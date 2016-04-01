<?php

class WhiteRabbit3
{

    public function multiplyBy($amount, $multiplier){
        $estimatedResult = $amount * $multiplier;

        $guess = abs($amount-7);
        while(abs($estimatedResult - $amount) > 0.49 && $guess != 0){
            if($guess > 0.49)
                $guess = $guess / 2;
            if($amount > $estimatedResult){
                $amount = $amount - $guess;
            }
            else{
                $amount = $amount + $guess;
            }
        }
        return round($amount);
    }
}