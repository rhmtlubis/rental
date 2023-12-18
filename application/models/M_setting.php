<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_setting extends CI_Model
{

	public function live_chanel()
	{
		$hasil = $this->db->query("SELECT * FROM chanel  ");
		return $hasil;
	}

	public function live_harga()
	{
		$hasil = $this->db->query("SELECT * FROM harga  ");
		return $hasil;
	}

	public function live_user()
	{
		$hasil = $this->db->query("SELECT * FROM user  ");
		return $hasil;
	}

	public function live_member()
	{
		$hasil = $this->db->query("SELECT * FROM member where status='B' order by id_member ASC limit 1 ");
		return $hasil->row();
	}

	public function live_pendapatan($tgl1, $tgl2)
	{
		$this->db->select('*');
		$this->db->from('member');
		$this->db->where("date(tgl_stop) >='$tgl1'");
		$this->db->where("date(tgl_stop) <='$tgl2'");
		$this->db->where("status ='N'");
		$query = $this->db->get();
		return $query;
	}

	public function live_pertanggal($tgl1, $tgl2)
	{
		$this->db->select('tgl, SUM(dibayar) as dby, SUM(total) as tl');
		$this->db->from('member');
		$this->db->where("tgl >= '$tgl1'");
		$this->db->where("tgl <= '$tgl2'");
		$this->db->where("status ='N'");
		$this->db->group_by("tgl");
		$query = $this->db->get();
		return $query;
	}

	public function live_penjualan($tgl1, $tgl2)
	{
		$this->db->select('tgl_jual, SUM(total) as thl');
		$this->db->from('penjualan');
		$this->db->where("tgl_jual >= '$tgl1'");
		$this->db->where("tgl_jual <= '$tgl2'");
		$this->db->group_by("tgl_jual");
		$query = $this->db->get();
		return $query;
	}

	public function live_pengeluaran($tgl1, $tgl2)
	{
		$this->db->select('tgl_keluar, SUM(total) as tkl');
		$this->db->from('pengeluaran');
		$this->db->where("tgl_keluar >= '$tgl1'");
		$this->db->where("tgl_keluar <= '$tgl2'");
		$this->db->group_by("tgl_keluar");
		$query = $this->db->get();
		return $query;
	}
}
