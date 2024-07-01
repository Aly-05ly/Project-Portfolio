<?php 
// variables
$nameError="";
$passwordError="";


if(isset($_POST['admin_login'])){
	// get data entered and store in variable
	$admin_username=$_POST['admin_username'];
	$admin_password=$_POST['admin_password'];

	// validations
	if(empty($admin_username)){
		$nameError="Admin username is required";
	}
	elseif(empty($admin_password)){
		$nameError="Admin password is required";
	}else{
		$admin_username=trim($admin_username);
		$admin_username=htmlspecialchars($admin_username);
		// name validation
		if(!preg_match("/^[a-zA-Z ]+$/",$admin_username)){
			$nameError="<br>Admin username should only contain characters and space.";
		}
		elseif(strlen($admin_password)<8){
			$passwordError="<br>Password must be at least 8 digits.";
		}
		elseif(!preg_match("#[a-z]+#",$admin_password)){
			$passwordError="<br>Password must have at least one small letter.";
		}
		elseif(!preg_match("#[A-Z]+#",$admin_password)){
			$passwordError="<br>Password must have at least one capital letter.";
		}
	}
}
	?>
<!DOCTYPE html>
<html lang="en">
	<!-- 1. HEAD -->
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin Login</title>
		<link rel="stylesheet" href="../css/admin.css">
		<!-- ICONS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
		<style>
			.heading {
			text-align: center;
			font-size: 4rem;
			text-transform: uppercase;
			padding: 1.5rem 0 2rem;
			color: #363533;
		}

		</style>
	</head>
	<body>
	<?php 
		include('admin_login_header.php')
		?>
		<section>
		<h3 class="heading">Admin Login Panel</h3>
		<form action="notes/view_notes.php" method="post" class="add_admin"> 

			<label >Username</label>
			<input type="text" id="admin_username" name="admin_username" placeholder="Admin Name" class="input_fields">

			<label >Password</label>
			<input type="password" id="admin_password" name="admin_password" placeholder="admin_password" class="input_fields">
			<input style="display: block;margin: 0 auto; padding:10px 40px ;border-radius:5px;color:white;background-color:#363533;font-size:1.7rem" type="submit" class="submit_btn" name="admin_login" value="Login" class="input_fields">
			
	</form>
	</section>

	</body>
</html>