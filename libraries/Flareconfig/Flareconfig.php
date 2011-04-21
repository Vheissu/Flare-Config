<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* @name Flare Config
* @copyright 2011
* @author Dwayne Charrington
* @license http://philsturgeon.co.uk/code/dbad-license
* @version 1.0
*/

class Flareconfig extends CI_Driver_Library {
    
    /**
    * Codeigniter instance
    * 
    * @var mixed
    */
	protected $ci;
    
    /**
    * Currently used driver
    * 
    * @var mixed
    */
	protected $_driver;
    
    /**
    * Valid drivers
    * 
    * @var mixed
    */
    protected $valid_drivers = array(
        'flareconfig_yaml',
        'flareconfig_xml'
    );
    
    /**
    * Constructor
    */
    public function __construct()
    {
        // Get Codeigniter instance
        $this->ci = get_instance();
    }
    
    /**
    * Load a configuration file
    * 
    * @param mixed $file
    * @returns void
    */
    public function load_config($file = '')
    {
        return $this->{$this->_driver}->load_config($file);
    }
    
    /**
    * Get a config item
    * 
    * @param mixed $name
    * @returns void
    */
    public function item($name)
    {
        return $this->{$this->_driver}->item($name);
    }
    
    /**
    * Set a config item
    * 
    * @param mixed $name
    * @param mixed $value
    * @param mixed $override
    * @returns void
    */
    public function set_item($name, $value, $override = true)
    {
        return $this->{$this->_driver}->set_item($name, $value, $override);
    }

}