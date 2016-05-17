<?php
namespace Eastern;

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
        $this->calculator->add(5);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testAddWithNonNumbersThrowException()
    {
        $this->calculator->add('1,a');
    }

    /**
     * @dataProvider numberDataProvider
     */
    public function testAddCanSumMultipleNumbers($expectedResult, $numbers)
    {
        $result = $this->calculator->add($numbers);

        $this->assertSame($expectedResult, $result, 'Sum for multiple numbers is not returning expected result');
    }

    /**
     * Data provider to provide an array with expected result and test data.
     *
     * @return array
     */
    public function numberDataProvider()
    {
        return [
            [0, ''],
            [3, '1,2'],
            [8, '2,5,1'],
            [18, '2,4,5,7'],
            [5, '2\n3'],
            [3, '//;\n1;2'],
            [3, '//-\n1-2']
        ];
    }

    /**
     * @dataProvider badNumberDataProvider
     * @expectedException \InvalidArgumentException
     */
    public function testAddWithExtraCommaThrowsException($numbers)
    {
        $this->calculator->add($numbers);
    }

    public function badNumberDataProvider()
    {
        return [
            ['1,\n'],
            ['1,'],
        ];
    }
}