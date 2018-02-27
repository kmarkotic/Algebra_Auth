<?php

	class Helper
	{
		private function __construct(){}
		
		public static function getHeader($title,$file=null)
		{
			if($file){
				return require_once 'includes/layouts/'.$file.'.php';
			}
			return false;
		}
		
		public static function getFooter($file=null)
		{
			if($file){
				return require_once 'includes/layouts/'.$file.'.php';
			}
			return false;
		}
	}
?>