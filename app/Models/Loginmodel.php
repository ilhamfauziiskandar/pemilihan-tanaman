<?php namespace App\Models;
use CodeIgniter\Model;

class Loginmodel extends Model
{
	public function login($username, $password)
	{
		return $this->db->table('user')
		->where(array('username' => $username))
		->get()->getRowArray();
	}
	
	public function check_username($username)
	{
		return $this->db->table('user')
		->where(array('username' => $username))
		->get()->getRowArray();
	}
	
	public function insert_user($data)
	{
	return $this->db->table('user')->insert($data);
	}
}