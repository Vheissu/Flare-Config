<?php

class MY_Config extends CI_Config {
    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->driver('flare');
    }
    
    /**
    * Config Type
    * Set the type of config file to use
    * 
    * @param mixed $type
    */
    public function config_type($type)
    {
        if ( $type == 'yaml' )
        {
            $this->flare->set_driver('yaml');
        }
        elseif ( $type == 'xml' )
        {
           $this->flare->set_driver('xml'); 
        }        
    }
    
    /**
     * Load Config File
     *
     * All variables besides $file aren't used. Just here for legacy support.
     *
     * @access    public
     * @param mixed $file
     * @param bool $use_sections
     * @param bool $fail_gracefully
     *
     * @return bool
     */
    public function load($file = '', $use_sections = FALSE, $fail_gracefully = FALSE)
    {
        return $this->flare->load_config($file);
    }
    
    /**
     * Fetch a config file item
     *
     * All variables except $item aren't used. Just here for legacy support.
     */
    public function item($item, $index = '')
    {
        return $this->flare->item($item);
    
    }
    
    /**
     * Fetches all config file items
     *
     * All variables except $item aren't used. Just here for legacy support.
     */
    public function items()
    {
        return $this->flare->items();
    }
    
    /**
     * Fetch a config file item - adds slash after item
     *
     * The second parameter allows a slash to be added to the end of
     * the item, in the case of a path.
     *
     * @access    public
     */
    public function slash_item($item)
    {
        $config_item = $this->flare->item($item); 
        $config_item = rtrim($config_item, '/').'/'; 

        return $config_item;
    }
    
    /**
     * Set a config file item
     *
     * @access    public
     * @param    string    the config item key
     * @param    string    the config item value
     * @return    void
     */
    public function set_item($item, $value)
    {
        $this->flare->set_item($item, $value);
    }
    
}
