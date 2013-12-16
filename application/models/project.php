<?php

Class Project extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }

	function get_all_project_name()
	{
		$this -> db -> select('name');
		$this -> db -> from('projects');
		$query = $this -> db -> get();
		if ($query -> num_rows > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}

	function get_project_id($project_name)
	{
		$this -> db -> select('project_id');
		$this -> db -> from('projects');
		$this -> db -> where('name', $project_name);

		$query = $this -> db -> get();

		if ($query -> num_rows > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
	
}