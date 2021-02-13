<?php namespace App\Models;
use CodeIgniter\Model;

class Rankingmodel extends Model
{

	public function get_nilai_parameter()
	{
		$query = $this->db->query("SELECT * FROM nilai_parameter ORDER BY id_nilai DESC")->getResultArray();
		return $query;
	}

	public function get_nilai_parameter1($id_user)
	{
		$query = $this->db->query("SELECT * FROM nilai_parameter where id_user = $id_user ORDER BY id_nilai DESC")->getResultArray();
		return $query;
	}

	public function get_parameter($id_nilai)
	{
		return $this->db->table('nilai_parameter')->where('id_nilai',$id_nilai)->get()->getRowArray();
	}

	public function get_iklim()
	{
		return $this->db->table('iklim')->get()->getResultArray();

	}

	public function get_tanaman()
	{
		return $this->db->query("SELECT tanaman.nm_tnm, tanaman.suhu_tnm, tanaman.kelembaban_tnm, tanaman.curah_tnm, tanaman.ketinggian_tnm, preferensi.nilai_preferensi
			FROM ((produksi INNER JOIN tanaman ON produksi.id_tnm = tanaman.id_tnm) 
			INNER JOIN preferensi ON produksi.id_preferensi = preferensi.id_preferensi);")->getResultArray();

	}

	public function avg_iklim()
	{
		// $db = \Config\Database::connect();
		// $query = $db->query("SELECT AVG(`tekanan_udara`) AS tekanan_udara, AVG(`kecepatan_angin`) AS kecepatan_angin, AVG(`kelembaban_udara`) AS kelembaban_udara FROM iklim");
		// $row   = $query->getResultArray();
		// return $row;
		return $this->db->query("SELECT AVG(`tekanan_udara`) AS tekanan_udara, AVG(`kecepatan_angin`) AS kecepatan_angin, AVG(`kelembaban_udara`) AS kelembaban_udara FROM iklim")->getResultArray();
	}


	public function avg_tekanan(){
		return $this->db->query('SELECT AVG(`tekanan_udara`) AS tekanan_udara FROM iklim')->getRow();
	}

	public function avg_kecepatan(){
		return $this->db->query('SELECT AVG(`kecepatan_angin`) AS kecepatan_angin FROM iklim')->getRow();
	}

	public function avg_kelembaban(){
		return $this->db->query('SELECT AVG(`kelembaban_udara`) AS kelembaban_udara FROM iklim')->getRow();
	}

	public function insert_nilai_parameter($data)
	{
		return $this->db->table('nilai_parameter')->insert($data);
	}

	public function delete_nilai_parameter($id_nilai)
	{
		return $this->db->table('nilai_parameter')->delete(array('id_nilai' => $id_nilai));
	}



}