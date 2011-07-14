<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* @name Flare Config
* @copyright 2011
* @author Dwayne Charrington
* @license Do What You Want, As Long As You Attribute Me (DWYWALAYAM) Licence
* @version 1.0
*/

// Required Yaml parsing file to parse out Yaml config files
require_once APPPATH . "third_party/Yaml/Yaml.php";

class Flareconfig_yaml extends CI_Driver_Library {
    
    /**
    * Codeigniter instance
    * 
    * @var mixed
    */
	protected $ci;
    
    /**
    * Where our Yaml class instance is stored
    * 
    * @var mixed
    */
    protected $_yaml;
    
    /**
    * Config values
    * 
    * @var mixed
    */
    protected $_config = array();
    
    /**
    * Is loaded?
    * 
    * @var mixed
    */
    protected $is_loaded = array();
    
    /**
    * Config file paths
    * 
    * @var mixed
    */
    public $_config_paths = array(APPPATH);
    
    /**
    * Constructor function
    */
    public function __construct()
    {
        $this->ci     = get_instance();
        $this->_yaml  = new Yaml;
    }
    
    public function decorate() { }
    
    /**
    * Load our Yaml configuration file
    * 
    * @param mixed $file
    * @returns void
    */
    public function load_config($file = '')
    {
        $file = ($file == '') ? 'config' : str_replace(EXT, '', $file);
        $found = FALSE;
        $loaded = FALSE;

        foreach ($this->_config_paths as $path)
        {
            // Check if we have an environment variable set
            $check_locations = defined('ENVIRONMENT') ? array(ENVIRONMENT.'/'.$file, $file) : array($file);

            foreach ($check_locations as $location)
            {
                $file_path = $path.'config/'.$location.".yaml";

                if (in_array($file_path, $this->is_loaded, TRUE))
                {
                    $loaded = TRUE;
                    continue 2;
                }

                if (file_exists($file_path))
                {
                    $found = TRUE;
                    break;
                }
            }

            if ($found === FALSE)
            {
                continue;
            }
            
            // Our Yaml contents returned as an array
            $yaml_array = $this->_yaml->load($file_path);
            
            // Set the config options
            foreach ($yaml_array AS $key => $val)
            {
                // If already set, don't overwrite
                if (array_key_exists($key, $this->_config))
                {
                    continue;
                }
                else
                {
                    $this->_config[$key] = $val;   
                }
            }

            $this->is_loaded[] = $file_path;

            $loaded = TRUE;
            log_message('debug', 'Config file loaded: '.$file_path);
        }

        if ($loaded === FALSE)
        {
            show_error('The configuration file '.$file.EXT.' does not exist.');
        }

        return TRUE;
    }
    
    /**
    * Config item
    * Will get a config item value
    * 
    * @param mixed $name
    * @returns void
    */
    public function item($name)
    {
        if (array_key_exists($name, $this->_config))
        {
            return $this->_config[$name];
        }
        else
        {
            return null;
        }
    }
    
    /**
    * Config items
    * Returns all config items in class array
    * 
    */
    public function items()
    {
        if ( is_array($this->_config) AND !empty($this->_config) )
        {
            return $this->_config;
        }
    }
    
    /**
    * Set item
    * Sets a new config key/value pair
    * 
    * @param mixed $name
    * @param mixed $value
    * @param mixed $override
    * @returns void
    */
    public function set_item($name, $value, $override = true)
    {
        // Is there already a config item of the same name?
        if (array_key_exists($name, $this->_config))
        {
            // If we can overwrite, overwrite it
            if ($override === true)
            {
                $this->_config[$name] = $value;
            }
            // You're not touchin' a thing boy.
            else
            {
                return false;
            }
        }
    }

}