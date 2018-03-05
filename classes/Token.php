<?php

class Token 
{
	private static $token_name='CSRF';

	public static function generate()
	{
		return Session::put(self::$token_name,md5(uniqid()));
	}
	
	public static function check($token)
	{
		if(Session::exists(self::$token_name) & $token === Session::get(self::$token_name)){
			return true;
		}
		return false;
	}
}