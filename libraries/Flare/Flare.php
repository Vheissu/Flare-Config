<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* @name Flare Config
* @copyright 2012
* @author Dwayne Charrington
* @license http://www.apache.org/licenses/LICENSE-2.0.html
* @version 1.0
*/

class Flare extends CI_Driver_Library {
    
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
	protected $_driver = 'yaml';
    
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
        $this->ci =& get_instance();
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
    * Get all config items
    * 
    */
    public function items()
    {
        return $this->{$this->_driver}->items();
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
    
	/**
	* Set Driver
	*
	* Set the config file parsing driver to use
	*
	* @param string $driver
	*
    public function set_driver($driver)
    {
        $this->_driver = $driver;
    }

}