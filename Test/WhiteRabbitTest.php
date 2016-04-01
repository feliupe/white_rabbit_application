<?php

namespace Test;

require_once(__DIR__ . "/../src/WhiteRabbit.php");

use PHPUnit_Framework_TestCase;
use WhiteRabbit;

class WhiteRabbitTest extends PHPUnit_Framework_TestCase
{
    /** @var WhiteRabbit */
    private $whiteRabbit;
    private $file1;
    private $file2;
    private $file3;

    public function setUp()
    {
        parent::setUp();
        $this->whiteRabbit = new WhiteRabbit();
        $this->file1 = "testfile.txt";
        $this->file2 = "testfile2.txt";
        $this->file3 = "testfile3.txt";
    }

    //SECTION FILE !
    /**
     * @dataProvider medianProvider
     */
    public function testMedian($expected, $file){
        $this->assertEquals($expected, $this->whiteRabbit->findMedianLetterInFile($file));
    }

    public function medianProvider(){
        return array(
            array(array("letter" => "c", "count" => 3), $this->file1),
            array(array("letter" => "c", "count" => 3), $this->file2),
            array(array("letter" => "c", "count" => 3), $this->file3)
        );
    }
}
