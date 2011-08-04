#Flare Config

I personally am not a huge fan of how complicated the Symfony PHP framework is, but I am a fan of how it allows you to have config files in either PHP, XML or Yaml format.

Soemtimes writing Yaml or XML makes more sense and is definitely cleaner than writing $config['itemname'] all of the time.

Sure loading config files other than the standard way will have a little overheard for the Yaml or XML parsing, but very minimal at that.

##Using Flare Config
You load your config files like you would normally. The CI Config class is overriden via a MY_Config class which means you'll have to use the Flareconfig method of accessing config variables as opposed to the usual CI way. Although, simply remove the MY_Config file to have the option of using XML, Yaml and Standard CI config files without losing the functionality.

I don't recommend using the custom MY_Config file if you haven't ported over your config files to be either XML or Yaml because the overiding method does not allow default CI config functionality. This is coming soon though.

### Without MY_Config
If you delete the file MY_Config from the core directory in the Flare Config download, you'll have to use Flare Config via the following means.

* Load the Flare Config driver: $this->load->driver('flareconfig'); from within a controller or whever.
* In libraries/Flareconfig/Flareconfig.php edit $_driver to be that of the driver you want to use. By default the 'flareconfig_yaml' is used (without quotes of course), but you can change this to be 'flareconfig_xml' or any other driver you might have created yourself.
* Use like so: $this->flareconfig->load_config('filename'); then $this->flareconfig->item('itemname') to get a config value or to set a config value $this->flareconfig->set_item('itemname', 'itemvalue');