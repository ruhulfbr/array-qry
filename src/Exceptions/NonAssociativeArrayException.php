<?php

/**
 * src/Exceptions/NonAssociativeArrayException.php
 *
 * @package ruhulfbr/array-qry
 * @author Md Ruhul Amin (ruhul11bd@gmail.com)
 */

namespace Ruhul\ArrayQuery\Exceptions;

class NonAssociativeArrayException extends \Exception
{
    public function __construct(string $message = "Expecting an associative array with string keys.")
    {
        parent::__construct($message);
    }
}
