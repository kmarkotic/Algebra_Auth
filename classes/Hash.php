<?php

class Hash
{
	private function __construct()
	{
	}
	
	public static function salt($lenght)
	{
		return random_bytes($lenght);
	}
	
	public static function make($string,$salt)
	{
		return hash('sha256',$salt.$string);
	}
	
	}
