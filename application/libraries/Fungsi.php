<?php
class fungsi
{

    protected $ci;

    function __construct()
    {
        $this->ci = &get_instance();
    }

    function user_login()
    {
        $this->ci->load->model('m_user');
        $id_user = $this->ci->session->userdata('id_user');
        $data_user = $this->ci->m_user->get($id_user)->row();
        return $data_user;
    }
}
