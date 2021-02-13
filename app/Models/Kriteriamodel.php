<?php namespace App\Models;
use CodeIgniter\Model;

class Kriteriamodel extends Model
{
  protected $table = 'iklim';

  public function get_iklim()
  {
    return $this->db->query('SELECT * FROM `iklim` ORDER BY `date` DESC LIMIT 6')->getResultArray();
  }

  public function iklim($tgl)
  {
    return $this->db->table('iklim')
    ->where(array('date' => $tgl))
    ->get()->getRowArray();
  }

  public function get_tanaman()
  {
    return $this->db->table('tanaman')->get()->getResultArray();
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

  public function insert_iklim($data)
  {
    return $this->db->table('iklim')->insert($data);
  }

  public function delete_iklim($id_iklim)
  {
    return $this->db->table('iklim')->delete(array('id_iklim' => $id_iklim));
  }

  public function delete_tanaman($id_tnm)
  {
    return $this->db->table('tanaman')->delete(array('id_tnm' => $id_tnm));
  }

  public function edit_iklim($data, $id_iklim)
  {
    return $this->db->table('iklim')->update($data, array('id_iklim' => $id_iklim));  
  }

  public function edit_tanaman($data, $id_tnm)
  {
    return $this->db->table('tanaman')->update($data, array('id_tnm' => $id_tnm));  
  }

}