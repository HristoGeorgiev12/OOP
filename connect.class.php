<?php 
	
class Connect{
	protected $connect;
	protected $database;
	protected $table;
	
	public function __construct($table,$database){
		try{
			$this->connect =  new PDO('mysql:host=localhost;dbname='.$database.';charset=utf8', 'root', '');
			$this->table = $table;
		}
		
		catch(PDOException $e){
			echo $e->getMessage();
			
		}
	}
	
}
