<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Loginmodel;
use App\Controllers\Login;

class Login extends BaseController
{

	public function __construct()
	{
		$this->Loginmodel = new Loginmodel();
	}
	//--------------------------------------------------------------------
	public function index()
	{
		$data = [
			'title' => 'Login'
		];
		echo view('login', $data);
	}
	//--------------------------------------------------------------------
	public function check_login()
	{
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');

		$check = $this->Loginmodel->login($username, $password);

		if (($check['username'] == $username) && ($check['password'] == $password)) {
			//jika username dan password benar
			session()->set('id_user', $check['id_user']);
			session()->set('username', $check['username']);
			session()->set('nama_user', $check['nama_user']);
			session()->set('level', $check['level']);
			session()->setFlashData('success', 'Login Berhasil');

			return redirect()->to(base_url('home'));
		} elseif (($check['username'] == $username) && ($check['password'] != $password)) {
			//jika password salah
			session()->setFlashData('warning', 'Password Salah');
			return redirect()->to(base_url('login'));
		} else {
			//account tidak terdaftar
			session()->setFlashData('danger', 'Maaf akun ini tidak terdaftar');
			return redirect()->to(base_url('login'));
		}
	}

	public function register()
	{
		$data = [
			'title' => 'Register'
		];
		echo view('register', $data);
	}

	public function daftar()
	{
		$data =
			[
				'nama_user' => $this->request->getpost('nama'),
				'username' => $this->request->getPost('username'),
				'password' => $this->request->getPost('password'),
				'level' => '2'
			];

		$password1 = $this->request->getPost('password1');

		$check = $this->Loginmodel->check_username($data['username']);

		if ($check['username'] == $data['username']) {

			session()->setFlashData('warning', 'Maaf username sudah digunakan');

			return redirect()->to(base_url('login/register'));
		} elseif ($data['password'] != $password1) {
			//jika password salah
			session()->setFlashData('warning', 'Password tidak sama');
			return redirect()->to(base_url('login/register'));
		}

		$this->Loginmodel->insert_user($data);

		session()->setFlashData('success', 'Berhasil menambahkan account');

		return redirect()->to(base_url('login'));
	}
	//--------------------------------------------------------------------
	public function logout()
	{
		session()->destroy();

		return redirect()->to(base_url('login'));
	}
	//--------------------------------------------------------------------
}
