<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends Front_Controller {

	public function __construct() {
		parent::__construct();
	
		$this->load->model('todo/todo_model', null, true);
		$this->load->model('contentitem/contentitem_model', null, true);
	}
	
	public function index() {	
		Template::set_theme("newest");
		
		Template::render();
	}
	
  public function dashboard($id = 0)	{	
		Template::set_theme("newest");
		
		Assets::add_js($this->load->view('home/js', null, true), 'inline');
		
		Template::set('message', "Welcome to CI11");
		
		$todo_records = $this->todo_model->find_all();
		$contentitem_records = $this->contentitem_model->find_all();
		
		$panels = array();
		$records = array();
		
		if ($id && $id == 1) {
			$panels[] = '_partials/contentitems';
			$records[] = $contentitem_records;
			
			$panels[] = '_partials/todos';
			$records[] = $todo_records;
		}
		else {
			$panels[] = '_partials/todos';
			$records[] = $todo_records;
			
			$panels[] = '_partials/contentitems';
			$records[] = $contentitem_records;
		}
		
		Template::set('panels', $panels);
		Template::set('records', $records);
		
		Template::render();
	}
}