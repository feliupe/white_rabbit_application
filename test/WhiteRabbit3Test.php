<?php

namespace test;

require_once(__DIR__ . "/../src/WhiteRabbit3.php");

use PHPUnit_Framework_TestCase;
use WhiteRabbit3;

class WhiteRabbit3Test extends PHPUnit_Framework_TestCase
{
    /** @var WhiteRabbit3 */
    private $whiteRabbit3;

    public function setUp()
    {
        parent::setUp();
        $this->whiteRabbit3 = new WhiteRabbit3();
    }

    //SECTION FILE !
    /**
     * @dataProvider multiplyProvider
     */
    public function testMultiply($expected, $amount, $multiplier){
        $this->assertEquals($expected, $this->whiteRabbit3->multiplyBy($amount, $multiplier));
    }

    public function multiplyProvider(){

      $test1 = array(4, 2, 2);
      $test2 = array(6, 3, 2);
      $test3 = array(350, 7, 50);
      $test4 = array(24.4, 5.5, 4.4);
      $test5 = array(-20, -5, 4);

      $tests = array();

      array_push($tests, $test1, $test2, $test3,$test4);

      // Other tests
      // $size = 100;
      //
      // for ($i=-$size; $i < $size; $i++) {
      //
      //   for ($j= -$size; $j < $size; $j++) {
      //
      //     array_push($tests, array($i*$j, $i, $j));
      //   }
      // }

      return $tests;
    }
}
