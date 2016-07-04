<?php

namespace test;

require_once(__DIR__ . "/../src/WhiteRabbitSwissKnife.php");

use PHPUnit_Framework_TestCase;
use WhiteRabbitSwissKnife;

class WhiteRabbitSwissKnifeTest extends PHPUnit_Framework_TestCase {

  /** @var WhiteRabbitSwissKnife */
  private $swissKnife;

  public function setUp()
  {
      parent::setUp();
      $this->swissKnife = new WhiteRabbitSwissKnife();
  }

  /**
   * @dataProvider testPartitionProvider
   */
  public function testPartition($array, $p, $arrayExpected, $pivotExpected){

      $pivot = $this->swissKnife->partition($array, 0, count($array) - 1, $p);

      $this->assertEquals($pivotExpected, $pivot);
      $this->assertEquals($arrayExpected, $array);
  }

  public function testPartitionProvider(){

    #pivot is the median
    $test1 = array(
      array(8,5,10,4,3), 1, array(4,3,5,8,10), 2
    );

    #pivot is the largest member
    $test2 = array(
      array(1,2,5,4,3), 2, array(1,2,3,4,5), 4
    );

    #pivot is the smallest member
    $test3 = array(
      array(8,5,10,4,3), 1, array(4,3,5,8,10), 2
    );

    #pivot is repeated
    $test4 = array(
      array(2,4,3,6,5,5), 4, array(2,4,3,5,5,6), 4
    );

    return array($test1,$test2,$test3,$test4);
  }

  /**
   * @dataProvider testSelectProvider
   */
  public function testSelect($array, $minIndex, $expected){

    $elem = $array[$this->swissKnife->select($array,0, count($array) - 1, $minIndex)];

    $this->assertEquals($expected, $elem);
  }

  public function testSelectProvider(){

    #corrigir teste para que identifiquem o numero em si e nao a posição como mostram os dois ultimos testes

    #finding the middle element
    $test1 = array(
      array(8,5,10,4,3), 2, 5
    );

    #finding the maximum
    $test2 = array(
      array(6,3,2,4,1), 4, 6
    );

    #finding the minimum
    $test3 = array(
      array(10,3,4,2,7), 0, 2
    );

    return array($test1, $test2, $test3);
  }

  /**
   * @dataProvider testInsertionSortProvider
   */
  public function testInsertionSort($array, $left, $right, $expectedArray){

    $this->swissKnife->insertionSort($array, $left, $right);

    $this->assertEquals($expectedArray, $array);
  }

  public function testInsertionSortProvider(){

    #Complete sorting
    $test1 = array(array(4,3,2,1), 0, 3, array(1,2,3,4));

    #Partial sorting
    $test2 = array(array(4,3,2,1), 2, 3, array(4,3,1,2));

    #Sorting sorted array
    $test3 = array(array(4,3,2,1), 2, 3, array(4,3,1,2));

    return array($test1,$test2,$test3);
  }

  /**
   * @dataProvider testPartition5Provider
   */
  public function testPartition5($array, $left, $right, $expectedPos, $expectedElement){

    $pos = $this->swissKnife->partition5($array, $left, $right);

    $elem = $array[$pos];

    $this->assertEquals($expectedPos, $pos);
    $this->assertEquals($expectedElement, $elem);
  }

  public function testPartition5Provider(){

    #(Complete)
    $test1 = array(array(1,2,4,3,5), 0, 4, 2, 3);

    #(Partial) Odd number of elements
    $test2 = array(array(1,2,4,3,5), 2, 4, 3, 4);

    #(Partial) Even number of elements
    $test3 = array(array(1,2,4,3,5), 1, 3, 2, 3);

    return array($test1, $test2, $test3);
  }


  /**
   * @dataProvider testPivotProvider
   */
  public function testPivot($array, $l, $r, $expectedMedianOfMedians){

    $pivot = $this->swissKnife->pivot($array, $l, $r);

    $this->assertEquals($expectedMedianOfMedians, $array[$pivot]);
  }

  public function testPivotProvider(){

    // The seed is set to generate always thame same set of arrays.

    // Complete sections = section with 5 elements.
    // Partial sections have less than 5 elements.

    #test1 (Complete sections)
    $a1 = range(1, 15);
    srand(1000000); #seed
    shuffle($a1);
    $expected1 = $this->pivotHelper($a1);
    $test1 = array(
      $a1, 0, 14, 6
    );

    #test2 (Complete + partial section)
    $a2 = range(1, 5);
    array_push($a2, 6,7,8);
    srand(1000002); #seed
    shuffle($a2);
    $expected2 = $this->pivotHelper($a2);
    $test2 = array(
      $a2, 0, 7, 4
    );

    #test3 (Partial section)
    $a3 = range(1, 4);
    srand(1000004); #seed
    shuffle($a3);
    $expected3 = $this->pivotHelper($a3);
    $test3 = array(
      $a3, 0, 3, $expected3
    );

    return array($test1, $test2,$test3);
  }

  /*
  * Calculates the median of medians
  */
  public function pivotHelper($array){

    $medians = array();
    $size = count($array);
    $r = 0;
    $sections = 0;

    for ($l = 0; $r < $size - 1; $l += 5){

      $sections++;

      $r = $r > $size - 1 ? $size - 1 : $l + 4;

      array_push($medians, $this->simpleMedian($array, $l, $r));
    }

    return $this->simpleMedian($medians, 0, $sections - 1);
  }

  /*
  * Subroutine to be used in testPivotProvider.
  */
  function simpleMedian($A, $l, $r){

    $B = array_slice($A, $l, $r - $l + 1);

    sort($B);

    $medianIndex = floor((count($B)) / 2);

    return $B[$medianIndex];
  }
}

 ?>
