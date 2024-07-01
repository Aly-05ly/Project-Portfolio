<!-- Author: Amberly Loh Binti Mohd Azlan Loh
	 subject: amberly456loh@gmail.com
 -->

<?php 
// variables
$nameError="";
$subjectError="";
$idError="";
$descError="";
$fileError="";
$imageError="";

include '../admin_connect.php';
if(isset($_POST['add_note'])){
	// get data entered and store in variable
	$note_name=$_POST['note_name'];
	$note_subject=$_POST['note_subject'];
	$note_teacher_id=$_POST['note_teacher_id'];
	$note_desc=$_POST['note_desc'];
	$note_file=$_FILES['note_file']['name'];
	$note_file_temp_name=$_FILES['note_file']['tmp_name'];
	$note_file_folder='../../img/'.$note_file;
	$note_cover=$_FILES['note_cover']['name'];
	$note_cover_temp_name=$_FILES['note_cover']['tmp_name'];
	$note_cover_folder='../../img/'.$note_cover;

	// validations
	if(empty($note_name)){
		$nameError="Note name is required";
	}
	elseif(empty($note_subject)){
		$subjectError="Note subject is required";
	}
	elseif(empty($note_teacher_id)){
		$teacherError="Note teacher id is required";
	}
	elseif(empty($note_desc)){
		$descError="Note description is required";
	}
	elseif(empty($note_file)){
		$fileError="Note file is required";
	}
	elseif(empty($note_cover)){
		$fileError="Note cover photo is required";
	}
	else{

			$insert_query=mysqli_query($conn, "insert into note (note_name,note_subject,note_teacher_id,note_desc,note_file,note_cover) values('$note_name','$note_subject','$note_teacher_id','$note_desc','$note_file','$note_cover')") or die("Insert query failed");
			if($insert_query){
				move_uploaded_file($note_file_temp_name,$note_file_folder);
				move_uploaded_file($note_cover_temp_name,$note_cover_folder);
				$display_message="Note added successfully";
			}
			else{
				$display_message="Error occured when inserting file";
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
		<link rel="stylesheet" href="../../css/admin_note.css">
		<!-- ICONS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	</head>
	<body>
		<?php 
		include('../admin_header.php')
		?>

		<!-- form -->
		<section>
			<h3 class="heading">Add note</h3>
			<form action="" class="add_notes" method="post" enctype="multipart/form-data">
				<input type="text" name="note_name" placeholder="Enter Name" class="input_fields">
				<span><b><?php echo $nameError?></b></span>
				<input type="text" name="note_subject" placeholder="Enter Subject" class="input_fields">
				<span><b><?php echo $subjectError?></b></span>
				<input type="text" name="note_desc" placeholder="Enter Description" class="input_fields">
				<span><b><?php echo $descError?></b></span>
				<label>Select Teacher</label>
				<select name="note_teacher_id" class="input_fields">
				<?php 
				$display_id=mysqli_query($conn,"Select * from teacher");
				$num=1;
				if(mysqli_num_rows($display_id)>0){
					while ($row=mysqli_fetch_assoc($display_id)){
				?>
					<option value="<?php echo $row['teacher_id']?>"><?php echo $row['teacher_id']?> - <?php echo $row['teacher_name']?></option>
				<?php
				$num++;
					}		
				}else{
					echo "<div class='empty_text'>No tickets available</div>";
				}?>
				</select>
				<span><b><?php echo $idError?></b></span>
				<label>Add Note File</label>
				<input type="file" name="note_file" placeholder="Insert File" class="input_fields" accept=".doc,.docx,.pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" >
				<span><b><?php echo $fileError?></b></span>
				<label>Add Cover Photo</label>
				<input type="file" name="note_cover" placeholder="Insert Cover Photo" class="input_fields" accept="image/png, image/jpg, image/jpeg" >
				<span><b><?php echo $imageError?></b></span>
				<input type="submit" name="add_note" class="submit_btn" value="Add note">
			</form>
		</section>
	</body>
</html>