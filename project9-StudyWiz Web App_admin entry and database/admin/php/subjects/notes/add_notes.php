<!-- Author: Amberly Loh Binti Mohd Azlan Loh
	 Email: amberly456loh@gmail.com
 -->

 <?php 
// variables
$nameError="";
$emailError="";
$passwordError="";
$schoolError="";
$imageError="";

include '../admin_connect.php';
if(isset($_POST['add_note'])){
	// get data entered and store in variable
	$note_name=$_POST['note_name'];
	$note_email=$_POST['note_email'];
	$note_password=$_POST['note_password'];
	$note_school=$_POST['note_school'];
	$note_photo=$_FILES['note_photo']['name'];
	$note_photo_temp_name=$_FILES['note_photo']['tmp_name'];
	$note_photo_folder='../../img/'.$note_photo;

	// validations
	if(empty($note_name)){
		$nameError="note name is required";
	}
	elseif(empty($note_email)){
		$nameError="note email is required";
	}
	elseif(empty($note_password)){
		$nameError="note password is required";
	}
	elseif(empty($note_school)){
		$nameError="note school is required";
	}
	elseif(empty($note_photo)){
		$nameError="note photo is required";
	}
	else{
		$note_name=trim($note_name);
		$note_name=htmlspecialchars($note_name);
		// name validation
		if(!preg_match("/^[a-zA-Z ]+$/",$note_name)){
			$nameError="<br>note name should only contain characters and space.";
		}
		elseif(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$note_email)){
			$passwordError="<br/>Invalid email ID format";
		}
		elseif(strlen($note_password)<8){
			$passwordError="<br>Password must be at least 8 digits.";
		}
		elseif(!preg_match("#[a-z]+#",$note_password)){
			$passwordError="<br>Password must have at least one small letter.";
		}
		elseif(!preg_match("#[A-Z]+#",$note_password)){
			$passwordError="<br>Password must have at least one capital letter.";
		}
		else{
			$insert_query=mysqli_query($conn, "insert into note (note_name,note_email,note_password,note_school,note_photo) values('$note_name','$note_email','$note_password','$note_school','$note_photo')") or die("Insert query failed");
			if($insert_query){
				move_uploaded_file($note_photo_temp_name,$note_photo_folder);
				$display_message="note added successfully";
			}
			else{
				$display_message="Error occured when inserting photo";
			}
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
		<title>admin add note</title>
		<link rel="stylesheet" href="../../css/admin.css">
		<link rel="stylesheet" href="../../../css/admin_notes.css">
		<!-- ICONS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	</head>
	<body>
		<?php 
		include('../admin_header.php')
		?>

		<!-- form -->
		<section>
			<h3 class="heading">Add Notes</h3>
			<form action="" class="add_notes" method="post" enctype="multipart/form-data">
				<input type="text" name="note_name" placeholder="Enter username" class="input_fields">
				<span><b><?php echo $nameError?></b></span>
				<input type="text" name="note_email" placeholder="Enter email" class="input_fields">
				<span><b><?php echo $emailError?></b></span>
				<input type="text" name="note_password" placeholder="Enter password" class="input_fields">
				<span><b><?php echo $passwordError?></b></span>
				<input type="text" name="note_school" placeholder="Enter school" class="input_fields">
				<span><b><?php echo $schoolError?></b></span>
				<input type="file" name="note_photo" placeholder="Insert photo" class="input_fields" accept="image/png, image/jpg, image/jpeg">
				<span><b><?php echo $imageError?></b></span>
				<input type="submit" name="add_note" class="submit_btn" value="Add note">
			</form>
		</section>
	</body>
</html>