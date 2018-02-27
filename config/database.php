<?php

return [
	'fetch' 	=> PDO::FETCH_OBJ,
	'driver' 	=> 'mysql',
	'mysql'		=> [
		'host'		=>  '127.0.0.1',
		'user' 		=>	'root',
		'pass'		=>  '',
		'db_name'	=>	'algebra_auth',
		'charset'	=>	'utf8'
	],
	'sqlite'	=> [],
	'pgsql'		=> []
	
	];