<?php

$conn=new MySQLi("localhost","root","","legal_rasta");

$count_new = 0;


	if(count($_GET) == 1){
		
		$conn=new MySQLi("localhost","root","","legal_rasta");
		 
		 $id = $_GET['id'];
	 			
			$deletingvalues = "DELETE FROM users WHERE id='$id'"; 
			$r = $conn->query($deletingvalues);
			
			if($r){
				echo "deleted";
			}else{
				echo "not_deleted";
			}
	}


?>