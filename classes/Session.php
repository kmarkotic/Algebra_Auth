<?php


class Session
{
	private function __construct(){}
	
	public static function all()
	{
		return $_SESSION;
	}
	
	public static function exists($key)
	{
		return (isset($_SESSION[$key])) ? true : false;
	}
	
	public static function put($key,$value)
	{
		return $_SESSION[$key] = $value;
	}

	public static function get($key)
	{
		return $_SESSION[$key];
	}	
	
	public static function delete($key)
	{
		unset($_SESSION[$key]);
	}	
}