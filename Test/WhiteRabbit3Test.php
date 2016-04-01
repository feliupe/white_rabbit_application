<?php

namespace Test;

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
        return array(
            array(4, 2, 2),
            array(6, 2, 3),
            array(20, 4, 5),
            array(5, 2.5, 2),
            array(-3, 3, -1),
            array(4, -2, -2)
        );
    }
}
