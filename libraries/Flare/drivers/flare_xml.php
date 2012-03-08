<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* @name Flare Config
* @copyright 2012
* @author Dwayne Charrington
* @license http://www.apache.org/licenses/LICENSE-2.0.html
* @version 1.0
*/

class Flare_xml extends CI_Driver_Library {

	protected $ci;
    
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
                $file_path = $path.'config/'.$location.".xml";

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
            
            // Load our XML file
            $xml_contents = simplexml_load_file($file_path);
            
            // If we have XML contents
            if ($xml_contents === TRUE)
            {
                $this->is_loaded[] = $file_path;
                
                foreach ($xml_contents AS $key => $val)
                {
                    $this->config[$key] = $val;
                }

                $loaded = TRUE;
                log_message('debug', 'Config file loaded: '.$file_path);   
            }
        }

        if ($loaded === FALSE)
        {
            show_error('The configuration file '.$file.EXT.' does not exist.');
        }

        return TRUE;
    }

}