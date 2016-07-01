
<?php

/*
 * A lot of routines in this file uses $A, $l and $r which can be read in the
 * same way:
 * $A - input array
 * $l - start to be considered (or left bound)
 * $r - end to be considered (or right bound)
 */

/*
 * Find the the position of the nth smallest element in a unordered list[l..r].
 */
function select(&$A, $l, $r, $n){

  while(true){

    if ($l == $r){

      return $l;
    }

    // Try to select a pivot that divides the data better
    $p = pivot($A, $l, $r);

    // Partitioning data
    $p = partition($A, $l, $r, $p);

    // The element that divides data is always in the right position, supposing
    // a crescent ordered array.
    // So we've found the nth element if it is the pivot.
    if ($n == $p){

      return $p;
    }
    // If it is on the right side reduce the array, on the left, by one.
    else if ($n > $p){

      $l = $p + 1;
    }
    // The opposite here.
    else{

      $r = $p - 1;
    }
  }
}

/*
 * Sort an array in smaller and greater elements than the pivot (an arbitrary
  * number).
 * $p - Pivot position.
 * return - New pivot's position.
 */
function partition(&$A, $l, $r, $p){

  // When the have just one element
  if ($l == $r){
    return $l;
  }

  $pivot = $A[$p];

  # Move pivot to the end
  swap($A, $p, $r);

  $i = $l - 1;
  $j = $r;

  while (true){

    // In the beggining of each loop to following is true:
    // A[l..i] <= pivot and A[j..r] > pivot and i < j
    do { $i++; } while ($i < $r && $A[$i] <= $pivot);
    do { $j--; } while ($j >= $i && $A[$j] > $pivot);

    // Put elements on the right position.
    if ($i < $j){

      swap($A, $i, $j);
    }
    else{
       // Here j will always be on the last position of the i-side.
       // If not there is only one side. So j + 1 element it's put on the right
       // side and the pivot ($r) on the middle.
      swap($A, $r, $j + 1);

      return $j + 1;
    }
  }
}

/*
 * Selects the median of a group of at most five elements.
*/
function partition5(&$A, $l, $r){

  if ($r - $l + 1 > 5){
    throw new InvalidArgumentException("The bounds have more than 5 elements.");
  }

  // Sorting
  insertionSort($A, $l, $r);

  return floor(($l + $r) / 2);
}

/*
 * Sort a group of elements.
 */
function insertionSort(&$A, $l, $r){

  for ($i = $l + 1; $i <= $r; $i++){

    $elem = $A[$i];

    for ($j = $i - 1; $j >= $l && $elem < $A[$j]; $j--){

      $A[$j + 1] = $A[$j];
    }

    $A[$j + 1] = $elem;
  }

}

/*
 * It divides its input (a list of length n) into groups of at most five elements,
 * computes the median of each of those groups using some subroutine, then recursively
 * computes the true median of the medians found in the previous step.
 */
function pivot(&$A, $l, $r){

  // If the section have less than 6 elements returns the median.
  if ($r - $l + 1 <= 5){
    return partition5($A, $l, $r);
  }

  // Otherwise computes the median of each 5-element subsequent section.
  // At the end the elements a place in the beggining of array.
  for ($i = $l; $i <= $r; $i += 5){

    $subRight = $i + 4;

    $subRight = $subRight > $r ? $r : $subRight;

    $median5 = partition5($A, $i, $subRight);

    swap($A, $median5, $l + floor(($i - $l) / 5));
  }

  $lastMedianElement =  $l + ceil(($r - $l) / 5) - 1;
  $medianPosition =  floor($l + ($r - $l) / 10);

  return select($A, $l, $lastMedianElement, $medianPosition);
}

/*
 * Swap elements in the p1 and p2 positions.
 */
function swap(&$A, $p1, $p2){

  $tmp = $A[$p1];
  $A[$p1] = $A[$p2];
  $A[$p2] = $tmp;
}
 ?>
