<?php

namespace Test;

require_once(__DIR__ . "/../src/WhiteRabbit.php");

use PHPUnit_Framework_TestCase;
use WhiteRabbit;

class WhiteRabbitTest extends PHPUnit_Framework_TestCase
{
    /** @var WhiteRabbit */
    private $whiteRabbit;

    public function setUp()
    {
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

    public function medianProvider(){
        return array(
            array(array(array("letter" => "m", "count" => 9240), array("letter" => "f", "count" => 9095)), __DIR__ ."/../txt/text1.txt"),
            array(array(array("letter" => "w", "count" => 13333), array("letter" => "m", "count" => 12641)), __DIR__ ."/../txt/text2.txt"),
            array(array(array("letter" => "w", "count" => 2227), array("letter" => "g", "count" => 2187)), __DIR__ ."/../txt/text3.txt"),
            array(array(array("letter" => "w", "count" => 3049)), __DIR__ ."/../txt/text4.txt"),
            array(array(array("letter" => "z", "count" => 858)), __DIR__ ."/../txt/text5.txt")
        );
    }
}
