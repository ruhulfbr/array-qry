<?php
/**
 *
 * Tests/LimitQueryTest.php
 *
 * @package ruhulfbr/array-qry
 * @author Md Ruhul Amin (ruhul11bd@gmail.com) <https://github.com/ruhulfbr>
 *
 */

namespace Ruhul\ArrayQuery\Tests;

use Exception;
use PHPUnit\Framework\TestCase;
use Ruhul\ArrayQuery\ArrayQ;

class LimitQueryTest extends TestCase
{
    use DummyArray;

    /**
     * @test Expect 3 Item of results
     * @throws Exception
     */
    public function it_shouldGetResultsWithLimit()
    {
        $results = ArrayQ::from($this->testArray())->limit(3)->get();
        $this->assertCount(3, $results);
    }

    /**
     * @test Expect 3 Item of results from index 2
     * @throws Exception
     */
    public function it_shouldGetResultsWithLimitAndOffset()
    {
        $results = ArrayQ::from($this->testArray())->limit(2, 1)->get();
        $this->assertCount(2, $results);
    }

    /**
     * @test Expect 0 Item of results with limit offset
     * @throws Exception
     */
    public function it_shouldGetZeroItemResultsWithLimitAndOffset()
    {
        $results = ArrayQ::from($this->testArray())->limit(200, 100)->get();
        $this->assertCount(0, $results);
    }

}
