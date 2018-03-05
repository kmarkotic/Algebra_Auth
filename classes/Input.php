<?php

class Input
{
	private function __construct(){}
	
	public static function get ($item,$method='post')
	{
		switch ($method){
			case 'post':
				return $_POST[$item];
			break;
			case 'get';
				return $_GET[$item];
			break;
			default:
				return false;
			break;
		}
	}
	
	public static function exists ($method='post')
	{
		switch ($method){
			case 'post':
				return (! empty($_POST)) ? true: false;
			break;
			case 'get';
				return (! empty($GET)) ? true: false;
			break;
			default:
				return false;
			break;
		}
	}
	
}