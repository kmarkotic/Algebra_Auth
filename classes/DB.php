<?php

class DB
{
	private static $instance = null;
	private $config;
	private $connection;
	private $query;
	private $error=false;
	private $results;
	private $count=0;
	
	
	//Constructor
	private function __construct()
	{
		$this->config = Config::get('database');
		$driver =$this->config['driver'];
		$host =$this-> config[$driver]['host'];
		$user =$this-> config[$driver]['user'];
		$pass =$this-> config[$driver]['pass'];
		$db_name =$this-> config[$driver]['db_name'];
		$dsn =$driver.':host='.$host.';db_name='.$db_name;
		
		try{
			$this-> connection= new PDO($dsn,$user,$pass);	
		} catch(PDOException $e){
			die($e->getMessage());
		}
	}
	//Instance
		public static function getInstance()
		{
			if(!self::$instance){
				self::$instance = new self();
			}
			return self::$instance;
		}
		
		// Create database query
		public function query($sql,$params=array())
		{
			
		}
		
		
		
//Geters

	public function getConnection()
		{
		return $this->connection;
		}
	
	public function getError()
		{
		return $this->error;
		}
	
	public function getResults()
		{
		return $this->results;
		}
	
	public function getCount()
		{
		return $this->count;
		}
}