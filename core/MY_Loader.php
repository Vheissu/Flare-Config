<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
* @name Flare Config
* @copyright 2011
* @author Dwayne Charrington
* @license http://philsturgeon.co.uk/code/dbad-license
* @version 1.0
*/

class MY_Loader extends CI_Loader {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function config($file = '', $use_sections = FALSE, $fail_gracefully = FALSE)
	{
		$this->load_config($file, $use_sections, $fail_gracefully);
	}

	private function load_config($file = '', $use_sections = FALSE, $fail_gracefully = FALSE)
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
				$file_path = $path.'config/'.$location.EXT;

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

			include($file_path);

			if ( ! isset($config) OR ! is_array($config))
			{
				if ($fail_gracefully === TRUE)
				{
					return FALSE;
				}
				show_error('Your '.$file_path.' file does not appear to contain a valid configuration array.');
			}

			if ($use_sections === TRUE)
			{
				if (isset($this->config[$file]))
				{
					$this->config[$file] = array_merge($this->config[$file], $config);
				}
				else
				{
					$this->config[$file] = $config;
				}
			}
			else
			{
				$this->config = array_merge($this->config, $config);
			}

			$this->is_loaded[] = $file_path;
			unset($config);

			$loaded = TRUE;
			log_message('debug', 'Config file loaded: '.$file_path);
		}

		if ($loaded === FALSE)
		{
			if ($fail_gracefully === TRUE)
			{
				return FALSE;
			}
			show_error('The configuration file '.$file.EXT.' does not exist.');
		}

		return TRUE;
	}

}