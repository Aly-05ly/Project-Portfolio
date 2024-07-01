<!-- Author: Amberly Loh Binti Mohd Azlan Loh
	 Email: amberly456loh@gmail.com
 -->

 <?php 
// variables
$nameError="";
$emailError="";
$passwordError="";
$classError="";
$imageError="";

include '../admin_connect.php';
if(isset($_POST['add_teacher'])){
	// get data entered and store in variable
	$teacher_name=$_POST['teacher_name'];
	$teacher_email=$_POST['teacher_email'];
	$teacher_password=$_POST['teacher_password'];
	$teacher_class=$_POST['teacher_class'];
	$teacher_photo=$_FILES['teacher_photo']['name'];
	$teacher_photo_temp_name=$_FILES['teacher_photo']['tmp_name'];
	$teacher_photo_folder='../../img/'.$teacher_photo;

	// validations
	if(empty($teacher_name)){
		$nameError="teacher name is required";
	}
	elseif(empty($teacher_email)){
		$nameError="teacher email is required";
	}
	elseif(empty($teacher_password)){
		$nameError="teacher password is required";
	}
	elseif(empty($teacher_class)){
		$nameError="teacher class is required";
	}
	elseif(empty($teacher_photo)){
		$nameError="teacher photo is required";
	}
	else{
		$teacher_name=trim($teacher_name);
		$teacher_name=htmlspecialchars($teacher_name);
		// name validation
		if(!preg_match("/^[a-zA-Z ]+$/",$teacher_name)){
			$nameError="<br>teacher name should only contain characters and space.";
		}
		elseif(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$teacher_email)){
			$passwordError="<br/>Invalid email ID format";
		}
		elseif(strlen($teacher_password)<8){
			$passwordError="<br>Password must be at least 8 digits.";
		}
		elseif(!preg_match("#[a-z]+#",$teacher_password)){
			$passwordError="<br>Password must have at least one small letter.";
		}
		elseif(!preg_match("#[A-Z]+#",$teacher_password)){
			$passwordError="<br>Password must have at least one capital letter.";
		}
		else{
			$insert_query=mysqli_query($conn, "insert into teacher (teacher_name,teacher_email,teacher_password,teacher_class,teacher_photo) values('$teacher_name','$teacher_email','$teacher_password','$teacher_class','$teacher_photo')") or die("Insert query failed");
			if($insert_query){
				move_uploaded_file($teacher_photo_temp_name,$teacher_photo_folder);
				$display_message="teacher added successfully";
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
		<title>admin add teacher</title>
		<link rel="stylesheet" href="../../css/admin.css">
		<link rel="stylesheet" href="../../css/admin_teachers.css">
		<!-- ICONS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	</head>
	<body>
		<?php 
		include('../admin_header.php')
		?>

		<!-- form -->
		<section>
			<h3 class="heading">Add teacher</h3>
			<form action="" class="add_teachers" method="post" enctype="multipart/form-data">
				<input type="text" name="teacher_name" placeholder="Enter username" class="input_fields">
				<span><b><?php echo $nameError?></b></span>
				<input type="text" name="teacher_email" placeholder="Enter email" class="input_fields">
				<span><b><?php echo $emailError?></b></span>
				<input type="text" name="teacher_password" placeholder="Enter password" class="input_fields">
				<span><b><?php echo $passwordError?></b></span>
				<input type="text" name="teacher_class" placeholder="Enter class name" class="input_fields">
				<span><b><?php echo $classError?></b></span>
				<input type="file" name="teacher_photo" placeholder="Insert photo" class="input_fields" accept="image/png, image/jpg, image/jpeg">
				<span><b><?php echo $imageError?></b></span>
				<input type="submit" name="add_teacher" class="submit_btn" value="Add teacher">
			</form>
		</section>
	</body>
</html>