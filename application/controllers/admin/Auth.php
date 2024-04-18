 	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/userguide3/general/urls.html
	 */
	public function index()
	{
		$this->load->view('admin/partials/_header');
		$this->load->view('admin/login_admin');
		// $this->load->view('partials/_footer');

	}


	public function login()
	{
		$username = $this->input->post('username', TRUE);
		$password = $this->input->post('password', TRUE);

		$level_check = $this->db->get_where('users', ['username' => $username])->row_array();
		$user = $this->db->get_where('users', ['username' => $username]);

		if ($user->num_rows() > 0) {

			$hasil = $user->row();

			if ($level_check['level'] == 'admin'){

				if (password_verify($password, $hasil->password)) {

					$this->session->set_userdata('id', $hasil->id);
					$this->session->set_userdata('email', TRUE);
					$this->session->set_userdata('username', $hasil->username);
					$this->session->set_userdata('user_id', $hasil->user_id);
					redirect('admin/dashboard_admin');
					
				} else {

					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password!</div>');
					redirect('admin');
				}

			} else {	
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">User only!</div>');
				redirect('admin');
			}

		} else {

			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username is not registered!</div>');
			redirect('admin');
		}
	}

	public function register()
	{
		$this->form_validation->set_rules('full_name', 'full_name', 'required|trim');
		$this->form_validation->set_rules('email', 'email', 'required|trim|valid_email|is_unique[users.email]', [
			'is_unique' => 'this email has already registered!'
		]);

		$this->form_validation->set_rules(
			'password1',
			'password',
			'required|trim|min_length[3]|matches[password2]',
			[
				'matches' => 'password dont match!',
				'min_length' => 'password to short!'
			]
		);

		$this->form_validation->set_rules('password2', 'password', 'required|trim|matches[password1]');

		if ($this->form_validation->run() == false) {
			$title['title'] = 'Sertifikat Online';
			$this->load->view('admin/partials/_header');
		    $this->load->view('register');
		} else {
			// $role_id = $this->input->post('role_id');

			$data = [
				'username' => htmlspecialchars($this->input->post('username', true)),
				'full_name' => htmlspecialchars($this->input->post('full_name', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'level' => 'user',
				// 'created_at' => date('Y-m-d H:i:s')
			];

			$this->db->insert('users', $data);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">congratulation! your account has been created. please login!</div>');
			redirect('Auth');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Congratulation! your account has been logout.</div>');
		redirect('admin');
	}
}