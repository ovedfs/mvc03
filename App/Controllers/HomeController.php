<?php

namespace App\Controllers;

use App\Core\Controller;

use App\Core\View;

//use Carbon\Carbon;

class HomeController extends Controller
{
	protected $postModel;

	public function __construct()
	{
		$this->postModel = $this->model("Post");
	}

	public function index()
	{
		$data["name"] = "Oved";
		$data["last_name"] = "Fiso";
		$data["posts"] = $this->postModel->findAll();

		View::renderTemplate("home/index", $data);
	}

	public function prueba()
	{
		$this->view("home/prueba");
	}

	public function saludar($nombre = "Anonimo")
	{
		$data["nombre"] = $nombre;
		$this->view("home/saludar", $data);
	}
}
