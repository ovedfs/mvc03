<?php

namespace App\Controllers;

use App\Core\Controller;

class UserController extends Controller
{
	protected $UserModel;

	public function __construct()
	{
		$this->UserModel = $this->model("User");
	}

	public function index()
	{
		$data["users"] = $this->UserModel->findAll();

		$this->view("user/index", $data);
	}

	public function profile($id, $modo = 'lectura')
	{
		$data["id"] = (int)$id;
		$data["modo"] = $modo;

		$user = $this->UserModel->find($id);

		print_r($user); exit();

		$this->view("user/profile", $data);
	}
}
