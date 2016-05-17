<?php
namespace Eastern;

use Eastern\Calculator;

class CalculatorTest extends \PHPUnit_Framework_TestCase
{
    /** @var Calculator $calculator */
    protected $calculator;

    public function setUp()
    {
        parent::setUp();

        $this->calculator = new Calculator();
    }

    public function tearDown()
    {
        parent::tearDown();

        $this->calculator = null;
    }

    public function testAddReturnsInteger()
    {
        $result = $this->calculator->add();
        
        $this->assertInternalType('integer', $result, 'Add result is not integer.');
    }

    public function testAddEmptyStringReturnsZero()
    {
        $result = $this->calculator->add();

        $this->assertSame(0, $result, 'Empty string on add do not return 0');
    }

    public function testAddOneParameterReturnSameNumber()
    {
        $result = $this->calculator->add('1');

        $this->assertSame(1, $result, 'Single parameter in add do not return same number');
    }

    public function testAddTwoParametersReturnSum()
    {
        $result = $this->calculator->add('2,4');

        $this->assertSame(6, $result, 'Sum of add for two parameter is not correct');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function  testAddWithNonStringParameterThrowException()
    {
        $this->calculator->add(5, 'Integer parameter do not throw error');
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddWithNonNumbersThrowException()
    {
        $this->calculator->add('1,a', 'Invalid parameter do not throw exception');
    }
}