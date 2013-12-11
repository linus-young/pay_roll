<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('project', '', TRUE);
		$this->load->helper('form');
	}

	function index()
	{
		if($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$is_admin = $session_data['is_admin'];
			$data['name'] = $session_data['name'];

			$result = $this->project->get_all_project_name();
			$data['project_list'] = $result;
			$this->load->view('home_view', $data);
		}
		else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('home', 'refresh');
	}
}