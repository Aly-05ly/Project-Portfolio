<!-- Author: Amberly Loh Binti Mohd Azlan Loh
     Email: amberly456loh@gmail.com
 -->
     
<?php include '../admin_connect.php'?>

<!DOCTYPE html>
<html lang="en">
	<!-- 1. HEAD -->
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>admin view quiz</title>
		<link rel="stylesheet" href="../../css/admin.css">
		<link rel="stylesheet" href="../../css/admin_quizzes.css">
		<!-- ICONS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	</head>
	<body>
		<?php 
		include('../admin_header.php')
		?>
			<section class="display_quizzes">
				<section>
					<form action="" class="view_quizzes" method="post">
						<div class="btns">
							<a href="add_quizzes.php" type="submit" class="submit_btn">Add quizzes</a>
						</div>
					</form>
				</section>

				<!-- display quizzes -->
				 <?php 
				 $display_quizzes=mysqli_query($conn,"select * from quiz");
				 $num=1;
				 if(mysqli_num_rows($display_quizzes)>0){
					echo "
					<table>
						<thead>
							<th>No</th>
							<th>Cover Photo</th>
							<th>Name</th>
							<th>Subject</th>
							<th>View</>
							<th>Action</th>
						</thead>
						<tbody>";
						while($row=mysqli_fetch_assoc($display_quizzes)){
						?>

						<tr>
							<td><?php echo $num?></td>
							<td><img src="../../img/<?php echo $row['quiz_photo']?>" alt=<?php echo $row['quiz_name']?>></td>
							<td><?php echo $row['quiz_name']?></td>
							<td><?php echo $row['quiz_subject']?></td>
							<td><a href="view_question.php?view=<?php echo $row['quiz_id'];?>">View</a></td>
							<td>
								<a href="delete_quizzes.php?delete=<?php echo $row['quiz_id']; ?>" class="delete_quiz_btn" onclick="return confirm('Comfirm delete?');"><i class="fas fa-trash"></i></a>
								<a href="edit_quizzes.php?edit=<?php echo $row['quiz_id']; ?>" class="edit_quiz_btn"><i class="fas fa-edit"></i></a>
							</td>
						</tr>
						<?php 
						$num++;
						
						}
				 }else{
					echo "<div class='empty_text'>No quiz available</div>";
				 }
				 ?>
				</tbody>
				</table>
			</section>
	</body>
</html>