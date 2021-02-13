<?php namespace App\Models;
use CodeIgniter\Model;

class Alternatifmodel extends Model
{
	
	public function get_alternatif(){

		return $this->db->query("SELECT tanaman.nm_tnm, produksi.id_produksi, produksi.hasil, preferensi.peringkat, preferensi.nilai_preferensi FROM ((produksi INNER JOIN tanaman ON produksi.id_tnm = tanaman.id_tnm) INNER JOIN preferensi ON produksi.id_preferensi = preferensi.id_preferensi)")->getResultArray();
	}
	
	public function get_preferensi()
	{
		
		return $this->db->table('preferensi')->get()->getResultArray();

	}

	public function get_produksi()
	{
		
		return $this->db->query("SELECT id_produksi, id_preferensi FROM produksi order by  hasil desc")->getResultArray();

	}

	public function edit_preferensi($isi, $id_produksi1)
	{

		return $this->db->table('produksi')->update($isi, array('id_produksi' => $id_produksi1));
	
	}

	public function edit_produksi($data, $id_produksi)
	{

		return $this->db->table('produksi')->update($data, array('id_produksi' => $id_produksi));
	
	}

	public function delete_produksi($id_produksi)
	{

		return $this->db->table('produksi')->delete(array('id_produksi' => $id_produksi));
	
	}
}