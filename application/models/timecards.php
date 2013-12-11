<?php
Class Timecard extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }

	function timecard($employee_id)
	{
		$this-> db -> select('timecard_id,start_time,end_time,paid');
		$this-> db -> from('timecards natural join days');
		$this-> db -> where('employee_id',$employee_id)

		$query =$this -> db -> get();

		if ($query -> num_rows > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
}