<?php

/**
 * src/Exceptions/ColumnNotFoundException.php
 *
 * @package ruhulfbr/array-qry
 * @author Md Ruhul Amin (ruhul11bd@gmail.com)
 */

namespace Ruhul\ArrayQuery\Exceptions;

class ColumnNotFoundException extends \Exception
{
    public function __construct(string $message = "Column Not found")
    {
        parent::__construct($message);
    }
}
