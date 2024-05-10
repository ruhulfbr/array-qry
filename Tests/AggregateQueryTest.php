<?php
/**
 *
 * Tests/AggregateQueryTest.php
 *
 * @package ruhulfbr/array-qry
 * @author Md Ruhul Amin (ruhul11bd@gmail.com) <https://github.com/ruhulfbr>
 *
 */

namespace Ruhul\ArrayQuery\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Ruhul\ArrayQuery\ArrayQ;
use Ruhul\ArrayQuery\Exceptions\InvalidAggregateColumnException;

class AggregateQueryTest extends TestCase
{
    use DummyArray;


    /**
     * @test Expect Exception InvalidAggregateColumnException
     * @throws Exception
     */
    public function it_ThrowExceptionInvalidAggregateColumn()
    {
        $column = "ages";
        $message = "Unsupported Aggregate Columns: `" . $column . "`.";

        $this->expectException(InvalidAggregateColumnException::class);
        $this->expectExceptionMessage($message);

        ArrayQ::from($this->testArray())->min($column);
    }

    /**
     * @test Expect Counted Number from Result
     * @throws Exception
     */
    public function it_shouldReturnCountOfResult()
    {
        $total = ArrayQ::from($this->testArray())->count();
        $this->assertEquals(10, $total);
    }

    /**
     * @test Expect Counted Number from Result With Where
     * @throws Exception
     */
    public function it_shouldReturnCountOfResultWithWhere()
    {
        $total = ArrayQ::from($this->testArray())->whereIn('id', [1, 2, 3])->count();
        $this->assertEquals(3, $total);
    }

    /**
     * @test Expect Return sum of age
     * @throws Exception
     */
    public function it_shouldReturnSUMOfAge()
    {
        $sum = ArrayQ::from($this->testArray())->whereIn('id', [1, 2, 3])->sum('age');
        $this->assertEquals(90, $sum);
    }

    /**
     * @test Expect Return Average of age
     * @throws Exception
     */
    public function it_shouldReturnAverageOfAge()
    {
        $avg = ArrayQ::from($this->testArray())->whereIn('id', [1, 2, 3])->avg('age');
        $this->assertEquals(30, intval($avg));
    }

    /**
     * @test Expect Return result Minimum age
     * @throws Exception
     */
    public function it_shouldReturnResultWithMinimumAge()
    {
        $result = ArrayQ::from($this->testArray())->whereIn('id', [1, 2, 3])->min('age');
        $this->assertEquals(25, $result['age']);
    }

    /**
     * @test Expect Return result Maximum age
     * @throws Exception
     */
    public function it_shouldReturnResultWithMAXAge()
    {
        $result = ArrayQ::from($this->testArray())->whereIn('id', [1, 2, 3])->max('age');
        $this->assertEquals(35, $result['age']);
    }
}
