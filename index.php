<?php
$conn = new MySQLi("localhost","root","","legal_rasta");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Project | Legal Rasta</title>

<link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
<center><h1><< LEGAL RASTA PHP AJAX PROJECT >></h1><hr/></center>


<div class="left_side">
	<?php 
			$select = "SELECT * FROM users";
			$selected = $conn->query($select);
			$checked = $selected->num_rows;

			if($checked == 0){
				echo "<br/><h1>NO USER FOUND </h1>";
			}else{
	?>



			<h1>USER'S DATA</h1>
		<center>
			<table id="table_for_user" class="user_table" border="1">
				<tr>
					<td>
						<b>ID.NO.</b>
					</td>
					<td>
						<b>NAME</b>
					</td>
					<td>
						<b>EMAIL</b>
					</td>
					<td>
						<b>D.O.B</b>
					</td>
					<td>
						<b>ACTIONS</b>
					</td>
				</tr>
		<?php
				$select_value = "SELECT * FROM users";
				$selected = $conn->query($select_value);

				while ($row = $selected->fetch_assoc())
				{	
					$id = $row['id'];
					$email = $row['email'];
					$name = $row['name'];
					$dob = $row['dob'];
					$password = $row['password'];
		?>		
					<tr>
						<td>
							<?php echo $id.'.' ?>
						</td>
						<td>
							<?php echo $name ?>
						</td>
						<td>
							<?php echo $email ?>
						</td>
						<td>
							<?php echo $dob ?>
						</td>
						<td>
							<?php echo "<button onclick='edit_user($id),show_form()'>EDIT</button>" ?>&nbsp <?php echo "<button onclick='delete_user($id)'>DELETE</button>"; ?>
						</td>
					</tr>		
		<?php 	
				} 
		}		
		?>
			</table>
		
		</center>	
</div>

<div class="right_side">

			<button id="add" class="primary" onclick="show_form()">Add New User</button>
		<center>
			<div id="form_area" class="form_area">
				<div>
					<br/>
					<div class="error"><h2>Password don't match</h2></div><br/>
					<div class="user_exists"><h2>User Already Exists</h2></div><br/>
					<input type="text" id="name" name="name" placeholder="Name" required maxlength="25" /><br/><br/>
					<input type="text" id="email" name="email" placeholder="Email" required/><br/><br/>
					<input type="text" id="dob" name="dob" placeholder="dd/mm/yy" required onKeyPress='return numbersonly(this, event)' maxlength="6"/><br/><br/>
					<input type="password" id="password" name="password" placeholder="Password" required maxlength="10" /><br/><br/>
					<input type="password" id="cnf_password" name="cnf_password" placeholder="Confirm Password" required maxlength="10" /><br/>
					<button style="margin-top:20px;margin-bottom:20px" onclick="add_user()">Submit</button>	
				</div>
			</div>
		</center>		

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


<script type="text/javascript">
  
	function show_form(){
		$('.form_area').css('display','block');
	}


	function numbersonly(myfield, e, dec)
	{
	var key;
	var keychar;

	if (window.event)
	   key = window.event.keyCode;
	else if (e)
	   key = e.which;
	else
	   return true;
	keychar = String.fromCharCode(key);

	// control keys
	if ((key==null) || (key==0) || (key==8) || 
	    (key==9) || (key==13) || (key==27) )
	   return true;

	// numbers
	else if ((("0123456789").indexOf(keychar) > -1))
	   return true;

	// decimal point jump
	else if (dec && (keychar == "."))
	   {
	   myfield.form.elements[dec].focus();
	   return false;
	   }
	else
	   return false;
	}


  	function add_user(){


 		  var name = document.getElementById("name").value; 
		  var email = document.getElementById("email").value;
		  var dob = document.getElementById("dob").value;
		  var password = document.getElementById("password").value;
		  var cnf_password = document.getElementById("cnf_password").value;
	

			if((name=='')||(email=='')||(dob=='')||(password=='')||(cnf_password==''))
			{   
			      if(name==''){
			      $('#name').focus();
			      return;
			      }
			      else if(email==''){
			      $('#email').focus(); 
			      return;
			      }
			      else if(dob==''){
			      $('#dob').focus(); 
			      return;
			      }
			      else if(password==''){
			      $('#password').focus(); 
			      return;
			      }
			      else if(cnf_password==''){
			      $('#cnf_password').focus(); 
			      return;
			      }
			}else if(password!=cnf_password){
				 $('.user_exists').css('display','none');
			     $('.error').css('display','block'); 
			     return;
			} 

			var email = document.getElementById('email');
		    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			   if (!filter.test(email.value)) {
				    $('#email').focus();
				    return;
			   }

		  var name = document.getElementById("name").value; 
		  var email = document.getElementById("email").value;
		  var dob = document.getElementById("dob").value;
		  var password = document.getElementById("password").value;
		  var cnf_password = document.getElementById("cnf_password").value;




		var xmlhttp;
	    if(window.XMLHttpRequest)
	    { //code for IE7+, firefox, chrome, opera,safari
	      xmlhttp = new XMLHttpRequest();
	    }else{
	      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	    }
	      var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function()
	    {
		    if(xmlhttp.readyState==4 && xmlhttp.status==200){
		      var check = xmlhttp.responseText;
		        if (check=="already_exist"){
		        	$('.error').css('display','none');
		        	$('.user_exists').css('display','block');
		        	 document.getElementById("dob").value = '';
					 document.getElementById("password").value = '';
					 document.getElementById("cnf_password").value = '';
		        }else if(check == "added") {
		        	window.location.reload();	 
		        }
		    }
	    }
		  xmlhttp.open('GET','foradduser.php?name='+name+'&email='+email+'&dob='+dob+'&password='+password,true);
		  xmlhttp.send();     
	}
	


	
	function delete_user(id){
			
		var xmlhttp;
	    if(window.XMLHttpRequest)
	    { //code for IE7+, firefox, chrome, opera,safari
	      xmlhttp = new XMLHttpRequest();
	    }else{
	      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	    }
	      var xmlhttp = new XMLHttpRequest();
	    xmlhttp.onreadystatechange = function()
	    {
		    if(xmlhttp.readyState ==4 && xmlhttp.status==200){
		      var check = xmlhttp.responseText;
		     if (check == "deleted"){
		     	window.location.reload();
		     }
		    }
	    }
		  xmlhttp.open('GET','fordeleteuser.php?id='+id,true);
		  xmlhttp.send();

	}


	


	function edit_user(id){
		var xmlhttp;
	    
	    if(window.XMLHttpRequest)
	    { //code for IE7+, firefox, chrome, opera,safari
	      xmlhttp = new XMLHttpRequest();
	    }else{
	      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	    }
	      var xmlhttp = new XMLHttpRequest();
	      xmlhttp.onreadystatechange = function()
	    {
		    if(xmlhttp.readyState==4 && xmlhttp.status==200){
		      var check = xmlhttp.responseText;
		      document.getElementById("form_area").innerHTML = check;
		    }
	    }
		  xmlhttp.open('GET','foredituser.php?id='+id,true);
		  xmlhttp.send();
	}



	function update_user(id){

		  var id = id;	
		  var name = document.getElementById("name").value; 
		  var email = document.getElementById("email").value;
		  var dob = document.getElementById("dob").value;
		  var password = document.getElementById("password").value;
		  var cnf_password = document.getElementById("cnf_password").value;
	
			if((name=='')||(email=='')||(dob=='')||(password=='')||(cnf_password==''))
			{   
			      if(name==''){
			      $('#name').focus();
			      return;
			      }
			      else if(email==''){
			      $('#email').focus(); 
			      return;
			      }
			      else if(dob==''){
			      $('#dob').focus(); 
			      return;
			      }
			      else if(password==''){
			      $('#password').focus(); 
			      return;
			      }
			      else if(cnf_password==''){
			      $('#cnf_password').focus(); 
			      return;
			      }
			}else if(password!=cnf_password){
				 $('.user_exists').css('display','none');
			     $('.error').css('display','block'); 
			     return;
			 } 


			var email = document.getElementById('email');
		    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			   if (!filter.test(email.value)) {
				    $('#email').focus();
				    return;
			   }

			 var email = document.getElementById("email").value;

			var xmlhttp;
		    if(window.XMLHttpRequest)
		    { //code for IE7+, firefox, chrome, opera,safari
		      xmlhttp = new XMLHttpRequest();
		    }else{
		      xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		    }
		    
		    var xmlhttp = new XMLHttpRequest();
		    xmlhttp.onreadystatechange = function()
		    {
			    if(xmlhttp.readyState==4 && xmlhttp.status==200){
			      var check = xmlhttp.responseText;
			        if (check=="updated"){
			        	window.location.reload();
			        }else{
			        $('.error').css('display','none');
		        	$('.user_exists').css('display','block');
		        	 document.getElementById("dob").value = '';
					 document.getElementById("password").value = '';
					 document.getElementById("cnf_password").value = '';
			        }
			    }
		    }
		xmlhttp.open('GET','forupdateuser.php?id='+id+'&name='+name+'&email='+email+'&dob='+dob+'&password='+password,true);
		xmlhttp.send();  
	}

</script>



</body>
</html>