<?php
Class DayWork extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }

    function create($employee_id, $timecard_id, $project_id)
    {
    	$data = array(
    				 'employee_id' => $employee_id,
    				 'timecard_id' => $timecard_id,
    				 'project_id' => $project_id
    				 );
    	$this -> db -> insert('dayworks', $data);
    }
}