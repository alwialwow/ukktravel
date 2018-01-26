<?php
/**
*
*/
class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('my_model');
		$this->load->library('session');
		if($this->session->userdata('username'))
		{
			if($this->session->userdata('level')=='admin')
			{
				redirect('admin/admin');
			}
			elseif ($this->session->userdata('level')=='user')
			{
				redirect('user/user');
			}
			else
			{
				redirect('error/index');
			}
		}
	}

	public function index()
	{
		$this->load->view('airbooking/home');
	}

	public function login()
	{
		$this->load->view('v_login');

	}

	public function signup()
	{
		$this->load->view('v_signup');
	}

	public function SignUprProcess()
	{
		$nama = $this->input->post('fullname');
        $username = $this->input->post('username');
        $email = $this->input->post('email');
		$password = md5($this->input->post('password'));

		$data = array
		(
			'fullname' => $nama,
			'username' => $username,
			'email' => $email,
			'password' => $password,
			'level' => 3
		);

		$this->my_model->input_data($data,'tbuser');

		?>
			<script type="text/javascript">alert("Berhasil mendaftar!")</script>
		<?php
	}

	public function loginProcess()
	{
		$uname = $this->input->post('username');
		$pass = md5($this->input->post('password'));
		$result = $this->my_model->cek_user($uname, $pass);

		if ($result->num_rows() > 0)
		{
			foreach ($result->result() as $row)
			{
				$uname = $row->username;
				$pass = $row->password;
				$level = $row->level;
			}

			$newdata = array
			(
		        'username' => $uname,
		        'password' => $pass,
		        'level' => $level,
		        'logged_in' => TRUE
			);

			$this->session->set_userdata($newdata);
			if($this->session->userdata('level')=='admin')
			{
				redirect('admin/admin');
			}
			elseif ($this->session->userdata('level')=='user')
			{
				redirect('user/user');
			}
		}
		else
		{
			echo "Username & Password salah"; ?><br><br><br>
			<?php echo "Username hint: njajal";?> <br>
			<?php echo "Password hint: njajal";
		}

	}
}
