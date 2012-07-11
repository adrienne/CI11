<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends Admin_Controller {

	public function __construct()	{
		parent::__construct();
		
		Template::set('toolbar_title', 'Reports');
		
		$this->auth->restrict('Site.Reports.View');
	}
	
	public function index() {	
		Template::set_view('admin/reports/index');
		Template::render();
	}
}