<?php
	class Config
{
	private function __construct(){}		

	public static function get($file=null)
		{
			if($file){
				return require 'config/'.$file.'.php';
			}
			return false;
		}
}
?>