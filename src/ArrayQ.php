<?php

/**
 *
 * src/ArrayQ.php
 *
 * @package ruhulfbr/array-qry
 * @author Md Ruhul Amin (ruhul11bd@gmail.com) <https://github.com/ruhulfbr>
 *
 */

namespace Ruhul\ArrayQuery;

use Exception;
use Ruhul\ArrayQuery\Exceptions\EmptyArrayException;
use Ruhul\ArrayQuery\Exceptions\NonAssociativeArrayException;

class ArrayQ extends Builder
{
    /**
     * @var array
     */
    private array $_array;

    /**
     * @var array
     */
    private array $_fields = [];

    /**
     * @var array
     */
    private array $_data = [];

    /**
     * ArrayQ constructor.
     * @param array $array
     * @throws Exception
     */
    public function __construct(array $array)
    {
        $this->_array = $array;
        $this->validateArray();

        parent::__construct($this->_data, $this->_fields);
    }

    /**
     *
     * @param array $array
     * @return static
     * @throws Exception
     */
    public static function from(array $array): static
    {
        return new static($array);
    }

    /**
     * Validate array and set data and fields
     * @return void True if extraction is successful, false otherwise.
     * @throws EmptyArrayException
     */
    private function validateArray(): void
    {
        if( empty($this->_array) || empty($this->_array[0])){
            throw new EmptyArrayException();
        }

        $this->_data = convertToPlainArray($this->_array);
        $this->_fields = array_keys($this->_data[0]);
    }
}
