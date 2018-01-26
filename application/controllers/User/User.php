<?php
/**
*
*/
class User extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = array
		(
			'error' => '',
			'username' => $this->session->userdata('username')
		);

		$this->load->view('airbooking/home');
	}

	

}
