<?php
	include_once('insert.class.php');
	
	//POST methods data;
	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$comment = $_POST['comment'];
		$email =  $_POST['email'];
		
		//Creating object ;
		$crud = new CRUD('comments', 'pdo');
		
		
		//Array to insert;
		$toInsertArray= array("username"=>$username, "comment"=>$comment, "email"=>$email );
		
		//Validate array;
		$inputArray = $crud->columnNames($toInsertArray);
		
		//Insert method;
		$crud->insertData($inputArray);
		//$inputArray  = $crud->insertData($toInsertArray);
		//The last record ID;
		echo "Last recorded ID: " .$inputArray["id"];
		
		//Select comments from DB;
		$selectedComments = $crud->selectData();
		
		
	}
?>

<html>
	<head>
		<title> OOP </title>
	</head>
	<body>
		<form action="" method="post">
			Username</br><input type="text" name="username"></br>
			Email: </br><input type="email" name="email"></br>
			Leave a comment</br><textarea name="comment" cols=46 rows=10 ></textarea></br>
			<input type="submit" name="submit" value="Submit" >
		</form>
		<hr>
		<h2>Comments</h2><br>
		<?php 
			foreach($selectedComments as $value){
				echo "<h4>{$value['username']}</h4>" . " <br> " .$value["comment"] . "<hr>";
			}
		?>
	</body>
</html>