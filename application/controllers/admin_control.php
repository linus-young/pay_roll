<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Admin_Control extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('grocery_CRUD');
		$this->output->enable_profiler(TRUE);
	}

	function index()
	{
	}

    public function user_management()
	{
		if($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$is_admin = $session_data['is_admin'];
			if( $is_admin==1 ) {
				$crud = new grocery_CRUD();

				$crud->set_theme('twitter-bootstrap');
				$crud->set_table('employees');
				//$crud->columns('employee_id','name','password','admin');
				$crud->display_as('type_id', 'Job Title');
				$crud->set_relation('type_id', 'types', 'position');

				$output = $crud->render();

				$this->_example_output($output);
			} 
			else {
				echo "permission denied, please login as admin";
			}
		}
		else {
			redirect('login', 'refresh');
		}
	}

	public function project_management()
	{
		if($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$is_admin = $session_data['is_admin'];
			if( $is_admin==1 ) {
				$crud = new grocery_CRUD();

				$crud->set_theme('twitter-bootstrap');
				$crud->set_table('projects');
				$crud->columns('project_id','name');
				$crud->required_fields('name');

				$output = $crud->render();

				$this->_example_output($output);
			} else {
				echo "permission denied, please login as admin";
			}
		}
		else {
			redirect('login', 'refresh');
		}
	}

	public function timecard_management()
	{
		if($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$is_admin = $session_data['is_admin'];
			if( $is_admin==1 ) {
				$crud = new grocery_CRUD();
				$crud->set_theme('twitter-bootstrap');

				$crud->set_table('timecards');
				$crud->columns('timecard_id','start_time',
					'end_time', 'submitted', 'paid');
				$crud->required_fields('start_time',
					'end_time', 'submitted', 'paid');
				$crud->set_rules('start_time', 'Start Time', 'datetime');
				$crud->set_rules('end_time', 'Stop Time', 'datetime');
				// timecard cannot be created by admin but can be crud by DBA.
				$crud->unset_add();
				
				$output = $crud->render();

				$this->_example_output($output);
			} 
			else {
				echo "permission denied, please login as admin";
			}
		}
		else {
			redirect('login', 'refresh');
		}
	}

	function this_week_timecard_management()
	{
		if($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$is_admin = $session_data['is_admin'];
			if( $is_admin==1 ) {


				$crud = new grocery_CRUD();
				$crud->set_theme('twitter-bootstrap');

				$crud->set_table('timecards');

				$crud->columns('timecard_id','start_time',
					'end_time', 'submitted', 'paid');
				$crud->set_rules('start_time', 'Start Time', 'datetime');
				$crud->set_rules('end_time', 'Stop Time', 'datetime');

				if($_POST) {
					$crud->where('submitted', 'inactive');
					$crud->callback_column('submitted', array($this, '_callback_submitted'));
					$crud->unset_operations();
				}
				else {
					$crud->required_fields('start_time',
						'end_time', 'submitted', 'paid');
					
					$crud->unset_add();
				}
				
				
				$output = $crud->render();

				$this->_example_output($output);
			} 
			else {
				echo "permission denied, please login as admin";
			}
		}
		else {
			redirect('login', 'refresh');
		}
	}

	public function _callback_submitted($value, $row)
	{
		return 1;
	}

	// public function submit_this_week_timecard()
	// {
	// 	if($this->session->userdata('logged_in')) {
	// 		$session_data = $this->session->userdata('logged_in');
	// 		$is_admin = $session_data['is_admin'];
	// 		if( $is_admin==1 ) {
	// 			$crud = new grocery_CRUD();
	// 			$crud->set_theme('twitter-bootstrap');
	// 			$crud->where('submitted', 'inactive');

	// 			$crud->set_table('timecards');
	// 			$crud->columns('timecard_id','start_time',
	// 				'end_time', 'submitted', 'paid');
	// 			$crud->change_field_type('submitted', 'hidden', 'active');
	// 			$crud->set_rules('start_time', 'Start Time', 'datetime');
	// 			$crud->set_rules('end_time', 'Stop Time', 'datetime');

	// 			//$crud->unset_add();
	// 			$crud->unset_operations();

	// 			$output = $crud->render();

	// 			$this->_example_output($output);
	// 		}
	// 		else {
	// 			echo "permission denied, please login as admin";
	// 		}
	// 	}
	// 	else {
	// 		redirect('login', 'refresh');
	// 	}

	// }


	public function print_management()
	{
		$crud = new grocery_CRUD();
		$crud->set_theme('twitter-bootstrap');
		$this->load->model('print_model');
		$this->print_model->solve('employees','types');
		$crud->set_table('print');
		$crud->columns('name','position','wage','bank_account');
	
		$output = $crud->render();
		$this->_example_output($output);
	}

	public function logout_management()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('login','refresh');
	}

	function _example_output($output = null)
    {
        $this->load->view('admin_view.php',$output);    
    }

}