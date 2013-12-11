<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

	function __construct()
 	{
		parent::__construct();
		$this->load->model('employee','',TRUE);
 	}

 	function index()
 	{
		//This method will have the credentials validation
	 	$this->load->library('form_validation');

		$this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

		if($this->form_validation->run() == FALSE) {
		 	//Field validation failed.&nbsp; User redirected to login page
			$this->load->view('login_view', 'refresh');
		} else {
			//Go to private area
			if( $this->session->userdata('logged_in') ){
				$session_data = $this->session->userdata('logged_in');
				$is_admin = $session_data['is_admin'];
				if( $is_admin== 0 )
				{
					redirect('home', 'refresh');
				}
				if( $is_admin== 1 )
				{
					redirect('admin_control', 'refresh');
				}
			}
		}

 	}

	function check_database($password)
	{
		//Field validation succeeded.&nbsp; Validate against database
		$name = $this->input->post('name');

		//query the database
		$result = $this->employee->login($name, $password);

		if($result) {
			$sess_array = array();
			foreach($result as $row) {
		 		$sess_array = array(
					'id' => $row->employee_id,
					'name' => $row->name,
					'is_admin'=> $row->admin
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return TRUE;
		}
		else {
			$this->form_validation->set_message('check_database', 'Invalid username or password');
		 	return false;
		}
	}
}