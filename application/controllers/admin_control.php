<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Admin_control extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		/*$this->load->model('employee', '', TRUE);*/
		/*$this->output->enable_profiler(TRUE);*/
	}

	function index()
	{
		if( $this->session->userdata('logged_in') )
		{
			$session_data = $this->session->userdata('logged_in');
			$is_admin = $session_data['is_admin'];
			if( $is_admin==1 )
			{
				$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
			}
			else
			{
				echo "permission denied";
			}
		}
		else
		{
			redirect('login', 'refresh');
		}
		/*if($this->session->userdata('logged_in')) {
			$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()),$data);
		}
		else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}*/
	}

    public function user_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('employees');
			$crud->columns('employee_id','name','password','admin');

			$output = $crud->render();

			$this->_example_output($output);
	}

	public function project_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('projects');
			$crud->columns('project_id','name');

			$output = $crud->render();

			$this->_example_output($output);
	}

	public function timecard_management()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('timecards');
			$crud->columns('timecard_id','start_time',
				'end_time','paid');
			
			$output = $crud->render();

			$this->_example_output($output);
	}

	public function logout_management()
	{
		redirect('login','refresh');
	}

	public function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}

	function _example_output($output = null)
    {
        $this->load->view('admin_view.php',$output);    
    }

}