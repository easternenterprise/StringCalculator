<?php

namespace Eastern;

/**
 * Class Calculator
 * @package Eastern
 */
class Calculator
{
    /**
     * Add numbers given as comma separated value in parameter.
     *
     * @param string $numbers
     * @return int
     * @throws InvalidArgumentException
     */
    public function add($numbers = "")
    {
        if (empty($numbers)) {
            return 0;
        }
        
        if (!is_string($numbers)) {
            throw new \InvalidArgumentException('Parameters must be a string');
        }

        $delimiter = ",";
        $numbersWithoutDelimiter = $numbers;
        if (substr($numbers, 0, 2 ) === '//') {
            $delimiterIndex = strpos($numbers, '//') + 2;

            $delimiter = substr($numbers, $delimiterIndex, 1);

            $numbersWithoutDelimiter = substr($numbers, strpos($numbers, 'n') + 1);
        }

        return $this->performAddition($numbersWithoutDelimiter, $delimiter);
    }

    /**
     * Performs the addition by splitting the numbers based on the delimiter
     *
     * @param string $numbers
     * @param string $delimeter
     * @return int
     * @throws InvalidArgumentException
     */
    private function performAddition($numbers, $delimeter)
    {
        $numbers = str_replace('\n', ',', $numbers);
        $numbersArray = explode($delimeter, $numbers);

        if (array_filter($numbersArray, 'is_numeric') !== $numbersArray) {
            throw new \InvalidArgumentException('Parameters string must contain numbers');
        }

        return array_sum($numbersArray);
    }
}