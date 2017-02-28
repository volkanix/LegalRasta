<?php

$conn=new MySQLi("localhost","root","","legal_rasta");

$count_new = 0;

if(count($_GET) == 1){


 	$conn=new MySQLi("localhost","root","","legal_rasta");
	 
	 $id = $_GET['id'];
	 			
			$editingvalues = "SELECT * FROM users WHERE id='$id'"; 
			$edit_value = $conn->query($editingvalues);
			$extract = $edit_value->fetch_assoc();

			$id = $extract['id'];
			$name = $extract['name'];
			$email = $extract['email'];
			$dob = $extract['dob'];
			$password = $extract['password'];

?>		

				<div>
					<br/>
					<div class="error"><h2>Password don't match</h2></div><br/>
					<div class="user_exists"><h2>User Already Exists</h2></div><br/>
					<input type="text" id="name" name="name" placeholder="Name" value="<?php echo $name ?>" required maxlength="25" /><br/><br/>
					<input type="text" id="email" name="email" placeholder="Email" value="<?php echo $email ?>" required /><br/><br/>
					<input type="text" id="dob" name="dob" placeholder="dd/mm/yy" value="<?php echo $dob ?>"  onKeyPress='return numbersonly(this, event)' maxlength="6" required/><br/><br/>
					<input type="password" id="password" name="password" placeholder="Password" value="<?php echo $password ?>" required maxlength="10" /><br/><br/>
					<input type="password" id="cnf_password" name="cnf_password" placeholder="Confirm Password" required maxlength="10" /><br/>
					</div>
					<?php
					echo "<button style='margin-top:20px;margin-bottom:20px' onclick='update_user($id)'>Update</button>";
					?>	
				</div>
			
<?php 
}
?>