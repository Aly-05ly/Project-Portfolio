<!-- Author: Amberly Loh Binti Mohd Azlan Loh
	 name: amberly456loh@gmail.com
 -->

 <?php 
// variables
$subjectError="";
$nameError="";
$questionError="";
$answerError="";
$imageError="";

include '../admin_connect.php';
if(isset($_POST['edit_quiz'])){
	// get data entered and store in variable
	$edit_quiz_subject=$_POST['edit_quiz_subject'];
	$edit_quiz_name=$_POST['edit_quiz_name'];
	$edit_quiz_q1=$_POST['edit_quiz_q1'];
	$edit_quiz_a1correct=$_POST['edit_quiz_a1correct'];
	$edit_quiz_a1a=$_POST['edit_quiz_a1a'];
	$edit_quiz_a1b=$_POST['edit_quiz_a1b'];
	$edit_quiz_a1c=$_POST['edit_quiz_a1c'];
	$edit_quiz_a1d=$_POST['edit_quiz_a1d'];
	$edit_quiz_q2=$_POST['edit_quiz_q2'];
	$edit_quiz_a2correct=$_POST['edit_quiz_a2correct'];
	$edit_quiz_a2a=$_POST['edit_quiz_a2a'];
	$edit_quiz_a2b=$_POST['edit_quiz_a2b'];
	$edit_quiz_a2c=$_POST['edit_quiz_a2c'];
	$edit_quiz_a2d=$_POST['edit_quiz_a2d'];
	$edit_quiz_q3=$_POST['edit_quiz_q3'];
	$edit_quiz_a3correct=$_POST['edit_quiz_a3correct'];
	$edit_quiz_a3a=$_POST['edit_quiz_a3a'];
	$edit_quiz_a3b=$_POST['edit_quiz_a3b'];
	$edit_quiz_a3c=$_POST['edit_quiz_a3c'];
	$edit_quiz_a3d=$_POST['edit_quiz_a3d'];
	$edit_quiz_q4=$_POST['edit_quiz_q4'];
	$edit_quiz_a4correct=$_POST['edit_quiz_a4correct'];
	$edit_quiz_a4a=$_POST['edit_quiz_a4a'];
	$edit_quiz_a4b=$_POST['edit_quiz_a4b'];
	$edit_quiz_a4c=$_POST['edit_quiz_a4c'];
	$edit_quiz_a4d=$_POST['edit_quiz_a4d'];
	$edit_quiz_q5=$_POST['edit_quiz_q5'];
	$edit_quiz_a5correct=$_POST['edit_quiz_a5correct'];
	$edit_quiz_a5a=$_POST['edit_quiz_a5a'];
	$edit_quiz_a5b=$_POST['edit_quiz_a5b'];
	$edit_quiz_a5c=$_POST['edit_quiz_a5c'];
	$edit_quiz_a5d=$_POST['edit_quiz_a5d'];
	$edit_quiz_q6=$_POST['edit_quiz_q6'];
	$edit_quiz_a6correct=$_POST['edit_quiz_a6correct'];
	$edit_quiz_a6a=$_POST['edit_quiz_a6a'];
	$edit_quiz_a6b=$_POST['edit_quiz_a6b'];
	$edit_quiz_a6c=$_POST['edit_quiz_a6c'];
	$edit_quiz_a6d=$_POST['edit_quiz_a6d'];
	$edit_quiz_q7=$_POST['edit_quiz_q7'];
	$edit_quiz_a7correct=$_POST['edit_quiz_a7correct'];
	$edit_quiz_a7a=$_POST['edit_quiz_a7a'];
	$edit_quiz_a7b=$_POST['edit_quiz_a7b'];
	$edit_quiz_a7c=$_POST['edit_quiz_a7c'];
	$edit_quiz_a7d=$_POST['edit_quiz_a7d'];
	$edit_quiz_q8=$_POST['edit_quiz_q8'];
	$edit_quiz_a8correct=$_POST['edit_quiz_a8correct'];
	$edit_quiz_a8a=$_POST['edit_quiz_a8a'];
	$edit_quiz_a8b=$_POST['edit_quiz_a8b'];
	$edit_quiz_a8c=$_POST['edit_quiz_a8c'];
	$edit_quiz_a8d=$_POST['edit_quiz_a8d'];
	$edit_quiz_q9=$_POST['edit_quiz_q9'];
	$edit_quiz_a9correct=$_POST['edit_quiz_a9correct'];
	$edit_quiz_a9a=$_POST['edit_quiz_a9a'];
	$edit_quiz_a9b=$_POST['edit_quiz_a9b'];
	$edit_quiz_a9c=$_POST['edit_quiz_a9c'];
	$edit_quiz_a9d=$_POST['edit_quiz_a9d'];
	$edit_quiz_q10=$_POST['edit_quiz_q10'];
	$edit_quiz_a10correct=$_POST['edit_quiz_a10correct'];
	$edit_quiz_a10a=$_POST['edit_quiz_a10a'];
	$edit_quiz_a10b=$_POST['edit_quiz_a10b'];
	$edit_quiz_a10c=$_POST['edit_quiz_a10c'];
	$edit_quiz_a10d=$_POST['edit_quiz_a10d'];
	$edit_quiz_photo=$_FILES['edit_quiz_photo']['name'];
	$edit_quiz_photo_temp_name=$_FILES['edit_quiz_photo']['tmp_name'];
	$edit_quiz_photo_folder='../../img/'.$edit_quiz_photo;

	// validations
	if(empty($edit_quiz_subject)){
		$nameError="edit_quiz name is required";
	}
	elseif(empty($edit_quiz_name)){
		$nameError="edit_quiz name is required";
	}
	elseif(empty($edit_quiz_q1)){
		$nameError="edit_quiz question is required";
	}
	elseif(empty($edit_quiz_a1correct)){
		$nameError="edit_quiz answer is required";
	}
	elseif(empty($edit_quiz_q2)){
		$nameError="edit_quiz question is required";
	}
	elseif(empty($edit_quiz_a2correct)){
		$nameError="edit_quiz answer is required";
	}
	elseif(empty($edit_quiz_q3)){
		$nameError="edit_quiz question is required";
	}
	elseif(empty($edit_quiz_a3correct)){
		$nameError="edit_quiz answer is required";
	}
	elseif(empty($edit_quiz_q4)){
		$nameError="edit_quiz question is required";
	}
	elseif(empty($edit_quiz_a4correct)){
		$nameError="edit_quiz answer is required";
	}
	elseif(empty($edit_quiz_q5)){
		$nameError="edit_quiz question is required";
	}
	elseif(empty($edit_quiz_a5correct)){
		$nameError="edit_quiz answer is required";
	}
	elseif(empty($edit_quiz_q6)){
		$nameError="edit_quiz question is required";
	}
	elseif(empty($edit_quiz_a6correct)){
		$nameError="edit_quiz answer is required";
	}
	elseif(empty($edit_quiz_q7)){
		$nameError="edit_quiz question is required";
	}
	elseif(empty($edit_quiz_a7correct)){
		$nameError="edit_quiz answer is required";
	}
	elseif(empty($edit_quiz_q8)){
		$nameError="edit_quiz question is required";
	}
	elseif(empty($edit_quiz_a8correct)){
		$nameError="edit_quiz answer is required";
	}
	elseif(empty($edit_quiz_q9)){
		$nameError="edit_quiz question is required";
	}
	elseif(empty($edit_quiz_a9correct)){
		$nameError="edit_quiz answer is required";
	}
	elseif(empty($edit_quiz_q10)){
		$nameError="edit_quiz question is required";
	}
	elseif(empty($edit_quiz_a10correct)){
		$nameError="edit_quiz answer is required";
	}
	elseif(empty($edit_quiz_photo)){
		$coverError="edit_quiz cover photo is required";
	}
	else{
		$edit_quiz_name=trim($edit_quiz_name);
		$edit_quiz_name=htmlspecialchars($edit_quiz_name);
		// name validation
		if(!preg_match("/^[a-zA-Z ]+$/",$edit_quiz_name)){
			$nameError="<br>edit_quiz name should only contain characters and space.";
		}
		else{
			$insert_query=mysqli_query($conn, "update quiz set quiz_subject='$edit_quiz_subject',quiz_name='$edit_quiz_name',quiz_q1='$edit_quiz_q1',quiz_a1correct='$edit_quiz_a1correct',quiz_a1a='$edit_quiz_a1a',quiz_a1b='$edit_quiz_a1b',quiz_a1c='$edit_quiz_a1c',quiz_a1d='$edit_quiz_a1d',quiz_q2='$edit_quiz_q2',quiz_a2correct='$edit_quiz_a2correct',quiz_a2a='$edit_quiz_a2a',quiz_a2b='$edit_quiz_a2b',quiz_a2c='$edit_quiz_a2c',quiz_a2d='$edit_quiz_a2d',quiz_q3='$edit_quiz_q3',quiz_a3correct='$edit_quiz_a3correct',quiz_a3a='$edit_quiz_a3a',quiz_a3b='$edit_quiz_a3b',quiz_a3c='$edit_quiz_a3c',quiz_a3d='$edit_quiz_a3d',quiz_q4='$edit_quiz_q4',quiz_a4correct='$edit_quiz_a4correct',quiz_a4a='$edit_quiz_a4a',quiz_a4b='$edit_quiz_a4b',quiz_a4c='$edit_quiz_a4c',quiz_a4d='$edit_quiz_a4d',quiz_q5='$edit_quiz_q5',quiz_a5correct='$edit_quiz_a5correct',quiz_a5a='$edit_quiz_a5a',quiz_a5b='$edit_quiz_a5b',quiz_a5c='$edit_quiz_a5c',quiz_a5d='$edit_quiz_a5d',quiz_q6='$edit_quiz_q6',quiz_a6correct='$edit_quiz_a6correct',quiz_a6a='$edit_quiz_a6a',quiz_a6b='$edit_quiz_a6b',quiz_a6c='$edit_quiz_a6c',quiz_a6d='$edit_quiz_a6d',quiz_q7='$edit_quiz_q7',quiz_a7correct='$edit_quiz_a7correct',quiz_a7a='$edit_quiz_a7a',quiz_a7b='$edit_quiz_a7b',quiz_a7c='$edit_quiz_a7c',quiz_a7d='$edit_quiz_a7d',quiz_q8='$edit_quiz_q8',quiz_a8correct='$edit_quiz_a8correct',quiz_a8a='$edit_quiz_a8a',quiz_a8b='$edit_quiz_a8b',quiz_a8c='$edit_quiz_a8c',quiz_a8d='$edit_quiz_a8d',quiz_q9='$edit_quiz_q9',quiz_a9correct='$edit_quiz_a9correct',quiz_a9a='$edit_quiz_a9a',quiz_a9b='$edit_quiz_a9b',quiz_a9c='$edit_quiz_a9c',quiz_a9d='$edit_quiz_a9d',quiz_q10='$edit_quiz_q10',quiz_a10correct='$edit_quiz_a10correct',quiz_a10a='$edit_quiz_a10a',quiz_a10b='$edit_quiz_a10b',quiz_a10c='$edit_quiz_a10c',quiz_a10d='$edit_quiz_a10d',quiz_photo ='$edit_quiz_photo'");
			if($insert_query){
				move_uploaded_file($edit_quiz_photo_temp_name,$edit_quiz_photo_folder);
				$display_message="Quiz edited successfully";
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
		<title>admin add edit_quiz</title>
		<link rel="stylesheet" href="../../css/admin.css">
		<link rel="stylesheet" href="../../css/admin_quizzes.css">
		<!-- ICONS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	<style>
	label{
	display: block;
	background-color: #363533;
	color: white;
	text-align: center;
	font-size: 1.7rem;
	padding: 0.5rem;
	font-family: sans-serif;
	border-radius: 0.3rem;
	margin-top: 1rem;
  }
	</style>
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
				$edit_query=mysqli_query($conn,"Select * from quiz where quiz_id=$edit_id");
				if(mysqli_num_rows($edit_query)>0){
					$fetch_data=mysqli_fetch_assoc($edit_query);
		?>

		<!-- form -->
		<section>
			<h3 class="heading">Edit Quiz</h3>
			<form action="" class="edit_quizzes" method="post" enctype="multipart/form-data">
				<input type="text" name="edit_quiz_subject" value="<?php echo $fetch_data['quiz_subject']?>" placeholder="Enter Subject" class="input_fields">
				<span><b><?php echo $subjectError?></b></span>
				<input type="text" name="edit_quiz_name" value="<?php echo $fetch_data['quiz_name']?>" placeholder="Enter Name" class="input_fields">
				<span><b><?php echo $nameError?></b></span>
				<input type="file" name="edit_quiz_photo" value="<?php echo $fetch_data['quiz_photo']?>" placeholder="Insert Cover Photo" class="input_fields" accept="image/png, image/jpg, image/jpeg">
				<span><b><?php echo $imageError?></b></span>

				<label for="q1">Question 1</label>
				<input type="text" name="edit_quiz_q1" value="<?php echo $fetch_data['quiz_q1']?>" placeholder="Enter Question 1" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="edit_quiz_a1correct" value="<?php echo $fetch_data['quiz_a1correct']?>" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a1a" value="<?php echo $fetch_data['quiz_a1a']?>" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a1b" value="<?php echo $fetch_data['quiz_a1b']?>" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a1c" value="<?php echo $fetch_data['quiz_a1c']?>" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a1d" value="<?php echo $fetch_data['quiz_a1d']?>" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>

				<label for="q2">Question 2</label>
				<input type="text" name="edit_quiz_q2" value="<?php echo $fetch_data['quiz_q2']?>" placeholder="Enter Question 2" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="edit_quiz_a2correct" value="<?php echo $fetch_data['quiz_a2correct']?>" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a2a" value="<?php echo $fetch_data['quiz_a2a']?>" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a2b" value="<?php echo $fetch_data['quiz_a2b']?>" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a2c" value="<?php echo $fetch_data['quiz_a2c']?>" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a2d" value="<?php echo $fetch_data['quiz_a2d']?>" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>

				<label for="q3">Question 3</label>
				<input type="text" name="edit_quiz_q3" value="<?php echo $fetch_data['quiz_q3']?>" placeholder="Enter Question 3" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="edit_quiz_a3correct" value="<?php echo $fetch_data['quiz_a3correct']?>" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a3a" value="<?php echo $fetch_data['quiz_a3a']?>" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a3b" value="<?php echo $fetch_data['quiz_a3b']?>" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a3c" value="<?php echo $fetch_data['quiz_a3c']?>" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a3d" value="<?php echo $fetch_data['quiz_a3d']?>" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>

				<label for="q4">Question 4</label>
				<input type="text" name="edit_quiz_q4" value="<?php echo $fetch_data['quiz_q4']?>" placeholder="Enter Question 4" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="edit_quiz_a4correct" value="<?php echo $fetch_data['quiz_a4correct']?>" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a4a" value="<?php echo $fetch_data['quiz_a4a']?>" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a4b" value="<?php echo $fetch_data['quiz_a4b']?>" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a4c" value="<?php echo $fetch_data['quiz_a4c']?>" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a4d" value="<?php echo $fetch_data['quiz_a4d']?>" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>

				<label for="q5">Question 5</label>
				<input type="text" name="edit_quiz_q5" value="<?php echo $fetch_data['quiz_q5']?>" placeholder="Enter Question 5" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="edit_quiz_a5correct" value="<?php echo $fetch_data['quiz_a5correct']?>" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a5a" value="<?php echo $fetch_data['quiz_a5a']?>" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a5b" value="<?php echo $fetch_data['quiz_a5b']?>" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a5c" value="<?php echo $fetch_data['quiz_a5c']?>" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a5d" value="<?php echo $fetch_data['quiz_a5d']?>" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>

				<label for="q6">Question 6</label>
				<input type="text" name="edit_quiz_q6" value="<?php echo $fetch_data['quiz_q6']?>" placeholder="Enter Question 6" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="edit_quiz_a6correct" value="<?php echo $fetch_data['quiz_a6correct']?>" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a6a" value="<?php echo $fetch_data['quiz_a6a']?>" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a6b" value="<?php echo $fetch_data['quiz_a6b']?>" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a6c" value="<?php echo $fetch_data['quiz_a6c']?>" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a6d" value="<?php echo $fetch_data['quiz_a6d']?>" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>

				<label for="q7">Question 7</label>
				<input type="text" name="edit_quiz_q7" value="<?php echo $fetch_data['quiz_q7']?>" placeholder="Enter Question 7" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="edit_quiz_a7correct" value="<?php echo $fetch_data['quiz_a7correct']?>" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a7a" value="<?php echo $fetch_data['quiz_a7a']?>" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a7b" value="<?php echo $fetch_data['quiz_a7b']?>" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a7c" value="<?php echo $fetch_data['quiz_a7c']?>" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a7d" value="<?php echo $fetch_data['quiz_a7d']?>" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>

				<label for="q8">Question 8</label>
				<input type="text" name="edit_quiz_q8" value="<?php echo $fetch_data['quiz_q8']?>" placeholder="Enter Question 8" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="edit_quiz_a8correct" value="<?php echo $fetch_data['quiz_a8correct']?>" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a8a" value="<?php echo $fetch_data['quiz_a8a']?>" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a8b" value="<?php echo $fetch_data['quiz_a8b']?>" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a8c" value="<?php echo $fetch_data['quiz_a8c']?>" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a8d" value="<?php echo $fetch_data['quiz_a8d']?>" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>

				<label for="q9">Question 9</label>
				<input type="text" name="edit_quiz_q9" value="<?php echo $fetch_data['quiz_q9']?>" placeholder="Enter Question 9" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="edit_quiz_a9correct" value="<?php echo $fetch_data['quiz_a9correct']?>" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a9a" value="<?php echo $fetch_data['quiz_a9a']?>" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a9b" value="<?php echo $fetch_data['quiz_a9b']?>" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a9c" value="<?php echo $fetch_data['quiz_a9c']?>" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a9d" value="<?php echo $fetch_data['quiz_a9d']?>" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>

				<label for="q10">Question 10</label>
				<input type="text" name="edit_quiz_q10" value="<?php echo $fetch_data['quiz_q10']?>" placeholder="Enter Question 10" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="edit_quiz_a10correct" value="<?php echo $fetch_data['quiz_a10correct']?>" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a10a" value="<?php echo $fetch_data['quiz_a10a']?>" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a10b" value="<?php echo $fetch_data['quiz_a10b']?>" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a10c" value="<?php echo $fetch_data['quiz_a10c']?>" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="edit_quiz_a10d" value="<?php echo $fetch_data['quiz_a10d']?>" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				

				<input type="submit" name="edit_quiz" class="submit_btn" value="Edit Quiz">
			</form>
		</section>
		<?php
				}
			}
			?>
	</body>
</html>