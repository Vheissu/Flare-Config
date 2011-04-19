<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* @name Flare Config
* @copyright 2011
* @author Dwayne Charrington
* @license http://philsturgeon.co.uk/code/dbad-license
* @version 1.0
*/

require_once APPPATH . "third_party/Yaml/Yaml.php";

class Flareconfig_yaml extends CI_Driver_Library {

	protected $ci;
    
    /**
    * Where our Yaml class instance is stored
    * 
    * @var mixed
    */
    protected $_yaml;
    
    public $is_loaded = array();
    public $config = array();
    public $_config_paths = array(APPPATH);
    
    /**
    * Constructor function
    * 
    */
    public function __construct()
    {
        $this->ci     = get_instance();
        $this->config = get_config();
        $this->_yaml  = new Yaml;
    }
    
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
            $check_locations = defined('ENVIRONMENT')
                ? array(ENVIRONMENT.'/'.$file, $file)
                : array($file);

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
            $yaml_contents = $this->_yaml->load($file_path);

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

}