<?php
$conn=new MySQLi("localhost","root","","legal_rasta");

$count_new = 0;

	if(count($_GET) == 5){

		$conn=new MySQLi("localhost","root","","legal_rasta");
		 
		 $id = $_GET['id'];
		 $name = $_GET['name'];
		 $email = $_GET['email'];
		 $dob = $_GET['dob'];
		 $password = $_GET['password'];
	 
		$query_to_check_user = $conn->query("SELECT * FROM users WHERE email='$email'");
		$checked_user=$query_to_check_user->num_rows; 
		
		if($checked_user == 0){ 
			$updatingvalues = "UPDATE users SET id='$id', email='$email', name='$name', dob='$dob', password='$password' WHERE id='$id'";
			$r= $conn->query($updatingvalues);

			if($r){
				echo "updated";
			}	
		}else{
			echo "not_updated";
		}
	
	}

?>