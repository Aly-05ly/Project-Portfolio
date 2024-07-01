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
		<title>admin view student</title>
		<link rel="stylesheet" href="../../css/admin.css">
		<link rel="stylesheet" href="../../css/admin_students.css">
		<!-- ICONS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	</head>
	<body>
		<?php 
		include('../admin_header.php')
		?>

		<div class="container">
			<section class="display_students">
				<section>
					<form action="" class="view_students" method="post">
						<div class="btns">
							<a href="add_students.php" type="submit" class="submit_btn">Add Students</a>
						</div>
					</form>
				</section>

				<!-- display students -->
				 <?php 
				 $display_students=mysqli_query($conn,"select * from student");
				 $num=1;
				 if(mysqli_num_rows($display_students)>0){
					echo "
					<table>
						<thead>
							<th>No</th>
							<th>Profile Photo</th>
							<th>Username</th>
							<th>Email</th>
							<th>Password</th>
							<th>School</th>
							<th>Action</th>
						</thead>
						<tbody>";
						while($row=mysqli_fetch_assoc($display_students)){
						?>

						<tr>
							<td><?php echo $num?></td>
							<td><img src="../../img/<?php echo $row['student_photo']?>" alt=<?php echo $row['student_name']?>></td>
							<td><?php echo $row['student_name']?></td>
							<td><?php echo $row['student_email']?></td>
							<td><?php echo $row['student_password']?></td>
							<td><?php echo $row['student_school']?></td>
							<td>
								<a href="delete_students.php?delete=<?php echo $row['student_id']; ?>" class="delete_student_btn" onclick="return confirm('Comfirm delete?');"><i class="fas fa-trash"></i></a>
								<a href="edit_students.php?edit=<?php echo $row['student_id']; ?>" class="edit_student_btn"><i class="fas fa-edit"></i></a>
							</td>
						</tr>
						<?php 
						$num++;
						
						}
				 }else{
					echo "<div class='empty_text'>No student available</div>";
				 }
				 ?>
				</tbody>
				</table>
			</section>
		</div>
	</body>
</html>