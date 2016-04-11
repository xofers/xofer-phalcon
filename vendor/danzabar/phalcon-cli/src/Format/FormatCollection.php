<?php

namespace Danzabar\CLI\Format;

use Danzabar\CLI\Format\Colors;

/**
 * The format collection stores and fetches formats
 *
 * @package CLI
 * @subpackage Format
 * @author Dan Cox
 */
class FormatCollection
{

    /**
     * An associative array of formats
     *
     * @var Array
     */
    protected $formats;

    /**
     * An instance of the Colors class
     *
     * @var string
     */
    protected $color;

    /**
     * Set up the basic formats
     *
     * @return void
     */
    public function __construct()
    {
        $this->formats = array();

        $this->color = new Colors;

        $this->addGeneric();
    }

    /**
     * Adds a format entry
     *
     * @return void
     */
    public function add($name, array $details)
    {
        $this->formats[$name] = $this->textToCode($details);
    }

    /**
     * Turns a text color ie "Blue" into a color code.
     *
     * @return void
     */
    public function textToCode(array $details)
    {
        $formatted = array();

        if (isset($details['foreground'])) {
            $formatted['foreground'] = $this->color->getForeground($details['foreground']);
        }

        if (isset($details['background'])) {
            $formatted['background'] = $this->color->getBackground($details['background']);
        }

        return $formatted;
    }

    /**
     * Gets either a single or all formats depending on the var that is passed
     *
     * @return void
     */
    public function get($name = null)
    {
        if (!is_null($name)) {
            if (array_key_exists($name, $this->formats)) {
                return $this->formats[$name];
            }

            return false;

        } else {
            return $this->formats;
        }
    }

    /**
     * Adds a generic set of formats.
     *
     * @return void
     */
    public function addGeneric()
    {
        // Questions
        $this->add('question', array('foreground' => 'cyan'));

        // Comments
        $this->add('comment', array('foreground' => 'yellow'));

        // Info
        $this->add('info', array('foreground' => 'cyan'));

        // Errors
        $this->add('error', array('foreground' => 'white', 'background' => 'red'));
    }
} // END class FormatCollection
