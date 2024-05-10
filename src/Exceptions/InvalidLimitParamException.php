<?php

/**
 * src/Exceptions/InvalidLimitParamException.php
 *
 * @package ruhulfbr/array-qry
 * @author Md Ruhul Amin (ruhul11bd@gmail.com)
 */

namespace Ruhul\ArrayQuery\Exceptions;

class InvalidLimitParamException extends \Exception
{
    public function __construct(string $message = "Invalid array limit params")
    {
        parent::__construct($message);
    }
}
