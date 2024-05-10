<?php
/**
 *
 * Tests/SortingQueryTest.php
 *
 * @package ruhulfbr/array-qry
 * @author Md Ruhul Amin (ruhul11bd@gmail.com) <https://github.com/ruhulfbr>
 *
 */

namespace Ruhul\ArrayQuery\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Ruhul\ArrayQuery\ArrayQ;
use Ruhul\ArrayQuery\Exceptions\InvalidSortingKeyException;
use Ruhul\ArrayQuery\Exceptions\InvalidSortingOperatorException;
use Ruhul\ArrayQuery\Exceptions\MultipleSortingOperationException;

class SortingQueryTest extends TestCase
{
    use DummyArray;

    /**
     * @test Expect Exception InvalidSortingKeyException
     * @throws Exception
     */
    public function it_ThrowInvalidSortingKeyException()
    {
        $key = "ages";
        $message = "Invalid ordering/sorting operation key: `" . $key . "`.";

        $this->expectException(InvalidSortingKeyException::class);
        $this->expectExceptionMessage($message);

        ArrayQ::from($this->testArray())->orderBy($key, 'desc');
    }

    /**
     * @test Expect Exception InvalidSortingOperatorException
     * @throws Exception
     */
    public function it_ThrowInvalidSortingOperatorException()
    {
        $operator = "<===>";
        $message = "Invalid ordering/sorting operator: `" . $operator . "`.";

        $this->expectException(InvalidSortingOperatorException::class);
        $this->expectExceptionMessage($message);

        ArrayQ::from($this->testArray())->orderBy('id', $operator);
    }

    /**
     * @test Expect Exception MultipleSortingOperationException
     * @throws Exception
     */
    public function it_ThrowMultipleSortingOperationException()
    {
        $message = "Multiple ordering/sorting operations are not allowed.";

        $this->expectException(MultipleSortingOperationException::class);
        $this->expectExceptionMessage($message);

        ArrayQ::from($this->testArray())->orderBy('id', 'desc')->orderBy('age', 'asc');
    }

    /**
     * @test Expect results Sorting ASC
     * @throws Exception
     */
    public function it_shouldGetResultsSortedAsAscending()
    {
        $results = ArrayQ::from($this->testArray())->orderBy('id', 'asc')->get();

        $this->assertEquals(1, $results[0]['id']);
        $this->assertEquals('John Doe', $results[0]['name']);
    }

    /**
     * @test Expect results Sorting DESC
     * @throws Exception
     */
    public function it_shouldGetResultsSortedAsDescending()
    {
        $results = ArrayQ::from($this->testArray())->orderBy('id', 'DESC')->get();

        $this->assertEquals(10, $results[0]['id']);
        $this->assertEquals('Daniel Anderson', $results[0]['name']);
    }

    /**
     * @test Expect results Sorting Date ASC
     * @throws Exception
     */
    public function it_shouldGetResultsSortedAsDateAscending()
    {
        $results = ArrayQ::from($this->testArray())->orderBy('dob', 'asc')->get();

        $this->assertEquals(6, $results[0]['id']);
        $this->assertEquals('Michael Davis', $results[0]['name']);
    }

    /**
     * @test Expect results Sorting Date DESC
     * @throws Exception
     */
    public function it_shouldGetResultsSortedAsDateDescending()
    {
        $results = ArrayQ::from($this->testArray())->orderBy('dob', 'desc')->get();

        $this->assertEquals(1, $results[0]['id']);
        $this->assertEquals('John Doe', $results[0]['name']);
    }

    /**
     * @test Expect latest results
     * @throws Exception
     */
    public function it_shouldGetColumnWiseLatestResults()
    {
        $results = ArrayQ::from($this->testArray())->latest()->get();

        $this->assertEquals(10, $results[0]['id']);
        $this->assertEquals('Daniel Anderson', $results[0]['name']);
    }

    /**
     * @test Expect Oldest results
     * @throws Exception
     */
    public function it_shouldGetColumnWiseOldestResults()
    {
        $results = ArrayQ::from($this->testArray())->oldest()->get();

        $this->assertEquals(1, $results[0]['id']);
        $this->assertEquals('John Doe', $results[0]['name']);
    }

}
