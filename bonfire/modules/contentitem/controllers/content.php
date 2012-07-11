<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class content extends Admin_Controller {

	//--------------------------------------------------------------------

	public function __construct() 
	{
		parent::__construct();

		$this->auth->restrict('ContentItem.Content.View');
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
		Assets::add_js($this->load->view('content/js', null, true), 'inline');
		
		Template::set('records', $this->contentitem_model->find_all());
		Template::set('toolbar_title', "Manage ContentItem");
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: create()
		
		Creates a ContentItem object.
	*/
	public function create() 
	{
		$this->auth->restrict('ContentItem.Content.Create');

		if ($this->input->post('submit'))
		{
			if ($insert_id = $this->save_contentitem())
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('contentitem_act_create_record').': ' . $insert_id . ' : ' . $this->input->ip_address(), 'contentitem');
					
				Template::set_message(lang("contentitem_create_success"), 'success');
				Template::redirect(SITE_AREA .'/content/contentitem');
			}
			else 
			{
				Template::set_message(lang('contentitem_create_failure') . $this->contentitem_model->error, 'error');
			}
		}
	
		Template::set('toolbar_title', lang('contentitem_create_new_button'));
		Template::set('toolbar_title', lang('contentitem_create') . ' ContentItem');
		Template::render();
	}
	
	//--------------------------------------------------------------------

	/*
		Method: edit()
		
		Allows editing of ContentItem data.
	*/
	public function edit() 
	{
		$this->auth->restrict('ContentItem.Content.Edit');

		$id = (int)$this->uri->segment(5);
		
		if (empty($id))
		{
			Template::set_message(lang('contentitem_invalid_id'), 'error');
			redirect(SITE_AREA .'/content/contentitem');
		}
	
		if ($this->input->post('submit'))
		{
			if ($this->save_contentitem('update', $id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('contentitem_act_edit_record').': ' . $id . ' : ' . $this->input->ip_address(), 'contentitem');
					
				Template::set_message(lang('contentitem_edit_success'), 'success');
			}
			else 
			{
				Template::set_message(lang('contentitem_edit_failure') . $this->contentitem_model->error, 'error');
			}
		}
		
		Template::set('contentitem', $this->contentitem_model->find($id));
	
		Template::set('toolbar_title', lang('contentitem_edit_heading'));
		Template::set('toolbar_title', lang('contentitem_edit') . ' ContentItem');
		Template::render();		
	}
	
	//--------------------------------------------------------------------

	/*
		Method: delete()
		
		Allows deleting of ContentItem data.
	*/
	public function delete() 
	{	
		$this->auth->restrict('ContentItem.Content.Delete');

		$id = $this->uri->segment(5);
	
		if (!empty($id))
		{	
			if ($this->contentitem_model->delete($id))
			{
				// Log the activity
				$this->activity_model->log_activity($this->auth->user_id(), lang('contentitem_act_delete_record').': ' . $id . ' : ' . $this->input->ip_address(), 'contentitem');
					
				Template::set_message(lang('contentitem_delete_success'), 'success');
			} else
			{
				Template::set_message(lang('contentitem_delete_failure') . $this->contentitem_model->error, 'error');
			}
		}
		
		redirect(SITE_AREA .'/content/contentitem');
	}
	
	//--------------------------------------------------------------------

	//--------------------------------------------------------------------
	// !PRIVATE METHODS
	//--------------------------------------------------------------------
	
	/*
		Method: save_contentitem()
		
		Does the actual validation and saving of form data.
		
		Parameters:
			$type	- Either "insert" or "update"
			$id		- The ID of the record to update. Not needed for inserts.
		
		Returns:
			An INT id for successful inserts. If updating, returns TRUE on success.
			Otherwise, returns FALSE.
	*/
	private function save_contentitem($type='insert', $id=0) 
	{	
					
		$this->form_validation->set_rules('contentitem_teaser','Teaser','required|trim|max_length[255]');			
		$this->form_validation->set_rules('contentitem_body','Body','max_length[2000]');

		if ($this->form_validation->run() === FALSE)
		{
			return FALSE;
		}
		
		// make sure we only pass in the fields we want
		
		$data = array();
		$data['contentitem_teaser']        = $this->input->post('contentitem_teaser');
		$data['contentitem_body']        = $this->input->post('contentitem_body');
		
		if ($type == 'insert')
		{
			$id = $this->contentitem_model->insert($data);
			
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
			$return = $this->contentitem_model->update($id, $data);
		}
		
		return $return;
	}

	//--------------------------------------------------------------------



}