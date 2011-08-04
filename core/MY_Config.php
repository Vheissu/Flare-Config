<?php

class MY_Config extends CI_Config {
    
    protected $ci_;
    
    public function __construct()
    {
        parent::__construct();
        $this->ci_ = get_instance();
    }
    
    /**
     * Load Config File
     *
     * @access    public
     * All variables besides $file aren't used. Just here for legacy support.
     */
    function load($file = '', $use_sections = FALSE, $fail_gracefully = FALSE)
    {
        return $this->ci_->flareconfig->load_config($file);
    }
    
    /**
     * Fetch a config file item
     *
     * All variables except $item aren't used. Just here for legacy support.
     */
    function item($item, $index = '')
    {
        return $this->ci_->flareconfig->item($item);
    
    
    /**
     * Fetches all config file items
     *
     * All variables except $item aren't used. Just here for legacy support.
     */
    function items()
    {
        return $this->ci_->flareconfig->items();
    }
    
    /**
     * Fetch a config file item - adds slash after item
     *
     * The second parameter allows a slash to be added to the end of
     * the item, in the case of a path.
     *
     * @access    public
     */
    function slash_item($item)
    {
        $config_item = $this->ci_->flareconfig->item($item); 
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
    function set_item($item, $value)
    {
        $this->ci_->flareconfig->set_item($item, $value);
    }
    
}
