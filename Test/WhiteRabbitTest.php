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
        $this->assertEquals($expected, $this->whiteRabbit->findMedianLetterInFile($file, $ocu));
    }

    /**
     * @dataProvider medianOccurrencesProvider
     */
    public function testMedianOccurrences($expected, $file){
        $this->whiteRabbit->findMedianLetterInFile($file, $ocu);
        $this->assertEquals($expected, $ocu);
    }

    /**
     * @dataProvider occurrencesProvider
     */
    public function testOccurrences($expected, $file, $letter){
        $this->assertEquals($expected, $this->whiteRabbit->findOccurencesOfLetterInFile($file, $letter));
    }

    public function medianProvider(){
        return array(
            array("a", $this->file1),
            array("h", $this->file2),
            array(" ", $this->file3)
        );
    }

    public function medianOccurrencesProvider(){
        return array(
            array(10, $this->file1),
            array(5, $this->file2),
            array(1, $this->file3)
        );
    }

    public function occurrencesProvider(){
        return array(
            array(5, $this->file1, "a"),
            array(5, $this->file1, "b"),
            array(5, $this->file1, "c"),
            array(99, $this->file2, "a"),
            array(99, $this->file2, "b"),
            array(99, $this->file2, "c"),
            array(150, $this->file3, "a"),
            array(150, $this->file3, "b"),
            array(150, $this->file3, "c"),
        );
    }

}