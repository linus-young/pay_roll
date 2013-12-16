<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class WorkStuff extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('project', '', TRUE);
		$this->load->model('timecard', '', TRUE);
		$this->load->model('daywork', '', TRUE);
		$this->load->helper('form');
		$this->output->enable_profiler(TRUE);
	}

	function index()
	{
	}

	function confirm_project()
	{
		if($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$is_admin = $session_data['is_admin'];
			$data['name'] = $session_data['name'];
			$data['confirm_project'] = 	TRUE;
			$project_name = $_POST['p_name_arr'][0];
			$data['project_selected'] = $project_name;

			// get selected project id and store it in session data.
			$result = $this->project->get_project_id($project_name);
			$project_id = $result[0]['project_id'];
			$this->session->set_userdata('project_id', $project_id);

			$this->load->view('confirm_project_view', $data);
		}
		else {
			redirect('login', 'refresh');
		}
	}

	function start_work()
	{
		if($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$is_admin = $session_data['is_admin'];
			$data['name'] = $session_data['name'];
			$data['start_work'] = TRUE;

			$start_time = date('Y-m-d H:i:s');
			// create a new timecard for this employee and return the record id.
			$timecard_id =  $this->timecard->create($start_time, $start_time);
			$this->session->set_userdata('timecard_id', $timecard_id); 

			$this->load->view('start_work_view', $data);
		}
		else {
			redirect('login', 'refresh');
		}
	}


	function stop_work()
	{
		if($this->session->userdata('logged_in')) {
			$session_data = $this->session->userdata('logged_in');
			$is_admin = $session_data['is_admin'];
			$data['name'] = $session_data['name'];
			$data['stop_work'] = TRUE;
			
			// update stop time in database.
			$stop_time = date('Y-m-d H:i:s');
			$timecard_id = $this->session->userdata('timecard_id');
			$this->timecard->update($timecard_id, $stop_time);
			
			// create a new data in dayworks table.
			$logged_in_data = $this->session->userdata('logged_in');
			$employee_id = $logged_in_data['id'];
			$project_id = $this->session->userdata('project_id');
			$this->daywork->create($employee_id, $timecard_id, $project_id);

			$this->load->view('stop_work_view', $data);
		}
		else {
			redirect('login', 'refresh');
		}

	}
}