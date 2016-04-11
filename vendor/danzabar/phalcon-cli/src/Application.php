<?php

namespace Danzabar\CLI;

use Phalcon\CLI\Dispatcher;
use Danzabar\CLI\Output\Output;
use Danzabar\CLI\Input\Input;
use Danzabar\CLI\Tasks\TaskPrepper;
use Danzabar\CLI\Tasks\TaskLibrary;
use Danzabar\CLI\Tasks\Helpers;
use Danzabar\CLI\Tasks\Utility\Help;
use Phalcon\DI;

/**
 * The Application class for CLI commands
 *
 * @package CLI
 * @subpackage Application
 * @author Dan Cox
 */
class Application
{
    /**
     * The Dependancy object
     *
     * @var Object
     */
    protected $di;

    /**
     * Instance of the dispatcher
     *
     * @var Object
     */
    protected $dispatcher;

    /**
     * Instance of the Helpers class
     *
     * @var Object
     */
    protected $helpers;

    /**
     * The raw set of arguments from the CLI
     *
     * @var Array
     */
    protected $arguments;

    /**
     * The task Prepper instance
     *
     * @var Object
     */
    protected $prepper;

    /**
     * Instance of the task library
     *
     * @var Object
     */
    protected $library;

    /**
     * The name of the CLI
     *
     * @var string
     */
    protected $name;

    /**
     * The version of the CLI
     *
     * @var string
     */
    protected $version;

    /**
     * The phalcon console object
     *
     * @return void
     */
    public function __construct($DI = null, $dispatcher = null, $library = null)
    {
        $this->di = (!is_null($DI) ? $DI : new DI);
        $this->dispatcher = (!is_null($dispatcher) ? $dispatcher : new Dispatcher);
        $this->library = (!is_null($library) ? $library : new TaskLibrary);

        $this->setUpDispatcherDefaults();

        // Add the output and input streams to the DI
        $this->di->setShared('output', new Output);
        $this->di->setShared('input', new Input);
        $this->di->setShared('console', $this);

        $this->prepper = new TaskPrepper($this->di);
        $this->helpers = new Helpers($this->di);
        $this->registerDefaultHelpers();

        $this->di->setShared('helpers', $this->helpers);

        $this->addDefaultCommands();
    }

    /**
     * Adds the default commands like Help and List
     *
     * @return void
     */
    public function addDefaultCommands()
    {
        $this->add(new Help);
    }

    /**
     * Sets up the default settings for the dispatcher
     *
     * @return void
     */
    public function setUpDispatcherDefaults()
    {
        // Set the defaults for the dispatcher
        $this->dispatcher->setDefaultTask('Danzabar\CLI\Tasks\Utility\Help');
        $this->dispatcher->setDefaultAction('main');

        // Set no suffixes
        $this->dispatcher->setTaskSuffix('');
        $this->dispatcher->setActionSuffix('');
    }

    /**
     * Registers the question, confirmation and table helpers
     *
     * @return void
     */
    public function registerDefaultHelpers()
    {
        $this->helpers->registerHelper('question', 'Danzabar\CLI\Tasks\Helpers\Question');
        $this->helpers->registerHelper('confirm', 'Danzabar\CLI\Tasks\Helpers\Confirmation');
        $this->helpers->registerHelper('table', 'Danzabar\CLI\Tasks\Helpers\Table');
    }

    /**
     * Start the app
     *
     * @return Output
     */
    public function start($args = array())
    {
        $arg = $this->formatArgs($args);

        /**
         * Arguments and Options
         *
         */
        if (!empty($arg)) {
            $this->prepper
                 ->load($arg['task'])
                 ->loadParams($arg['params'])
                 ->prep($arg['action']);

            $this->dispatcher->setTaskName($arg['task']);
            $this->dispatcher->setActionName($arg['action']);
            $this->dispatcher->setParams($arg['params']);
        }

        $this->di->setShared('library', $this->library);
        $this->dispatcher->setDI($this->di);

        return $this->dispatcher->dispatch();
    }

    /**
     * Adds a command to the library
     *
     * @return Application
     */
    public function add($command)
    {
        $tasks = $this->prepper
                    ->load(get_class($command))
                    ->describe();

        $this->library->add(['task' => $tasks, 'class' => $command]);

        return $this;
    }

    /**
     * Find a command by name
     *
     * @return Object
     */
    public function find($name)
    {
        return $this->library->find($name);
    }

    /**
     * Format the arguments into a useable state
     *
     * @return Array
     */
    public function formatArgs($args)
    {
        // The first argument is always the file
        unset($args[0]);

        if (isset($args[1])) {
            $command = explode(':', $args[1]);
            unset($args[1]);
        } else {
            // No Command Specified.
            return array();
        }

        try {

            $action = (isset($command[1]) ? $command[1] : 'main');
            $cmd = $this->library->find($command[0].':'.$action);
            $task = get_class($cmd);

            return array(
                'task'      => $task,
                'action'    => $action,
                'params'    => $args
            );

        } catch (\Exception $e) {

            // No Command FOUND
            return array();
        }
    }

    /**
     * Returns the helpers object
     *
     * @return Object
     */
    public function helpers()
    {
        return $this->helpers;
    }

    /**
     * Sets the suffix for task classes
     *
     * @return Application
     */
    public function setTaskSuffix($suffix = '')
    {
        $this->dispatcher->setTaskSuffix($suffix);
        return $this;
    }

    /**
     * Sets the action suffix
     *
     * @return Application
     */
    public function setActionSuffix($suffix = '')
    {
        $this->dispatcher->setActionSuffix($suffix);
        return $this;
    }

    /**
     * Returns the DI
     *
     * @return Object
     */
    public function getDI()
    {
        return $this->di;
    }

    /**
     * Gets the value of the name
     *
     * @return String
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the value of name
     *
     * @param name $name The name of the CLI
     *
     * @return Application
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets the value of version
     *
     * @return version
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Sets the value of version
     *
     * @param version $version The cli version
     *
     * @return Application
     */
    public function setVersion($version)
    {
        $this->version = $version;
        return $this;
    }
} // END class Application
