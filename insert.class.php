<?php
	include_once('connect.class.php');
	
	class CRUD extends Connect{
		
		public function columnNames($toInsertArray){
			////Get the Column names from DB;
			$col = $this->connect->prepare('SHOW FIELDS FROM '.$this->table );
			$col->execute();
			$colNames = $col->fetchAll();
			
			//Create new Array which matches the DB column names & the input array keys;
			foreach($colNames as $colKeys=>$colValues){
				foreach($toInsertArray as $toInsertKeys=>$toInsertValues){
					if($colValues["Field"] == $toInsertKeys){
						$inputArray[$colValues["Field"]]=$toInsertValues;
					}
				}
			}
			
			return $inputArray;
		}
		
		public function insertData(&$inputArray){
			//Implode the KEYS of the main array;
			$arrayKeys = implode(",",array_keys($inputArray));
			
			
			//Implode the VALUES of the main array;
			$readyValueArray=array();
			foreach($inputArray as $keys=>$values){
				$readyValueArray[]= ":".$keys;
			}
			$arrayValues = implode(",",$readyValueArray);
			
			$result = $this->connect->prepare("INSERT INTO "
												.$this->table." (".$arrayKeys.") 
												values (".$arrayValues.")");
												
			$result->execute($inputArray);
			
			$inputArray["id"] = $this->connect->lastInsertId();
		}
		
		public function selectData(){
			
			$result=$this->connect->prepare("SELECT * FROM " .$this->table);
			$result->execute();
			
			$selected = $result->fetchAll();
			return $selected;
		}
	}
	