<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class event extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_event');

        if (!$this->session->userdata('username')){
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Login Terlebih Dahulu!</div>');
			redirect('admin');
		} 
    }

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
        $event = $this->m_event->getDataEvent();

        $data['event'] = $event;

		$this->load->view('admin/partials/_header');
		$this->load->view('admin/partials/_sidebar');
		$this->load->view('admin/partials/_navbar');
		$this->load->view('admin/event/event', $data);
		$this->load->view('admin/partials/_footer');
	}

    public function e_edit($id)
	{
		$profil['profil'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

		$title['title'] = 'Edit Events - Certificate Online';

		$year['year'] = date('Y');

		$event = $this->m_event->getDataEventDetail($id);

		$data['event'] = $event;

		$this->load->view('admin/partials/_header', $title);
		$this->load->view('admin/partials/_sidebar', $profil);
		$this->load->view('admin/partials/_navbar');
		$this->load->view('admin/event/e_edit', $data);
		$this->load->view('admin/partials/_footer', $year);
	}

	public function fungsi_tambah()
    {
        $profil['profil'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $event_name = $this->input->post('event_name');
        $event_date = $this->input->post('event_date');
        $location = $this->input->post('location');
        $organizer = $this->input->post('organizer');

        $ArrInsert = array(
            'event_name' => $event_name,
            'event_date' => $event_date,
            'location' => $location,
            'organizer' => $organizer
        );

        $this->m_event->insertDataEvent($ArrInsert);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Event added successfully!</div>');
		redirect($_SERVER['HTTP_REFERER']);
    }

	public function fungsi_edit()
    {
        $profil['profil'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $id = $this->input->post('event_id');
        $event_name = $this->input->post('event_name');
        $event_date = $this->input->post('event_date');
        $location = $this->input->post('location');
        $organizer = $this->input->post('organizer');

        $ArrUpdate = array(
            'event_id' => $id,
            'event_name' => $event_name,
            'event_date' => $event_date,
            'location' => $location,
            'organizer' => $organizer
        );

        $this->m_event->updateDataEvent($id, $ArrUpdate);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Event edited successfully!</div>');
        redirect(base_url('admin/event'));
    }

	public function fungsi_hapus($id)
    {
        $profil['profil'] = $this->db->get_where('users', ['username' => $this->session->userdata('username')])->row_array();

        $this->m_event->hapusDataEvent($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Event deleted successfully!</div>');

        redirect($_SERVER['HTTP_REFERER']);
    }
}