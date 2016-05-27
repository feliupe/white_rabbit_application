<?php

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

        asort($orderedOccurrencesArray);

        $medianIndex = floor(count($orderedOccurrencesArray) / 2);

        $medianLetter = array_keys(array_slice($orderedOccurrencesArray, $medianIndex, 1, true))[0];

        $occurrences = $orderedOccurrencesArray[$medianLetter];

        // ASCII to char
        return chr($medianLetter);
    }
}
