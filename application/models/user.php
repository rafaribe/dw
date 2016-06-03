<?php
Class User extends CI_Model
{
	function login($username, $password)
	{
		$this -> db -> select('USER_ID, USER_NAME, USER_PASSWORD');
		$this -> db -> from('USERS');
		$this -> db -> where('USER_NAME = ' . "'" . $username . "'");
		$this -> db -> where('USER_PASSWORD = ' . "'" . $password . "'");
		$this -> db -> limit(1);

		$query = $this -> db -> get();

		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}

	}
}
?>
