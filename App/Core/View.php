<?php

namespace App\Core;

use App\Core\Template;

class View
{
	public static function render($view, $data = [])
	{
		extract($data);
		require_once(__DIR__ . "/../views/" . $view . ".php");
	}

	public static function renderTemplate($view, $data = [])
	{

		static $template = null;

		if ($template === null) $template = Template::getInstance();

		echo $template->render($view . '.html', $data);
	}
}
