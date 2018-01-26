<?php
/**
* 
*/
class Modelku extends CI_Model
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function cek_user($uname, $pass)
	{
		$qry = $this->db->query("select * from tbuser where username='$uname' and password='$pass'");
		return $qry;
	}

	public function input_data($data, $table)
	{
		$this->db->insert($table,$data);
	}
}