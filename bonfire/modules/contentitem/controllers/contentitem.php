<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class contentitem extends Front_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->load->library('form_validation');
		$this->form_validation->CI =& $this;
		$this->load->model('contentitem_model', null, true);
		$this->lang->load('contentitem');
		
		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		Template::set('records', $this->contentitem_model->find_all());
		Template::render();
	}
	
	//--------------------------------------------------------------------



}