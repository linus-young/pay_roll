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
	
}