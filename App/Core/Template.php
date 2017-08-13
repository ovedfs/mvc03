<?php

namespace App\Core;

use Twig_Loader_Filesystem;

use Twig_Environment;

use Twig_SimpleFunction;

use Carbon\Carbon;

class Template
{
	public static function getInstance()
	{
		$loader = new Twig_Loader_Filesystem('App/Views');
			
		$twig = new Twig_Environment($loader/*, array('cache' => 'App/Cache',)*/);

		$twig->addFunction(new Twig_SimpleFunction('asset', function ($asset) {
			return sprintf('public/%s', ltrim($asset, '/'));
		}));

		$twig->addFunction(new Twig_SimpleFunction('dateForHumans', function ($date) {

			Carbon::setLocale('es');

			return sprintf('%s', Carbon::createFromFormat('Y-m-d H:i:s', $date)->diffForHumans());
		}));

		return $twig;
	}
}
