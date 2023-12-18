<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {

        $this->form_validation->set_rules('username', 'Username', 'trim|required', ['required' => 'Username silahakan disi!']);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', ['required' => 'Password silahakan disi!']);
        if ($this->form_validation->run() == false) {
            chek_udah_login();
            $this->load->view('admin/login');
        } else {
            $this->_cek_login();
        }
    }

    public function _cek_login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $data = [
                    'id_user' => $user['id_user'],
                    'username' => $user['username'],
                    'nama_lengkap' => $user['nama_lengkap'],
                    'level' => $user['level']
                ];

                $this->session->set_userdata($data);
                redirect('dashboard');
                // if ($user['level'] == 'Admin' || $user['level'] == 'Pimpinan') {
                //     redirect('dashboard');
                // } else {
                //     redirect('user');
                // }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password salah</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Username Belum Terdaftar</div>');
            redirect('auth');
        }
    }
    public function logout()
    {
        $data = array('id_user', 'username', 'nama_lengkap');
        $this->session->unset_userdata($data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> logout Berhasil</div>');
        redirect('auth');
    }
}
