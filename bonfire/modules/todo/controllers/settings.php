<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class settings extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('ToDo.Settings.View');
		$this->load->model('todo_model', null, true);
		$this->lang->load('todo');
		
		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: index()
		
		Displays a list of form data.
	*/
	public function index() 
	{
		Assets::add_js($this->load->view('settings/js', null, true), 'inline');
		
		Template::set('records', $this->todo_model->find_all());
		Template::set('toolbar_title', "Manage ToDo");
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: create()
		
		Creates a ToDo object.
	*/
	public function create() 
	{
		$this->auth->restrict('ToDo.Settings.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_todo())
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('todo_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'todo');
					
				Template::set_message(lang("todo_create_success"), 'success');
				Template::redirect(SITE_AREA .'/settings/todo');
			}
			else 
			{
				Template::set_message(lang('todo_create_failure') . $this->todo_model->error, 'error');
			}
		}
	
		Template::set('toolbar_title', lang('todo_create_new_button'));
		Template::set('toolbar_title', lang('todo_create') . ' ToDo');
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: edit()
		
		Allows editing of ToDo data.
	*/
	public function edit() 
	{
		$this->auth->restrict('ToDo.Settings.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang('todo_invalid_id'), 'error');
			redirect(SITE_AREA .'/settings/todo');
		}
	
		if ($this->input->post('submit'))
		{
			if ($this->save_todo('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('todo_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'todo');
					
				Template::set_message(lang('todo_edit_success'), 'success');
			}
			else 
			{
				Template::set_message(lang('todo_edit_failure') . $this->todo_model->error, 'error');
			}
		}
		
		Template::set('todo', $this->todo_model->find($id));
	
		Template::set('toolbar_title', lang('todo_edit_heading'));
		Template::set('toolbar_title', lang('todo_edit') . ' ToDo');
		Template::render();		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: delete()
		
		Allows deleting of ToDo data.
	*/
	public function delete() 
	{	
		$this->auth->restrict('ToDo.Settings.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->todo_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('todo_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'todo');
					
				Template::set_message(lang('todo_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('todo_delete_failure') . $this->todo_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA .'/settings/todo');
	}
	
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	/*
		Method: save_todo()
		
		Does the actual validation and saving of form data.
		
		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.
		
		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_todo($type='insert', $id=0) 
	{	
					
		$this->form_validation->set_rules('todo_description','Description','max_length[255]');			
		$this->form_validation->set_rules('todo_person','Person','max_length[255]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['todo_description']        = $this->input->post('todo_description');
		$data['todo_person']        = $this->input->post('todo_person');
		
		if ($type == 'insert')
		{
			$id = $this->todo_model->insert($data);
			
			if (is_numeric($id))
			{
				$return = $id;
			} else
			{
				$return = FALSE;
			}
		}
		else if ($type == 'update')
		{
			$return = $this->todo_model->update($id, $data);
		}
		
		return $return;
	}

	//--------------------------------------------------------------------



}