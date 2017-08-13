<?php

namespace App\Controllers;

use App\Core\Controller;

class ErrorController extends Controller
{
	public function index()
	{
		$this->view("error/index");
	}
}
