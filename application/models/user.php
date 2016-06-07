<?php
Class User extends CI_Model
{

	function teste()
		{
				$this->db->select('USER_NAME,USER_PASSWORD,USER_EMAIL');
				$result = $this->db->get('USERS');
				return $result->result();
		}

	function login($username, $password)
	{
		$this -> db -> select('USER_ID, USER_NAME, USER_PASSWORD');
		$this -> db -> from('USERS');
		$this -> db -> where('USER_NAME = ' . "'" . $username . "'");
		$this -> db -> where('USER_PASSWORD = ' . "'" . MD5($password) . "'");
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

	function register ($info)
	{
		$this->db->trans_begin();

//INSERT QUERY
	$query =
				"INSERT INTO USERS
				(USER_NAME,USER_PASSWORD,USER_PHONE,USER_EMAIL)
				VALUES
				(
						'".$info['USER_NAME']."',
						'".$info['USER_PASSWORD']."',
						PHONE_LIST_TYPE('".$info['USER_PHONE']."'),
						EMAIL_LIST_TYPE('".$info['USER_EMAIL']."')
				)
				";

//TRANSACTION

		$result =	$this->db->query($query);
		if ($this->db->trans_status() === FALSE)
		{
		    $this->db->trans_rollback();
		}
		else
		{
		    $this->db->trans_commit();
		}
	return TRUE;
//END OF TRANSACTION
	}
function check_username($username)
{
	$this->db->trans_begin();
	$query = "SELECT USER_NAME FROM USERS WHERE USER_NAME = '".$username."'";

	$result = $this->db->query($query);
	$rows = $result->num_rows();
	if ($this->db->trans_status() === FALSE)
	{
			$this->db->trans_rollback();
	}
	else
	{
			$this->db->trans_commit();
	}
return $rows;
}
}
?>
