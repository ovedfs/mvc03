<?php
namespace App\Core;

abstract class Controller
{
	public function model($model)
	{
		$class = "App\\Models\\" . $model;
		return new $class;
	}

	public function view($view, $data = [])
	{
		extract($data);
		require_once(__DIR__ . "/../Views/" . $view . ".php");
	}
}
