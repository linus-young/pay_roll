<?php
Class Timecard extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }

	function timecard($employee_id)
	{
		$this-> db -> select('timecard_id, start_time, end_time, paid');
		$this-> db -> from('timecards natural join dayworks');
		$this-> db -> where('employee_id', $employee_id);

		$query = $this -> db -> get();

		if ($query -> num_rows > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}

	function create($start_time, $end_time)
	{
		$entry = array(
					 'start_time' => $start_time,
					 'end_time'   => $end_time,
					 'submitted'  => FALSE,
					 'paid'		  => FALSE
					 );
		$this -> db -> insert('timecards', $entry);
		$insert_id = $this -> db -> insert_id();
		return $insert_id;
	}

	function update($tc_id, $end_time)
	{
		$data = array('end_time' => $end_time);
		$this -> db ->where('timecard_id', $tc_id);
		$this -> db -> update('timecards', $data);
	}
}