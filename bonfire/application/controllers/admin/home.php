<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Admin_Controller {

	public function __construct()	{
		parent::__construct();
		
		$this->auth->restrict();
	}	

	public function index()	{
		redirect(SITE_AREA .'/content');
	}
}

// End Admin class