<?php

/**
 * src/Exceptions/EmptyArrayException.php
 *
 * @package ruhulfbr/array-qry
 * @author Md Ruhul Amin (ruhul11bd@gmail.com)
 */

namespace Ruhul\ArrayQuery\Exceptions;

class EmptyArrayException extends \Exception
{
    public function __construct(string $message = "Array is empty")
    {
        parent::__construct($message);
    }
}