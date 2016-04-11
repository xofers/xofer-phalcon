<?php

use Danzabar\CLI\CommandTester;

/**
 * Test case for the input classes
 *
 * @package CLI
 * @subpackage Tests
 * @author Dan Cox
 */
class InputTaskTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Instance of the command tester
     *
     * @var Object
     */
    protected $CT;

    /**
     * Set up the command tester
     *
     * @return void
     * @author Dan Cox
     */
    public function setUp()
    {
        $this->CT = new CommandTester();
        $this->CT->add(new InputTask);
    }

    /**
     * Test that the options work
     *
     * @return void
     * @author Dan Cox
     */
    public function test_optionIsSet()
    {
        $this->CT->execute('Input', array('--verbose'));

        $this->assertContains('verbose mode activated', $this->CT->getOutput());
    }

    /**
     * Test the output when the option is not set
     *
     * @return void
     * @author Dan Cox
     */
    public function test_optionIsNotSet()
    {
        $this->CT->execute('Input');

        $this->assertContains('...', $this->CT->getOutput());
    }

    /**
     * Test the required argument
     *
     * @return void
     * @author Dan Cox
     */
    public function test_requiredArgument()
    {
        $this->CT->execute('Input:required', array('email' => 'danzabar@gmail.com'));

        $this->assertContains('danzabar@gmail.com', $this->CT->getOutput());
    }

    /**
     * Test exception fires on missing argument
     *
     * @return void
     * @author Dan Cox
     */
    public function test_missingRequiredArgument()
    {
        $this->setExpectedException('Danzabar\CLI\Input\Exceptions\RequiredValueMissingException');

        $this->CT->execute('Input:required');
    }

    /**
     * Test the validation action
     *
     * @return void
     * @author Dan Cox
     */
    public function test_validationActionCorrectValue()
    {
        $this->CT->execute('Input:validation', array('value' => 'abcd'));

        $this->assertContains('abcd', $this->CT->getOutput());
    }

    /**
     * Test the error reporting from the validate_alpha method
     *
     * @return void
     * @author Dan Cox
     */
    public function test_validationActionException()
    {
        $this->setExpectedException('Danzabar\CLI\Input\Exceptions\ValidationFailException');

        $this->CT->execute('Input:validation', array('value' => 'a12v'));
    }

    /**
     * Does what it says on the tin...
     *
     * @return void
     * @author Dan Cox
     */
    public function test_optionalParameterThrowsNoExceptionWhenNotSet()
    {
        $this->CT->execute('Input:validation');

        $this->assertContains('No argument passed', $this->CT->getOutput());
    }

    /**
     * Test that option values are correctly extracted
     *
     * @return void
     * @author Dan Cox
     */
    public function test_optionValues()
    {
        $this->CT->execute('Input:options', array('--name' => 'myname'));

        $this->assertContains('myname', $this->CT->getOutput());
    }

    /**
     * Test the exception being thrown if i just pass this option as a flag
     *
     * @return void
     * @author Dan Cox
     */
    public function test_optionValuesFail()
    {
        $this->setExpectedException('Danzabar\CLI\Input\Exceptions\RequiredValueMissingException');

        $this->CT->execute('Input:options', array('--name'));
    }

    /**
     * Test passing an int to the int validator
     *
     * @return void
     * @author Dan Cox
     */
    public function test_intOptionPass()
    {
        $this->CT->execute('Input:intTest', array('int' => 10));

        $this->assertContains('Passed', $this->CT->getOutput());
    }

    /**
     * Same as above but a fail
     *
     * @return void
     * @author Dan Cox
     */
    public function test_intOptionFail()
    {
        $this->setExpectedException('Danzabar\CLI\Input\Exceptions\ValidationFailException');

        $this->CT->execute('Input:intTest', array('int' => 'skjkd'));
    }
} // END class InputTaskTest extends \PHPUnit_Framework_TestCase
