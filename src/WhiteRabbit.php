<?php

class WhiteRabbit
{
    public function findMedianLetterInFile($filePath)
    {
        return array("letter"=>$this->findMedianLetter($this->parseFile($filePath),$occurrences),"count"=>$occurrences);
    }

    /**
     * Parse the input file for letters.
     * @param $filePath
     */
    private function parseFile ($filePath)
    {
        //TODO implement this!
    }

    /**
     * Return the letter whose occurrences are the median.
     * @param $parsedFile
     * @param $occurrences
     */
    private function findMedianLetter($parsedFile, &$occurrences)
    {
        //TODO implement this!
    }
}