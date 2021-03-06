<?php
declare(strict_types=1);

use Exception\{OutOfRangeException, InvalidRangeOrderException, IllegalMatchOperationException};

/**
 * FizzBuzz
 *
 * @author Kris Rybak <kris@krisrybak.com>
 */
class FizzBuzz
{
    const MIN_RANGE = 1;
    const MAX_RANGE = 100;

    /**
     * Takes two integers (start and finish) and prints all integers between
     * them (inclusive). Should the number be divisible by 3 prints "fizz".
     * In addition should number be divisible by 5 it prints "buzz".
     * @param   int     $start  Number to start loop from
     * @param   int     $finish Number to finish loop at
     * @return  void
     * @throws  InvalidRangeOrderException
     */
    public static function loop(int $start, int $finish): void
    {
        if ($start >= $finish) {
            throw new InvalidRangeOrderException("Did you mean $finish to $start? Starting number "
            . "$start appears to be grater than finishing number $finish.");
        }

        // Check supplied integers are within a range
        self::checkIsInRange($start);
        self::checkIsInRange($finish);

        // Loop from start to finish
        for ($i=$start; $i <= $finish; $i++) {
            // Print the number
            print($i);

            // Check number is divisible by 3
            if (self::isDivisibleBy($i, 3)){
                print("fizz");
            }

            // Check number is also divisible by 5
            if (self::isDivisibleBy($i, 5)) {
                print("buzz");
            }
        }
    }

    /**
     * Check if given number is withing specified 
     * @param   integer     $number     Number to check
     * @return  boolean     True if passed the range check, otherwise false
     * @throws  OutOfRangeException
     */
    public static function checkIsInRange(int $number, $min = self::MIN_RANGE, $max = self::MAX_RANGE): bool
    {
        if ($number < $min) {
            throw new OutOfRangeException("Supplied number: $number is lower than "
            . "allowed minimum. Please supply number greater than: self::MIN_RANGE", 400);
        }

        if ($number > $max) {
            throw new OutOfRangeException("Supplied number: $number is greater than "
            . "allowed maximum. Please supply number lower than: self::MAX_RANGE", 400);
        }

        return true;
    }

    /**
     * Check if given integer (subject) is divisible by other integer (denominator)
     * @param   integer     $subject        Subject to check for division
     * @param   integer     $denominator    Number to check that subject is devisable by
     * @return  boolean     True if divisible, otherwise false
     * @throws  IllegalMatchOperationException
     */
    public static function isDivisibleBy(int $subject, int $denominator): bool
    {
        // Let's make sure we are not trying to divide by 0
        if ($denominator == 0) {
            throw new IllegalMatchOperationException("Dividing by 0 huh? "
            . "https://en.wikipedia.org/wiki/Division_by_zero");
        }

        // If subject is divisible by denominator then reminder should be 0
        if ($subject % $denominator == 0) {
            return true;
        }

        return false;
    }
}
