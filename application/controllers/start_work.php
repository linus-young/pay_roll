<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Start_work extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function index()
	{
		if($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$is_admin = $session_data['is_admin'];
			$data['name'] = $session_data['name'];

			$this->load->view('start_view', $data);
		}
		else {
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function confirm_project()
	{
		$data['confirm_project'] = 	TRUE;
		redirect('home', 'refresh');
	}
}