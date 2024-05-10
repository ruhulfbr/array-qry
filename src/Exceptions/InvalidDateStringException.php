<?php

/**
 * src/Exceptions/InvalidDateStringException.php
 *
 * @package ruhulfbr/array-qry
 * @author Md Ruhul Amin (ruhul11bd@gmail.com) <https://github.com/ruhulfbr>
 */

namespace Ruhul\ArrayQuery\Exceptions;

class InvalidDateStringException extends \Exception
{
    public function __construct(string $message = "Invalid date string, please provide a valid date.")
    {
        parent::__construct($message);
    }
}