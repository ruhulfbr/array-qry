<?php

/**
 *
 * src/Closure/Conditions/LessThan.php
 *
 * @package ruhulfbr/array-qry
 * @author Md Ruhul Amin (ruhul11bd@gmail.com) <https://github.com/ruhulfbr>
 *
 */

namespace Ruhul\ArrayQuery\Closure\Conditions;

class LessThan implements ClosureInterface
{
    /**
     * @param $value
     * @param $valueToCompare
     * @param null $dateFormat
     * @return bool
     */
    public function match($value, $valueToCompare, $dateFormat = null): bool
    {
        return $value < $valueToCompare;
    }
}
