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
		$host =$this->config[$driver]['host'];
		$user =$this->config[$driver]['user'];
		$pass =$this->config[$driver]['pass'];
		$db_name =$this->config[$driver]['db_name'];
		$dsn =$driver.':host='.$host.';dbname='.$db_name;
		
		try{
			$this->connection= new PDO($dsn,$user,$pass);	
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
				$this->error=false;
				
				if($this->query = $this->connection->prepare($sql)){
					$x= 1;
					if(!empty($params)){
						foreach($params as $param){
							$this->query->bindValue($x, $param);
							$x++;
						}
					}
					
					if($this->query->execute()){
						$this->results=$this->query->fetchAll($this->config['fetch']);
						$this->count =$this->query->rowCount();
					}else{
						$this->error=true;
					}
						
				}

					return $this;
		}
		
		
	private function action($action, $table, $where=array())
	{
		if(count($where) ===3)
		{
			$operators=array('=','<','>','<=','>=');
			
			$field = $where[0];
			$operator = $where[1];
			$value = $where[2];
			
		if(in_array($operator,$operators)) 
		{
				$sql ="{$action} FROM {$table} WHERE {$field} {$operator} ?";
				
				if(!$this->query($sql,array($value))->getError()){
					return $this;
				}
				
			}
			
		}else{
			$sql="{$action} FROM {$table}";
				if(!$this->query($sql)->getError()){
					return $this;
			}
			}
		return false;
	}
		

	public function get($fields, $table, $where = array())
	{
		return $this->action("SELECT {$fields}",$table,$where);
	}
	
	public function find($id,$table)
	{
		return $this->action("SELECT *", $table, array('id','=',$id));
	}
	
	public function delete($table, $where= array())
	{
		return $this->action("DELETE", $table, $where);
	}	
	
	public function insert($table, $fields)
	{
		$keys = implode(',', array_keys($fields));
		$fields_num= count($fields);
		$values ='';
		$x=1;
		
		foreach($fields as $field){
			$values .='?';
			if($x<$fields_num){
				$values .=',';	
			}
			$x++;
		}
		
		$sql ="INSERT INTO {$table} ({$keys}) VALUES({$values})";
		if(!$this->query($sql, $fields)->getError()) {
			return true;
		}
			return false;
	}	
		
		public function update($table,$id,$fields)
		{
			$fiels_num=count($fields);
			$set='';
			$x=1;
			
			foreach($fields as $key=>$value){
				$set .="{$key} =?";
				if($x<fields_num){
				$set .=',';
			}
			$x++;
		}
		$sql="UPDATE {$table} SET {$set} where id={$id}";
	
		if(!$this->query($sql, $fields)->getError()) {
			return true;
		}
			return false;
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