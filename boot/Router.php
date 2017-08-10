<?php

include 'boot/Psr4Autoload.php';


class Router
{
	public static $autoload;
	public static function init()
	{
		$config = include 'config/namespace.php';
		self::$autoload = new Psr4Autoload($config);
		session_start();
		
	}
	public static function run()
	{
		//简单的路由
		$_GET['m'] = empty($_GET['m'])?'index':$_GET['m'];
		$_GET['c'] = empty($_GET['c'])?'index':$_GET['c'];
		$_GET['a'] = empty($_GET['a'])?'index':$_GET['a'];

		//拼接类
		$c = $_GET['m'].'\\controller'.'\\'.ucfirst($_GET['c']).'Controller';
		// var_dump($c);
		call_user_func([new $c(),$_GET['a']]);

	}


}