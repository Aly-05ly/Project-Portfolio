<!-- Author: Amberly Loh Binti Mohd Azlan Loh
	 Email: amberly456loh@gmail.com
 -->
	 
 <?php include '../admin_connect.php';
// variables
$nameError="";
$emailError="";
$passwordError="";
$classError="";
$imageError="";

 if(isset($_POST['edit_teacher'])){
	$edit_teacher_id=$_POST['edit_teacher_id']; 
	$edit_teacher_name=$_POST['edit_teacher_name'];
	$edit_teacher_email=$_POST['edit_teacher_email'];
	$edit_teacher_password=$_POST['edit_teacher_password'];
	$edit_teacher_class=$_POST['edit_teacher_class'];
	$edit_teacher_photo=$_FILES['edit_teacher_photo']['name'];
	$edit_teacher_photo_temp_name=$_FILES['edit_teacher_photo']['tmp_name'];
	$edit_teacher_photo_folder='../../img/'.$edit_teacher_photo;

	// validations
	if(empty($edit_teacher_name)){
		$nameError="teacher name is required";
	}
	elseif(empty($edit_teacher_email)){
		$nameError="teacher email is required";
	}
	elseif(empty($edit_teacher_password)){
		$nameError="teacher password is required";
	}
	elseif(empty($edit_teacher_class)){
		$nameError="teacher class is required";
	}
	elseif(empty($edit_teacher_photo)){
		$nameError="teacher photo is required";
	}
	else{
		$edit_teacher_name=trim($edit_teacher_name);
		$edit_teacher_name=htmlspecialchars($edit_teacher_name);
		// name validation
		if(!preg_match("/^[a-zA-Z ]+$/",$edit_teacher_name)){
			$nameError="<br>teacher name should only contain characters and space.";
		}
		elseif(!preg_match("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^",$edit_teacher_email)){
			$passwordError="<br/>Invalid email ID format";
		}
		elseif(strlen($edit_teacher_password)<8){
			$passwordError="<br>Password must be at least 8 digits.";
		}
		elseif(!preg_match("#[a-z]+#",$edit_teacher_password)){
			$passwordError="<br>Password must have at least one small letter.";
		}
		elseif(!preg_match("#[A-Z]+#",$edit_teacher_password)){
			$passwordError="<br>Password must have at least one capital letter.";
		}
		else{
			$edit_teachers=mysqli_query($conn, "update teacher set teacher_name='$edit_teacher_name',teacher_email='$edit_teacher_email',teacher_password='$edit_teacher_password',teacher_class='$edit_teacher_class',teacher_photo='$edit_teacher_photo' where teacher_id=$edit_teacher_id");
			if($edit_teachers){
				move_uploaded_file($edit_teacher_photo_temp_name,$edit_teacher_photo_folder);
				header('location:view_teachers.php');
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
		<title>admin edit teacher</title>
		<link rel="stylesheet" href="../../css/admin.css">
		<link rel="stylesheet" href="../../css/admin_teachers.css">
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
				$edit_query=mysqli_query($conn,"Select * from teacher where teacher_id=$edit_id");
				if(mysqli_num_rows($edit_query)>0){
					$fetch_data=mysqli_fetch_assoc($edit_query);
		?>
		<!-- form -->
		<section >


			<h3 class="heading">Edit teacher</h3>
			<form action="" class="edit_teachers" method="post" enctype="multipart/form-data">
				<input type="hidden" value="<?php echo $fetch_data['teacher_id']?>" name="edit_teacher_id">
				<input type="text" name="edit_teacher_name" value="<?php echo $fetch_data['teacher_name']?>" class="input_fields">
				<span><b><?php echo $nameError?></b></span>
				<input type="text" name="edit_teacher_email" value="<?php echo $fetch_data['teacher_email']?>" class="input_fields">
				<span><b><?php echo $emailError?></b></span>
				<input type="text" name="edit_teacher_password" value="<?php echo $fetch_data['teacher_password']?>" class="input_fields">
				<span><b><?php echo $passwordError?></b></span>
				<input type="text" name="edit_teacher_class" value="<?php echo $fetch_data['teacher_class']?>" class="input_fields">
				<span><b><?php echo $classError?></b></span>
				<input type="file" name="edit_teacher_photo" value="<?php echo $fetch_data['teacher_photo']?>" class="input_fields" accept="image/png, image/jpg, image/jpeg">
				<span><b><?php echo $imageError?></b></span>
				<div class="btns">
				<input type="submit" name="edit_teacher" class="edit_btn" value="Edit teacher">
				<input type="reset" name="reset_teacher" class="cancel_btn" value="Cancel">
				</div>
			</form>
			<?php
				}
			}
			?>
		</section>
	</body>
</html>