<?php

namespace Danzabar\CLI\Tasks;

use Danzabar\CLI\Input\InputArgument;
use Phalcon\Annotations\Adapter\Memory;
use Danzabar\CLI\Input\InputOption;

/**
 * Task prepper class loads a reflection of a task and its expected vars and setup
 *
 * @package CLI
 * @subpackage Tasks
 * @author Dan Cox
 */
class TaskPrepper
{
    /**
     * The reflection instance
     *
     * @var Object
     */
    protected $reflection;

    /**
     * The Class name
     *
     * @var string
     */
    protected $className;

    /**
     * The dependency injector
     *
     * @var Object
     */
    protected $di;

    /**
     * Instance of the Memory Annotation Engine
     *
     * @var Object
     */
    protected $annotation;

    /**
     * Current instance of the annotation reader
     *
     * @var Object
     */
    protected $reader;

    /**
     * An Array of arguments given
     *
     * @var Array
     */
    protected $arguments;

    /**
     * An Array of options given
     *
     * @var Array
     */
    protected $options;

    /**
     * Create class vars
     *
     * @return void
     */
    public function __construct($di)
    {
        // DI
        $this->di = $di;

        // Annotations
        $this->annotation = new Memory;

        // Add input class to the di
        $this->di->setShared('argument', new InputArgument);
        $this->di->setShared('option', new InputOption);

        // Clear the params
        $this->di->get('argument')->clearExpected();
        $this->di->get('option')->clearExpected();
    }

    /**
     * Loads the command and creates a reflection entity for it.
     *
     * @return TaskPrepper
     */
    public function load($className)
    {
        // Create reflection
        $this->reflection = new \ReflectionClass($className);

        // Read annotations
        $this->reader = $this->annotation->get($className);

        // Save the class name
        $this->className = $className;

        return $this;
    }

    /**
     * Describes a task for the library
     *
     * @return Array
     */
    public function describe()
    {
        $methods = array();
        $methodAnnotations = $this->reader->getMethodsAnnotations();

        foreach ($this->reflection->getMethods() as $method) {
            $name = $method->getName();

            if (isset($methodAnnotations[$name])) {
                if ($methodAnnotations[$name]->has('Action') || $methodAnnotations[$name]->has('action')) {
                    $methods[] = $method->getName();
                }
            }
        }

        $name = $this->className;
        $description = '';

        if ($this->reflection->hasProperty('name')) {
            $prop = $this->reflection->getProperty('name');
            $prop->setAccessible(true);
            $name = $prop->getValue($this->reflection->newInstance());
        }

        if ($this->reflection->hasProperty('description')) {
            $prop = $this->reflection->getProperty('description');
            $prop->setAccessible(true);
            $description = $prop->getValue($this->reflection->newInstance());
        }

        return array(
            'name' => $name,
            'description' => $description,
            'class' => $this->className,
            'actions'  => $methods
        );
    }

    /**
     * Looks for defined arguments and options and validates them
     *
     * @return void
     */
    public function prep($action = null)
    {
        $method = $this->getSetupMethod($action);

        if (!is_null($method)) {
            $method->invokeArgs($this->reflection->newInstance(), array('action' => $action));
        }

        $this->sortParams();
    }

    /**
     * Gets the setup method used by the task
     *
     * @return ReflectionMethod|NULL
     */
    public function getSetupMethod($action)
    {
        if ($this->reflection->hasMethod('setup'.ucwords($action))) {
            return $this->reflection->getMethod('setup'.ucwords($action));

        } elseif ($this->reflection->hasMethod('setup')) {
            return $this->reflection->getMethod('setup');
        }

        return null;
    }

    /**
     * This function takes arguments and options and sorts them by order relating
     * them to expected arguments in order to give them a key value
     *
     * @return void
     */
    public function sortParams()
    {
        $this->sortArguments();
        $this->sortOptions();
    }

    /**
     * Sorts out arguments into their correct orders
     *
     * @return void
     */
    public function sortArguments()
    {
        $arguments = array();

        $expectedArguments = $this->di->get('argument')->getExpectedOrder();

        foreach ($expectedArguments as $pos => $key) {
            if (array_key_exists($pos, $this->arguments)) {
                $arguments[$key] = $this->di->get('argument')->validate($key, $this->arguments[$pos]);
            } else {
                $this->di->get('argument')->validate($key, null);
            }
        }

        $this->di->get('argument')->load($arguments);
    }

    /**
     * Sorts out options into correct orders
     *
     * @return void
     */
    public function sortOptions()
    {
        $options = array();

        $expectedOptions = $this->di->get('option')->getExpectedOrder();

        foreach ($expectedOptions as $pos => $key) {
            if (array_key_exists($pos, $this->options)) {
                $options[$key] = $this->di->get('option')->validate($key, $this->options[$pos]);
            } else {
                $this->di->get('option')->validate($key, null);
            }
        }

        $this->di->get('option')->load($options);
    }

    /**
     * Loads params and splits them into arguments and options
     *
     * @return void
     */
    public function loadParams(array $params)
    {
        $this->arguments = array();
        $this->options = array();

        foreach ($params as $param) {
            if (strpos($param, '-') !== false) {
                $this->options[] = $this->extractOption($param);
            } else {
                $this->arguments[] = $param;
            }
        }

        return $this;
    }

    /**
     * extracts the option value from an option, or boolean
     *
     * @return String|Boolean
     */
    public function extractOption($str)
    {
        // If this has an = it has a value, else its a flag.
        if (strpos($str, '=')) {
            $extraction = explode('=', $str);

            return trim(str_replace(array('\'', '"'), '', $extraction[1]));
        }

        return true;
    }
} // END class TaskPrepper extends \ReflectionClass
