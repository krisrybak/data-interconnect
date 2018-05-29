<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Exception\{OutOfRangeException, InvalidRangeOrderException, IllegalMatchOperationException};

/**
 * FizzBuzzTest
 *
 * @author Kris Rybak <kris@krisrybak.com>
 */
final class FizzBuzzTest extends TestCase
{
    /**
     * Provides a list of non-integer series
     */
    public function nonIntegerProvider()
    {
        return [
            ["1"],
            [1.2],
            ["string"],
            [[]],
            [new \StdClass],
            [null],
            [false]
        ];
    }

    /**
     * Provides a list of integer series
     */
    public function integerProvider()
    {
        $ret = array();

        for ($i=0; $i < 5; $i++) {
            $ret[] = array(rand(1, 1000));
        }

        return $ret;
    }

    /**
     * Provides dataset for loop function testing
     */
    public function loopDataProvider()
    {
        return [
            [10, 20, "10buzz1112fizz131415fizzbuzz161718fizz1920buzz"],
            [15, 30, "15fizzbuzz161718fizz1920buzz21fizz222324fizz25buzz2627fizz282930fizzbuzz"],
            [40, 45, "40buzz4142fizz434445fizzbuzz"],
            [80, 100, "80buzz81fizz828384fizz85buzz8687fizz888990fizzbuzz919293fizz9495buzz96fizz979899fizz100buzz"],
        ];
    }

    /**
     * @dataProvider nonIntegerProvider
     */
    public function testLoopInvalidArgumentsSupplied($nonInteger)
    {
        $this->expectException(TypeError::class);
        FizzBuzz::loop($nonInteger, $nonInteger);
    }

    /**
     * @dataProvider integerProvider
     */
    public function testLoopInvalidArgumentsRangeOrderSupplied($number)
    {
        $this->expectException(InvalidRangeOrderException::class);
        FizzBuzz::loop($number, $number - 1);
    }

    /**
     * @dataProvider loopDataProvider
     */
    public function testLoopPass($start, $finish, $expected)
    {
        FizzBuzz::loop($start, $finish);
        $this->expectOutputString($expected);
    }

    /**
     * @dataProvider nonIntegerProvider
     */
    public function testCheckIsInRangeInvalidArgumentsSupplied($nonInteger)
    {
        $this->expectException(TypeError::class);
        FizzBuzz::checkIsInRange($nonInteger);
    }

    public function testIsInRangeNumberTooLow()
    {
        $this->expectException(OutOfRangeException::class);

        // generate minimum
        $min = rand(10, 50);
        FizzBuzz::checkIsInRange($min - 1, $min, $min + 2);
    }

    public function testIsInRangeNumberTooHigh()
    {
        $this->expectException(OutOfRangeException::class);

        // generate minimum
        $min = rand(10, 50);
        FizzBuzz::checkIsInRange($min + 2, $min, $min + 1);
    }

    /**
     * @dataProvider integerProvider
     */
    public function testIsInRangeNumberPass($number)
    {
        $this->assertTrue(FizzBuzz::checkIsInRange($number + 1, $number, $number + 2));
    }

    /**
     * @dataProvider nonIntegerProvider
     */
    public function testIsDivisibleByInvalidArgumentsSupplied($nonInteger)
    {
        $this->expectException(TypeError::class);
        FizzBuzz::checkIsInRange($nonInteger, $nonInteger);
    }

    public function testIsDivisibleByZero()
    {
        $this->expectException(IllegalMatchOperationException::class);
        FizzBuzz::isDivisibleBy(rand(1, 10), 0);
    }

    /**
     * @dataProvider integerProvider
     */
    public function testIsDivisibleByPass($number)
    {
        $this->assertTrue(FizzBuzz::isDivisibleBy($number * $number, $number));
    }

    /**
     * @dataProvider integerProvider
     */
    public function testIsDivisibleByFail($number)
    {
        if ($number != 1) {
            $this->assertFalse(FizzBuzz::isDivisibleBy($number + 1, $number));
        }
    }
}
