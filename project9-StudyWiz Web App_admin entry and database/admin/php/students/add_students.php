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
if(isset($_POST['add_student'])){
	// get data entered and store in variable
	$student_name=$_POST['student_name'];
	$student_email=$_POST['student_email'];
	$student_password=$_POST['student_password'];
	$student_school=$_POST['student_school'];
	$student_photo=$_FILES['student_photo']['name'];
	$student_photo_temp_name=$_FILES['student_photo']['tmp_name'];
	$student_photo_folder='../../img/'.$student_photo;

	// validations
	if(empty($student_name)){
		$nameError="Student name is required";
	}
	elseif(empty($student_email)){
		$nameError="Student email is required";
	}
	elseif(empty($student_password)){
		$nameError="Student password is required";
	}
	elseif(empty($student_school)){
		$nameError="Student school is required";
	}
	elseif(empty($student_photo)){
		$nameError="Student photo is required";
	}
	else{
		$student_name=trim($student_name);
		$student_name=htmlspecialchars($student_name);
		// name validation
		if(!preg_match("/^[a-zA-Z ]+$/",$student_name)){
			$nameError="<br>Student name should only contain characters and space.";
		}
		elseif(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$student_email)){
			$passwordError="<br/>Invalid email ID format";
		}
		elseif(strlen($student_password)<8){
			$passwordError="<br>Password must be at least 8 digits.";
		}
		elseif(!preg_match("#[a-z]+#",$student_password)){
			$passwordError="<br>Password must have at least one small letter.";
		}
		elseif(!preg_match("#[A-Z]+#",$student_password)){
			$passwordError="<br>Password must have at least one capital letter.";
		}
		else{
			$insert_query=mysqli_query($conn, "insert into student (student_name,student_email,student_password,student_school,student_photo) values('$student_name','$student_email','$student_password','$student_school','$student_photo')") or die("Insert query failed");
			if($insert_query){
				move_uploaded_file($student_photo_temp_name,$student_photo_folder);
				$display_message="Student added successfully";
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
		<title>admin add student</title>
		<link rel="stylesheet" href="../../css/admin.css">
		<link rel="stylesheet" href="../../css/admin_students.css">
		<!-- ICONS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	</head>
	<body>
		<?php 
		include('../admin_header.php')
		?>

		<!-- form -->
		<section>
			<h3 class="heading">Add Student</h3>
			<form action="" class="add_students" method="post" enctype="multipart/form-data">
				<input type="text" name="student_name" placeholder="Enter username" class="input_fields">
				<span><b><?php echo $nameError?></b></span>
				<input type="text" name="student_email" placeholder="Enter email" class="input_fields">
				<span><b><?php echo $emailError?></b></span>
				<input type="text" name="student_password" placeholder="Enter password" class="input_fields">
				<span><b><?php echo $passwordError?></b></span>
				<input type="text" name="student_school" placeholder="Enter school" class="input_fields">
				<span><b><?php echo $schoolError?></b></span>
				<input type="file" name="student_photo" placeholder="Insert photo" class="input_fields" accept="image/png, image/jpg, image/jpeg">
				<span><b><?php echo $imageError?></b></span>
				<input type="submit" name="add_student" class="submit_btn" value="Add Student">
			</form>
		</section>
	</body>
</html>