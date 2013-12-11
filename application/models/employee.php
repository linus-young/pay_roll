<?php
Class Employee extends CI_Model
{
	function __construct()
    {
        parent::__construct();
    }

	function login($name, $password)
	{
		$this -> db -> select('employee_id, name, password, admin');
		$this -> db -> from('employees');
		$this -> db -> where('name', $name);
		$this -> db -> where('password', MD5($password));
		$this -> db -> limit(1);

		$query = $this -> db -> get();

		if($query -> num_rows() == 1) {
		 return $query->result();
		} else {
		 return false;
		}
	}

	function user()
	{
		$this-> db -> select('employee_id,name,password,bank_account,type_id,admin');
		$this-> db -> from('employees');

		$query =$this -> db -> get();

		if ($query -> num_rows > 0) {
			return $query -> result_array();
		} else {
			return false;
		}
	}
}