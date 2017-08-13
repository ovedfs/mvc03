<?php

namespace App\Core;

class App
{
	protected $url;
	protected $controller = "HomeController";
	protected $method = "index";
	protected $params = [];

	public function __construct()
	{
		$this->url = $this->parseURL();

		if(isset($this->url[0])) $this->setController();

		include_once("app/controllers/" . $this->controller .  ".php");

		$class = "App\\Controllers\\" . $this->controller;
		$this->controller = new $class;

		if(isset($this->url[1])) $this->setMethod();

		if($this->url != false && count($this->url)) $this->setParams();

		call_user_func_array(array($this->controller, $this->method), $this->params);
	}

	private function setController()
	{
		$controllerClass = ucfirst($this->url[0]) .  "Controller";

		if(! file_exists("app/controllers/" . $controllerClass .  ".php")) $controllerClass = "ErrorController";

		$this->controller = $controllerClass;

		unset($this->url[0]);
	}

	private function setMethod()
	{
		if(method_exists($this->controller, $this->url[1])) $this->method = $this->url[1];

		unset($this->url[1]);
	}

	private function setParams()
	{
		$this->params = array_values($this->url);
	}

	private function parseURL()
	{
		if(isset($_SERVER['QUERY_STRING']) && $_SERVER['QUERY_STRING'] != "" && $_SERVER['QUERY_STRING'] != "/"){

			$url = $_SERVER['QUERY_STRING'];

			$url = trim($url, '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);

			return $url;
		}

		return false;
	}
}
