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
if(isset($_POST['add_quiz'])){
	// get data entered and store in variable
	$quiz_subject=$_POST['quiz_subject'];
	$quiz_name=$_POST['quiz_name'];
	$quiz_q1=$_POST['quiz_q1'];
	$quiz_a1correct=$_POST['quiz_a1correct'];
	$quiz_a1a=$_POST['quiz_a1a'];
	$quiz_a1b=$_POST['quiz_a1b'];
	$quiz_a1c=$_POST['quiz_a1c'];
	$quiz_a1d=$_POST['quiz_a1d'];
	$quiz_q2=$_POST['quiz_q2'];
	$quiz_a2correct=$_POST['quiz_a2correct'];
	$quiz_a2a=$_POST['quiz_a2a'];
	$quiz_a2b=$_POST['quiz_a2b'];
	$quiz_a2c=$_POST['quiz_a2c'];
	$quiz_a2d=$_POST['quiz_a2d'];
	$quiz_q3=$_POST['quiz_q3'];
	$quiz_a3correct=$_POST['quiz_a3correct'];
	$quiz_a3a=$_POST['quiz_a3a'];
	$quiz_a3b=$_POST['quiz_a3b'];
	$quiz_a3c=$_POST['quiz_a3c'];
	$quiz_a3d=$_POST['quiz_a3d'];
	$quiz_q4=$_POST['quiz_q4'];
	$quiz_a4correct=$_POST['quiz_a4correct'];
	$quiz_a4a=$_POST['quiz_a4a'];
	$quiz_a4b=$_POST['quiz_a4b'];
	$quiz_a4c=$_POST['quiz_a4c'];
	$quiz_a4d=$_POST['quiz_a4d'];
	$quiz_q5=$_POST['quiz_q5'];
	$quiz_a5correct=$_POST['quiz_a5correct'];
	$quiz_a5a=$_POST['quiz_a5a'];
	$quiz_a5b=$_POST['quiz_a5b'];
	$quiz_a5c=$_POST['quiz_a5c'];
	$quiz_a5d=$_POST['quiz_a5d'];
	$quiz_q6=$_POST['quiz_q6'];
	$quiz_a6correct=$_POST['quiz_a6correct'];
	$quiz_a6a=$_POST['quiz_a6a'];
	$quiz_a6b=$_POST['quiz_a6b'];
	$quiz_a6c=$_POST['quiz_a6c'];
	$quiz_a6d=$_POST['quiz_a6d'];
	$quiz_q7=$_POST['quiz_q7'];
	$quiz_a7correct=$_POST['quiz_a7correct'];
	$quiz_a7a=$_POST['quiz_a7a'];
	$quiz_a7b=$_POST['quiz_a7b'];
	$quiz_a7c=$_POST['quiz_a7c'];
	$quiz_a7d=$_POST['quiz_a7d'];
	$quiz_q8=$_POST['quiz_q8'];
	$quiz_a8correct=$_POST['quiz_a8correct'];
	$quiz_a8a=$_POST['quiz_a8a'];
	$quiz_a8b=$_POST['quiz_a8b'];
	$quiz_a8c=$_POST['quiz_a8c'];
	$quiz_a8d=$_POST['quiz_a8d'];
	$quiz_q9=$_POST['quiz_q9'];
	$quiz_a9correct=$_POST['quiz_a9correct'];
	$quiz_a9a=$_POST['quiz_a9a'];
	$quiz_a9b=$_POST['quiz_a9b'];
	$quiz_a9c=$_POST['quiz_a9c'];
	$quiz_a9d=$_POST['quiz_a9d'];
	$quiz_q10=$_POST['quiz_q10'];
	$quiz_a10correct=$_POST['quiz_a10correct'];
	$quiz_a10a=$_POST['quiz_a10a'];
	$quiz_a10b=$_POST['quiz_a10b'];
	$quiz_a10c=$_POST['quiz_a10c'];
	$quiz_a10d=$_POST['quiz_a10d'];
	$quiz_photo=$_FILES['quiz_photo']['name'];
	$quiz_photo_temp_name=$_FILES['quiz_photo']['tmp_name'];
	$quiz_photo_folder='../../img/'.$quiz_photo;

	// validations
	if(empty($quiz_subject)){
		$nameError="quiz name is required";
	}
	elseif(empty($quiz_name)){
		$nameError="quiz name is required";
	}
	elseif(empty($quiz_q1)){
		$nameError="quiz question is required";
	}
	elseif(empty($quiz_a1correct)){
		$nameError="quiz answer is required";
	}
	elseif(empty($quiz_q2)){
		$nameError="quiz question is required";
	}
	elseif(empty($quiz_a2correct)){
		$nameError="quiz answer is required";
	}
	elseif(empty($quiz_q3)){
		$nameError="quiz question is required";
	}
	elseif(empty($quiz_a3correct)){
		$nameError="quiz answer is required";
	}
	elseif(empty($quiz_q4)){
		$nameError="quiz question is required";
	}
	elseif(empty($quiz_a4correct)){
		$nameError="quiz answer is required";
	}
	elseif(empty($quiz_q5)){
		$nameError="quiz question is required";
	}
	elseif(empty($quiz_a5correct)){
		$nameError="quiz answer is required";
	}
	elseif(empty($quiz_q6)){
		$nameError="quiz question is required";
	}
	elseif(empty($quiz_a6correct)){
		$nameError="quiz answer is required";
	}
	elseif(empty($quiz_q7)){
		$nameError="quiz question is required";
	}
	elseif(empty($quiz_a7correct)){
		$nameError="quiz answer is required";
	}
	elseif(empty($quiz_q8)){
		$nameError="quiz question is required";
	}
	elseif(empty($quiz_a8correct)){
		$nameError="quiz answer is required";
	}
	elseif(empty($quiz_q9)){
		$nameError="quiz question is required";
	}
	elseif(empty($quiz_a9correct)){
		$nameError="quiz answer is required";
	}
	elseif(empty($quiz_q10)){
		$nameError="quiz question is required";
	}
	elseif(empty($quiz_a10correct)){
		$nameError="quiz answer is required";
	}
	elseif(empty($quiz_photo)){
		$coverError="quiz cover photo is required";
	}
	else{
		$quiz_name=trim($quiz_name);
		$quiz_name=htmlspecialchars($quiz_name);
		// name validation
		if(!preg_match("/^[a-zA-Z ]+$/",$quiz_name)){
			$nameError="<br>quiz name should only contain characters and space.";
		}
		else{
			$insert_query=mysqli_query($conn, "insert into quiz (quiz_subject,quiz_name,quiz_q1,quiz_a1correct,quiz_a1a,quiz_a1b,quiz_a1c,quiz_a1d,quiz_q2,quiz_a2correct,quiz_a2a,quiz_a2b,quiz_a2c,quiz_a2d,quiz_q3,quiz_a3correct,quiz_a3a,quiz_a3b,quiz_a3c,quiz_a3d,quiz_q4,quiz_a4correct,quiz_a4a,quiz_a4b,quiz_a4c,quiz_a4d,quiz_q5,quiz_a5correct,quiz_a5a,quiz_a5b,quiz_a5c,quiz_a5d,quiz_q6,quiz_a6correct,quiz_a6a,quiz_a6b,quiz_a6c,quiz_a6d,quiz_q7,quiz_a7correct,quiz_a7a,quiz_a7b,quiz_a7c,quiz_a7d,quiz_q8,quiz_a8correct,quiz_a8a,quiz_a8b,quiz_a8c,quiz_a8d,quiz_q9,quiz_a9correct,quiz_a9a,quiz_a9b,quiz_a9c,quiz_a9d,quiz_q10,quiz_a10correct,quiz_a10a,quiz_a10b,quiz_a10c,quiz_a10d,quiz_photo) values('$quiz_subject','$quiz_name','$quiz_q1','$quiz_a1correct','$quiz_a1a','$quiz_a1b','$quiz_a1c','$quiz_a1d','$quiz_q2','$quiz_a2correct','$quiz_a2a','$quiz_a2b','$quiz_a2c','$quiz_a2d','$quiz_q3','$quiz_a3correct','$quiz_a3a','$quiz_a3b','$quiz_a3c','$quiz_a3d','$quiz_q4','$quiz_a4correct','$quiz_a4a','$quiz_a4b','$quiz_a4c','$quiz_a4d','$quiz_q5','$quiz_a5correct','$quiz_a5a','$quiz_a5b','$quiz_a5c','$quiz_a5d','$quiz_q6','$quiz_a6correct','$quiz_a6a','$quiz_a6b','$quiz_a6c','$quiz_a6d','$quiz_q7','$quiz_a7correct','$quiz_a7a','$quiz_a7b','$quiz_a7c','$quiz_a7d','$quiz_q8','$quiz_a8correct','$quiz_a8a','$quiz_a8b','$quiz_a8c','$quiz_a8d','$quiz_q9','$quiz_a9correct','$quiz_a9a','$quiz_a9b','$quiz_a9c','$quiz_a9d','$quiz_q10','$quiz_a10correct','$quiz_a10a','$quiz_a10b','$quiz_a10c','$quiz_a10d','$quiz_photo')") or die("Insert query failed");
			if($insert_query){
				move_uploaded_file($quiz_photo_temp_name,$quiz_photo_folder);
				$display_message="quiz added successfully";
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
		<title>admin add quiz</title>
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
		<?php 
		include('../admin_header.php')
		?>

		<!-- form -->
		<section>
			<h3 class="heading">Add quiz</h3>
			<form action="" class="add_quizzes" method="post" enctype="multipart/form-data">
				<input type="text" name="quiz_subject" placeholder="Enter Subject" class="input_fields">
				<span><b><?php echo $subjectError?></b></span>
				<input type="text" name="quiz_name" placeholder="Enter Name" class="input_fields">
				<span><b><?php echo $nameError?></b></span>
				<input type="file" name="quiz_photo" placeholder="Insert Cover Photo" class="input_fields" accept="image/png, image/jpg, image/jpeg">
				<span><b><?php echo $imageError?></b></span>

				<label for="q1">Question 1</label>
				<input type="text" name="quiz_q1" placeholder="Enter Question 1" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="quiz_a1correct" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a1a" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a1b" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a1c" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a1d" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>

				<label for="q2">Question 2</label>
				<input type="text" name="quiz_q2" placeholder="Enter Question 2" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="quiz_a2correct" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a2a" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a2b" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a2c" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a2d" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>

				<label for="q3">Question 3</label>
				<input type="text" name="quiz_q3" placeholder="Enter Question 3" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="quiz_a3correct" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a3a" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a3b" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a3c" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a3d" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>

				<label for="q4">Question 4</label>
				<input type="text" name="quiz_q4" placeholder="Enter Question 4" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="quiz_a4correct" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a4a" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a4b" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a4c" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a4d" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>

				<label for="q5">Question 5</label>
				<input type="text" name="quiz_q5" placeholder="Enter Question 5" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="quiz_a5correct" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a5a" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a5b" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a5c" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a5d" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>

				<label for="q6">Question 6</label>
				<input type="text" name="quiz_q6" placeholder="Enter Question 6" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="quiz_a6correct" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a6a" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a6b" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a6c" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a6d" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>

				<label for="q7">Question 7</label>
				<input type="text" name="quiz_q7" placeholder="Enter Question 7" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="quiz_a7correct" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a7a" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a7b" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a7c" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a7d" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>

				<label for="q8">Question 8</label>
				<input type="text" name="quiz_q8" placeholder="Enter Question 8" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="quiz_a8correct" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a8a" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a8b" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a8c" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a8d" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>

				<label for="q9">Question 9</label>
				<input type="text" name="quiz_q9" placeholder="Enter Question 9" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="quiz_a9correct" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a9a" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a9b" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a9c" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a9d" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>

				<label for="q10">Question 10</label>
				<input type="text" name="quiz_q10" placeholder="Enter Question 10" class="input_fields">
				<span><b><?php echo $questionError?></b></span>
				<input type="text" name="quiz_a10correct" placeholder="Enter Correct Answer " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a10a" placeholder="Enter Answer A " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a10b" placeholder="Enter Answer B " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a10c" placeholder="Enter Answer C " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				<input type="text" name="quiz_a10d" placeholder="Enter Answer D " class="input_fields">
				<span><b><?php echo $answerError?></b></span>
				

				<input type="submit" name="add_quiz" class="submit_btn" value="Add quiz">
			</form>
		</section>
	</body>
</html>