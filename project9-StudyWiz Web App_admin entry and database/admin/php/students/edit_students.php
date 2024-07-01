<!-- Author: Amberly Loh Binti Mohd Azlan Loh
	 Email: amberly456loh@gmail.com
 -->
	 
<?php include '../admin_connect.php';
// variables
$nameError="";
$emailError="";
$passwordError="";
$schoolError="";
$imageError="";

 if(isset($_POST['edit_student'])){
	$edit_student_id=$_POST['edit_student_id']; 
	$edit_student_name=$_POST['edit_student_name'];
	$edit_student_email=$_POST['edit_student_email'];
	$edit_student_password=$_POST['edit_student_password'];
	$edit_student_school=$_POST['edit_student_school'];
	$edit_student_photo=$_FILES['edit_student_photo']['name'];
	$edit_student_photo_temp_name=$_FILES['edit_student_photo']['tmp_name'];
	$edit_student_photo_folder='../../img/'.$edit_student_photo;

	// validations
	if(empty($edit_student_name)){
		$nameError="Student name is required";
	}
	elseif(empty($edit_student_email)){
		$nameError="Student email is required";
	}
	elseif(empty($edit_student_password)){
		$nameError="Student password is required";
	}
	elseif(empty($edit_student_school)){
		$nameError="Student school is required";
	}
	elseif(empty($edit_student_photo)){
		$nameError="Student photo is required";
	}
	else{
		$edit_student_name=trim($edit_student_name);
		$edit_student_name=htmlspecialchars($edit_student_name);
		// name validation
		if(!preg_match("/^[a-zA-Z ]+$/",$edit_student_name)){
			$nameError="<br>Student name should only contain characters and space.";
		}
		elseif(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$edit_student_email)){
			$passwordError="<br/>Invalid email ID format";
		}
		elseif(strlen($edit_student_password)<8){
			$passwordError="<br>Password must be at least 8 digits.";
		}
		elseif(!preg_match("#[a-z]+#",$edit_student_password)){
			$passwordError="<br>Password must have at least one small letter.";
		}
		elseif(!preg_match("#[A-Z]+#",$edit_student_password)){
			$passwordError="<br>Password must have at least one capital letter.";
		}
		else{
			$edit_students=mysqli_query($conn, "update student set student_name='$edit_student_name',student_email='$edit_student_email',student_password='$edit_student_password',student_school='$edit_student_school',student_photo='$edit_student_photo' where student_id=$edit_student_id");
			if($edit_students){
				move_uploaded_file($edit_student_photo_temp_name,$edit_student_photo_folder);
				header('location:view_students.php');
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
		<title>admin edit student</title>
		<link rel="stylesheet" href="../../css/admin.css">
		<link rel="stylesheet" href="../../css/admin_students.css">
		<!-- ICONS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	</head>
	<body>
	<?php include('../admin_header.php')?>

	<?php 
	if(isset($display_message)){
		echo " <div class='display_message'>
		<span>$display_message</span>
		<i class='fas fa-passwords' onclick='this.parentElement.style.display=`none`';></i>
	</div>";
	}
	?>
		<?php 
			if(isset($_GET['edit'])){
				$edit_id=$_GET['edit'];
				$edit_query=mysqli_query($conn,"Select * from student where student_id=$edit_id");
				if(mysqli_num_rows($edit_query)>0){
					$fetch_data=mysqli_fetch_assoc($edit_query);
		?>
		<!-- form -->
		<section >


			<h3 class="heading">Edit Student</h3>
			<form action="" class="edit_students" method="post" enctype="multipart/form-data">
				<input type="hidden" value="<?php echo $fetch_data['student_id']?>" name="edit_student_id">
				<input type="text" name="edit_student_name" value="<?php echo $fetch_data['student_name']?>" class="input_fields">
				<span><b><?php echo $nameError?></b></span>
				<input type="text" name="edit_student_email" value="<?php echo $fetch_data['student_email']?>" class="input_fields">
				<span><b><?php echo $emailError?></b></span>
				<input type="text" name="edit_student_password" value="<?php echo $fetch_data['student_password']?>" class="input_fields">
				<span><b><?php echo $passwordError?></b></span>
				<input type="text" name="edit_student_school" value="<?php echo $fetch_data['student_school']?>" class="input_fields">
				<span><b><?php echo $schoolError?></b></span>
				<input type="file" name="edit_student_photo" value="<?php echo $fetch_data['student_photo']?>" class="input_fields" accept="image/png, image/jpg, image/jpeg">
				<span><b><?php echo $imageError?></b></span>
				<div class="btns">
				<input type="submit" name="edit_student" class="edit_btn" value="Edit Student">
				<input type="reset" name="reset_student" class="cancel_btn" value="Cancel">
				</div>
			</form>
			<?php
				}
			}
			?>
		</section>
	</body>
</html>