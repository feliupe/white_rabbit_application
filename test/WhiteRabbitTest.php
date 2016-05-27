<?php

namespace test;

require_once(__DIR__ . "/../src/WhiteRabbit.php");

use PHPUnit_Framework_TestCase;
use WhiteRabbit;

class WhiteRabbitTest extends PHPUnit_Framework_TestCase
{
    /** @var WhiteRabbit */
    private $whiteRabbit;

    public function setUp(){

        $this->whiteRabbit = new WhiteRabbit();
        parent::setUp();
    }

    //SECTION FILE !
    /**
     * @dataProvider medianProvider
     */
    public function testMedian($expected, $file){

        $result = $this->whiteRabbit->findMedianLetterInFile($file);

        $this->assertTrue(in_array($result, $expected));
    }

    /**
     * @dataProvider exceptionProvider
     */
    public function testException($file){

      $this->expectException(\InvalidArgumentException::class);

      $result = $this->whiteRabbit->findMedianLetterInFile($file);
    }

    public function medianProvider(){

        return array(
            array(array(array("letter" => "m", "count" => 9240), array("letter" => "f", "count" => 9095)), __DIR__ ."/../txt/text1.txt"),
            array(array(array("letter" => "w", "count" => 13333), array("letter" => "m", "count" => 12641)), __DIR__ ."/../txt/text2.txt"),
            array(array(array("letter" => "c", "count" => 2684), array("letter" => "m", "count" => 2244)), __DIR__ ."/../txt/text3.txt"),
            array(array(array("letter" => "c", "count" => 3114), array("letter" => "w", "count" => 3049)), __DIR__ ."/../txt/text4.txt"),
            array(array(array("letter" => "u", "count" => 18705), array("letter" => "f", "count" => 18122)), __DIR__ ."/../txt/text5.txt")
        );
    }

    public function exceptionProvider(){

        return array(array("test1.txt"));
    }
}
