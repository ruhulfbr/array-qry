<?php
/**
 *
 * Tests/QueryTest.php
 *
 * @package ruhulfbr/array-qry
 * @author Md Ruhul Amin (ruhul11bd@gmail.com) <https://github.com/ruhulfbr>
 *
 */

namespace Ruhul\ArrayQuery\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Ruhul\ArrayQuery\ArrayQ;
use Ruhul\ArrayQuery\Exceptions\ColumnNotFoundException;
use Ruhul\ArrayQuery\Exceptions\EmptyArrayException;
use Ruhul\ArrayQuery\Exceptions\InvalidDateStringException;
use Ruhul\ArrayQuery\Exceptions\InvalidWhereKeyException;
use Ruhul\ArrayQuery\Exceptions\InvalidWhereOperatorException;

class QueryTest extends TestCase
{
    use DummyArray;

    /**
     * @test Expect Exception EmptyArrayException
     * @throws Exception
     */
    public function it_ThrowEmptyArrayException()
    {
        $message = "Array is empty";

        $this->expectException(EmptyArrayException::class);
        $this->expectExceptionMessage($message);

        ArrayQ::from([])->select(['nana']);
    }

    /**
     * @test Expect Exception ColumnNotFoundException
     * @throws Exception
     */
    public function it_ThrowColumnNotFoundException()
    {
        $column = "nana";
        $message = "Unsupported column for SELECT : `" . $column . "`.";

        $this->expectException(ColumnNotFoundException::class);
        $this->expectExceptionMessage($message);

        ArrayQ::from($this->testArray())->select(['nana']);
    }

    /**
     * @test Expect Exception ColumnNotFoundException for invalid where key
     * @throws Exception
     */
    public function it_ThrowColumnNotFoundExceptionForInvalidWhereKey()
    {
        $key = "ages";
        $message = "Unsupported key for WHERE operation: `" . $key . "`.";

        $this->expectException(ColumnNotFoundException::class);
        $this->expectExceptionMessage($message);

        ArrayQ::from($this->testArray())->where($key, "=", 20);
    }

    /**
     * @test Expect Exception InvalidWhereOperatorException
     * @throws Exception
     */
    public function it_ThrowExceptionInvalidWhereOperator()
    {
        $operator = "<===>";
        $message = "Unsupported operator: " . $operator;

        $this->expectException(InvalidWhereOperatorException::class);
        $this->expectExceptionMessage($message);

        ArrayQ::from($this->testArray())->where('age', $operator, 20);
    }

    /**
     * @test Expect Exception InvalidDateStringException
     * @throws Exception
     */
    public function it_ThrowInvalidDateStringException()
    {
        $date = "555-555-555";
        $message = "Invalid date string, please provide a valid date.";

        $this->expectException(InvalidDateStringException::class);
        $this->expectExceptionMessage($message);

        ArrayQ::from($this->testArray())->whereDate('dob', "=", $date);
    }

    /**
     * @test Expect All Results
     * @throws Exception
     */
    public function it_shouldGetResultsAllData()
    {
        $qb = ArrayQ::from($this->testArray());
        $this->assertCount(10, $qb->all());
    }

    /**
     * @test Expect All Results with Selected Columns
     * @throws Exception
     */
    public function it_shouldGetResultsAllDataWithSelectedColumns()
    {
        $columns = ['id', 'name'];
        $results = ArrayQ::from($this->testArray())->select($columns)->get();
        $result = $results[0];

        $this->assertTrue(isset($result['id']));
        $this->assertTrue(isset($result['name']));
        $this->assertFalse(isset($result['age']));
    }

    /**
     * @test Expect All Results as where not applied
     * @throws Exception
     */
    public function it_shouldGetResultsWithNoWhereApplied()
    {
        $qb = ArrayQ::from($this->testArray());
        $this->assertCount(10, $qb->get());
    }

    /**
     * @test Expect One result
     * @throws Exception
     */
    public function it_shouldGetOneItemOfResult()
    {
        $result = ArrayQ::from($this->testArray())->row();
        $this->assertEquals(1, $result['id']);
        $this->assertEquals('John Doe', $result['name']);
    }

    /**
     * @test Expect One result with where Condition
     * @throws Exception
     */
    public function it_shouldGetOneItemOfResultWithWhere()
    {
        $result = ArrayQ::from($this->testArray())->where('id', 1)->row();

        $this->assertEquals(1, $result['id']);
        $this->assertEquals('John Doe', $result['name']);
    }

    /**
     * @test Expect Nth Item of result without where Condition
     * @throws Exception
     */
    public function it_shouldGetNthItemOfResult()
    {
        $result = ArrayQ::from($this->testArray())->getNth(1);
        $this->assertEquals(2, $result['id']);
        $this->assertEquals('Jane Smith', $result['name']);
    }

    /**
     * @test Expect Nth Item of result with where Condition
     * @throws Exception
     */
    public function it_shouldGetNthItemOfResultWithWhere()
    {
        $result = ArrayQ::from($this->testArray())->whereIn('id', [1, 2, 3])->getNth(2);

        $this->assertEquals(3, $result['id']);
        $this->assertEquals('Alice Johnson', $result['name']);
    }

    /**
     * @test Expect False when getting Nth Item of results
     * @throws Exception
     */
    public function it_shouldReturnFalseWhenGeNthItemOfResults()
    {
        $result = ArrayQ::from($this->testArray())->getNth(22);
        $this->assertFalse($result);
    }

    /**
     * @test Expect true when check has data
     * @throws Exception
     */
    public function it_shouldReturnTrueWhenCheckHasData()
    {
        $result = ArrayQ::from($this->testArray())->where('id', 1)->hasData();
        $this->assertTrue($result);
    }

    /**
     * @test Expect false when check has data
     * @throws Exception
     */
    public function it_shouldReturnFalseWhenCheckHasData()
    {
        $result = ArrayQ::from($this->testArray())->where('id', 100)->hasData();
        $this->assertFalse($result);
    }

    /**
     * @test Expect true when check doesExist
     * @throws Exception
     */
    public function it_shouldReturnTrueWhenCheckDoesExist()
    {
        $result = ArrayQ::from($this->testArray())->where('id', 1)->doesExist();
        $this->assertTrue($result);
    }

    /**
     * @test Expect false when check doesExist
     * @throws Exception
     */
    public function it_shouldReturnFalseWhenCheckDoesExist()
    {
        $result = ArrayQ::from($this->testArray())->where('id', 100)->doesExist();
        $this->assertFalse($result);
    }

    /**
     * @test Expect First item of result without apply where condition
     * @throws Exception
     */
    public function it_shouldGetFirstItemOfResultWithoutAnyWhereParam()
    {
        $result = ArrayQ::from($this->testArray())->first();
        $this->assertEquals(1, $result['id']);
        $this->assertEquals('John Doe', $result['name']);
    }

    /**
     * @test Expect Last item of result without apply where condition
     * @throws Exception
     */
    public function it_shouldGetLastItemOfResultWithoutAnyWhereParam()
    {
        $result = ArrayQ::from($this->testArray())->last();
        $this->assertEquals(10, $result['id']);
        $this->assertEquals('Daniel Anderson', $result['name']);
    }

    /**
     * @test Expect results with simple where condition
     * @throws Exception
     */
    public function it_shouldGetResultsWithSimpleWhereCondition()
    {
        $results = ArrayQ::from($this->testArray())->where('id', 3)->get();
        $this->assertCount(1, $results);
    }

    /**
     * @test Expect results with greater than where condition
     * @throws Exception
     */
    public function it_shouldGetResultsWithGreaterThanWhereCondition()
    {
        $results = ArrayQ::from($this->testArray())->where('id', '>', '2')->get();
        $this->assertCount(8, $results);
    }

    /**
     * @test Expect results with greater than equal where condition
     * @throws Exception
     */
    public function it_shouldGetResultsWithGreaterThanEqualWhereCondition()
    {
        $results = ArrayQ::from($this->testArray())->where('id', '>=', 9)->get();
        $this->assertCount(2, $results);
    }

    /**
     * @test Expect results with less than where condition
     * @throws Exception
     */
    public function it_shouldGetResultsWithLesThanWhereCondition()
    {
        $results = ArrayQ::from($this->testArray())->where('id', '<', 5)->get();
        $this->assertCount(4, $results);
    }

    /**
     * @test Expect results with less than equal where condition
     * @throws Exception
     */
    public function it_shouldGetResultsWithLessThanEqualWhereCondition()
    {
        $results = ArrayQ::from($this->testArray())->where('id', '<=', 3)->get();
        $this->assertCount(3, $results);
    }

    /**
     * @test Expect results with not equal where condition
     * @throws Exception
     */
    public function it_shouldGetResultsWithNotEqualWhereCondition()
    {
        $results = ArrayQ::from($this->testArray())->where('id', "!=", 3)->get();
        $this->assertCount(9, $results);
    }

    /**
     * @test Expect results with whereIn condition
     * @throws Exception
     */
    public function it_shouldGetResultsWithWhereInCondition()
    {
        $results = ArrayQ::from($this->testArray())->whereIn('id', [1, 2])->get();
        $this->assertCount(2, $results);
    }

    /**
     * @test Expect results with whereNotIn condition
     * @throws Exception
     */
    public function it_shouldGetResultsWithWhereNotInCondition()
    {
        $results = ArrayQ::from($this->testArray())->whereNotIn('id', [1, 2])->get();
        $this->assertCount(8, $results);
    }

    /**
     * @test Expect results with whereLke Contain (both) condition
     * @throws Exception
     */
    public function it_shouldGetResultsWithWhereLikeContainCondition()
    {
        $results = ArrayQ::from($this->testArray())->whereLike('name', 'Will')->get();
        $this->assertCount(1, $results);
    }

    /**
     * @test Expect results with whereLke contains with condition
     * @throws Exception
     */
    public function it_shouldGetResultsWithWhereLikeStartWithCondition()
    {
        $results = ArrayQ::from($this->testArray())->whereLike('name', 'Olivia', 'start')->get();
        $this->assertCount(1, $results);
    }

    /**
     * @test Expect results with whereLke End with condition
     * @throws Exception
     */
    public function it_shouldGetResultsWithWhereLikeEndWithCondition()
    {
        $results = ArrayQ::from($this->testArray())->whereLike('name', 'Anderson', 'end')->get();
        $this->assertCount(1, $results);
    }

    /**
     * @test Expect results with whereDate Equal condition
     * @throws Exception
     */
    public function it_shouldGetResultsWithWhereDateEqualCondition()
    {
        $results = ArrayQ::from($this->testArray())->whereDate('dob', '1993-02-14')->get();
        $this->assertCount(1, $results);
    }

    /**
     * @test Expect results with whereDate Not Equal condition
     * @throws Exception
     */
    public function it_shouldGetResultsWithWhereDateNotEqualCondition()
    {
        $results = ArrayQ::from($this->testArray())->whereDate('dob', '!=', '1993-02-14')->get();
        $this->assertCount(9, $results);
    }

    /**
     * @test Expect results with whereDate Greater Than condition
     * @throws Exception
     */
    public function it_shouldGetResultsWithWhereDateGreaterThanCondition()
    {
        $results = ArrayQ::from($this->testArray())->whereDate('dob', '>', '1993-02-14')->get();
        $this->assertCount(5, $results);
    }

    /**
     * @test Expect results with whereDate Greater Than Equal condition
     * @throws Exception
     */
    public function it_shouldGetResultsWithWhereDateGreaterThanEqualCondition()
    {
        $results = ArrayQ::from($this->testArray())->whereDate('dob', '>=', '1993-02-14')->get();
        $this->assertCount(6, $results);
    }

    /**
     * @test Expect results with whereDate Less Than condition
     * @throws Exception
     */
    public function it_shouldGetResultsWithWhereDateLessThanCondition()
    {
        $results = ArrayQ::from($this->testArray())->whereDate('dob', '<', '1993-02-14')->get();
        $this->assertCount(4, $results);
    }

    /**
     * @test Expect results with whereDate Less Than Equal condition
     * @throws Exception
     */
    public function it_shouldGetResultsWithWhereDateLessThanEqualCondition()
    {
        $results = ArrayQ::from($this->testArray())->whereDate('dob', '<=', '1997-07-02')->get();
        $this->assertCount(8, $results);
    }

    /**
     * @test Expect results with where and Or_Where condition
     * @throws Exception
     */
    public function it_shouldGetResultsWithWhereAndOrWhereEqualCondition()
    {
        $results = ArrayQ::from($this->testArray())->where('id', 1)->orWhere('id', 3)->get();
        $this->assertCount(2, $results);
    }

}
