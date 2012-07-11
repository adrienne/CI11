<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Developer extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct()	{
		parent::__construct();
		
		$this->auth->restrict('Site.Developer.View');
		
		Template::set('toolbar_title', 'Developer Tools');
	}
	
	//--------------------------------------------------------------------	

	public function index()	{
		$modules = module_list();
		$configs = array();
	
		foreach ($modules as $module)	{
			$configs[$module] = module_config($module);
			if (!isset($configs[$module]['name']))
			{
				$configs[$module]['name'] = ucwords($module);
			}
			else
			{
				if(is_array($configs[$module]['name']))
				{
					if(isset ($configs[$module]['name'][$this->config->item('language')]))
						$configs[$module]['name'] = $configs[$module]['name'][$this->config->item('language')];
					else if(isset ($configs[$module]['name'][$this->config->item('english')]))
						$configs[$module]['name'] = $configs[$module]['name'][$this->config->item('english')];
				}
			}
			
			if (!isset($configs[$module]['description']))
			{
				$configs[$module]['description'] = '---';
			}
			else
			{
				if(is_array($configs[$module]['description']))
				{
					if(isset ($configs[$module]['description'][$this->config->item('language')]))
						$configs[$module]['description'] = $configs[$module]['description'][$this->config->item('language')];
					else if(isset ($configs[$module]['description'][$this->config->item('english')]))
						$configs[$module]['description'] = $configs[$module]['description'][$this->config->item('english')];
				}
			}                        
		}
		
		ksort($configs);
		Template::set('modules', $configs);
	
		Template::set_view('admin/developer/index');
		Template::render();
	}
}
