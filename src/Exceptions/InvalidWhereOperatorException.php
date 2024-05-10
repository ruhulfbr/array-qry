<?php

/**
 * src/Exceptions/InvalidWhereOperatorException.php
 *
 * @package ruhulfbr/array-qry
 * @author Md Ruhul Amin (ruhul11bd@gmail.com)
 */

namespace Ruhul\ArrayQuery\Exceptions;

class InvalidWhereOperatorException extends \Exception
{
    public function __construct(string $message = "Invalid where operator")
    {
        parent::__construct($message);
    }
}
