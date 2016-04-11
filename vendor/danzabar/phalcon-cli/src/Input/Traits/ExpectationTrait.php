<?php

namespace Danzabar\CLI\Input\Traits;

/**
 * The expectation trait adds functionality for classes that have expected variables/arguments
 *
 */
trait ExpectationTrait
{
    /**
     * Adds an expected argument to the expected array
     *
     * @return InputArgument
     */
    public function addExpected($name, $requirements)
    {
        if (!array_key_exists($name, static::$varPosition)) {
            static::$expected[$name] = $requirements;
            static::$varPosition[] = $name;
        }

        return $this;
    }

    /**
     * Clear the expected array
     *
     * @return void
     */
    public function clearExpected()
    {
        static::$expected = array();
        static::$varPosition = array();
    }

    /**
     * Returns the expected Array
     *
     * @return Array
     */
    public function getExpected()
    {
        return static::$expected;
    }

    /**
     * Returns the var position array
     *
     * @return void
     */
    public function getExpectedOrder()
    {
        return static::$varPosition;
    }
}
