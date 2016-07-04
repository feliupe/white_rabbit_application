<?php

require_once(__DIR__ . "/WhiteRabbitSwissKnife.php");

use WhiteRabbitSwissKnife;

class WhiteRabbit
{

   /**
   * Return the letter whose occurrences are the median in a given file.
   * If the letter count is even, the right median element will be taken.
   * @param $filePath
   */
    public function findMedianLetterInFile($filePath){

        return array("letter"=>$this->findMedianLetter($this->parseFile($filePath),$occurrences),"count"=>$occurrences);
    }

    /**
     * Parse the input file for letters.
     * @param $filePath
     */
    private function parseFile($filePath)
    {
        if (!file_exists($filePath)){

          throw new InvalidArgumentException("File doesn't exist.");
        }

        // 1. Remove non letter characters
        // 2. Lowercase all characters
        return strtolower(preg_replace("([^A-Z|a-z])", "", file_get_contents($filePath)));
    }

    /**
     * Return the letter whose occurrences are the median.
     * If the letter count is even, the right median element will be taken.
     * @param $parsedFile
     * @param $occurrences
     */
    private function findMedianLetter($parsedFile, &$occurrences)
    {
        // {char (ASCII) => occurrences}
        $orderedOccurrencesArray = count_chars($parsedFile, 1);

        // index => {char (ASCII), occurrences}
        $preparedArray = $this->prepareArray($orderedOccurrencesArray);

        // get the number of occurrences
        $get = function($elem) { return $elem[1]; };

        $swissKnife = new WhiteRabbitSwissKnife($get);

        $m = $swissKnife->median($preparedArray);

        $occurrences = $m[1];

        // ASCII to char
        return chr($m[0]);
    }

    /*
     * Prepare to be used within the WhiteRabbitSwissKfine methods.
     */
    private function prepareArray($array){

      $new = array();

      foreach($array as $k => $v){
        array_push($new, array($k, $v));
      }

      return $new;
    }
}
