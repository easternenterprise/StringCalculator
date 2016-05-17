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

        $numbersArray = explode(",", $numbers);

        if (array_filter($numbersArray, 'is_numeric') !== $numbersArray) {
            throw new \InvalidArgumentException('Parameters string must contain numbers');
        }

        return array_sum($numbersArray);
    }
}