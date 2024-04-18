<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generate extends CI_Controller {

	public function __construct() {

		parent::__construct();
		
		$this->load->model('m_generate');
		$this->load->model('m_sertifikat');
		$this->load->model('m_event');

		if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Login Terlebih Dahulu!</div>');
            redirect('Auth');
        }
		
	}

	public function index()
	{
		$profil['profil'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

		$title['title'] = 'Generate Certificates - Certificate Online';

		$year['year'] = date('Y');

			$user_id = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

			
			$a = $user_id['user_id'];


			$generate = $this->db->query("SELECT * FROM certificate_assignments WHERE user_id=$a")->result();
			$certificate = $this->m_sertifikat->getDataCertificate();
		$event = $this->m_event->getDataEvent();
		$users = $this->db->query("SELECT * FROM users WHERE level='user'")->result();

		$data['generate'] = $generate;
		$data['certificate'] = $certificate;
		$data['event'] = $event;
		$data['users'] = $users;

		$this->load->view('partials/_header', $title);
		$this->load->view('partials/_sidebar', $profil);
		$this->load->view('partials/_navbar');
		$this->load->view('sertifikatuser/generate', $data);
		$this->load->view('partials/_footer', $year);
	}

	public function download($id)
    {
        $certificate = $this->m_sertifikat->getDataCertificateDetail($id);
        $event = $this->m_event->getDataEventDetail($id);
		
        $data['sertifikat'] = $certificate;
        $data['event'] = $event;

        $this->load->library('dompdf_gen');
        $this->load->view('sertifikatuser/download', $data);

        $paper_size = 'A4';
        $orientation = 'landscape';
        $html = $this->output->get_output();

        $this->dompdf->set_paper($paper_size, $orientation);
        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream('Certificate.pdf', array('Attachment' => 0));
    }
}