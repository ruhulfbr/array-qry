<?php

/**
 * src/Exceptions/InvalidAggregateColumnException.php
 *
 * @package ruhulfbr/array-qry
 * @author Md Ruhul Amin (ruhul11bd@gmail.com) <https://github.com/ruhulfbr>
 */

namespace Ruhul\ArrayQuery\Exceptions;

class InvalidAggregateColumnException extends \Exception
{
    public function __construct(string $message = "Unsupported Aggregate Column")
    {
        parent::__construct($message);
    }
}