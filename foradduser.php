<?php
$conn=new MySQLi("localhost","root","","legal_rasta");

$count_new = 0;

	if(count($_GET) == 4){
		 $conn=new MySQLi("localhost","root","","legal_rasta");
		 

		 
		 $name = $_GET['name'];
		 $email = $_GET['email'];
		 $dob = $_GET['dob'];
		 $password = $_GET['password'];
		 
		$query_to_check_user = $conn->query("SELECT * FROM users WHERE email='$email'");
		$checked_user=$query_to_check_user->num_rows;




		 	if($checked_user == 0){
				$addingvalues = "INSERT INTO users VALUES ('','$email','$name','$dob','$password')"; 
				$r= $conn->query($addingvalues);

				if($r){
					echo "added";
				}
			}else{
					echo "already_exist";
			}	
	}

?>