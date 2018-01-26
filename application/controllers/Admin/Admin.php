<?php
/**
*
*/
class Admin extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('username')=="")
		{
			redirect('login');
		}
		elseif($this->session->userdata('level') == 'member')
		{
			redirect('member/member');
		}
		$this->load->model('my_model');
	}

	public function index()
	{
		$data = array
		(
			'error' => '',
			'username' => $this->session->userdata('username')
		);

		$this->load->view('admin/adminpage');
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('level');
		session_destroy();
		redirect('home');
	}

	public function tambah()
	{
		$this->load->view('admin/tambah');
	}

}
