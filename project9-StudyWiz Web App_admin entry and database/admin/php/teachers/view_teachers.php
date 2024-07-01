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
		<title>admin view teacher</title>
		<link rel="stylesheet" href="../../css/admin.css">
		<link rel="stylesheet" href="../../css/admin_teachers.css">
		<!-- ICONS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	</head>
	<body>
		<?php 
		include('../admin_header.php')
		?>
			<section class="display_teachers">
				<section>
					<form action="" class="view_teachers" method="post">
						<div class="btns">
							<a href="add_teachers.php" type="submit" class="submit_btn">Add teachers</a>
						</div>
					</form>
				</section>

				<!-- display teachers -->
				 <?php 
				 $display_teachers=mysqli_query($conn,"select * from teacher");
				 $num=1;
				 if(mysqli_num_rows($display_teachers)>0){
					echo "
					<table>
						<thead>
							<th>No</th>
							<th>Profile Photo</th>
							<th>Username</th>
							<th>Email</th>
							<th>Password</th>
							<th>Class</th>
							<th>Action</th>
						</thead>
						<tbody>";
						while($row=mysqli_fetch_assoc($display_teachers)){
						?>

						<tr>
							<td><?php echo $num?></td>
							<td><img src="../../img/<?php echo $row['teacher_photo']?>" alt=<?php echo $row['teacher_name']?>></td>
							<td><?php echo $row['teacher_name']?></td>
							<td><?php echo $row['teacher_email']?></td>
							<td><?php echo $row['teacher_password']?></td>
							<td><?php echo $row['teacher_class']?></td>
							<td>
								<a href="delete_teachers.php?delete=<?php echo $row['teacher_id']; ?>" class="delete_teacher_btn" onclick="return confirm('Comfirm delete?');"><i class="fas fa-trash"></i></a>
								<a href="edit_teachers.php?edit=<?php echo $row['teacher_id']; ?>" class="edit_teacher_btn"><i class="fas fa-edit"></i></a>
							</td>
						</tr>
						<?php 
						$num++;
						
						}
				 }else{
					echo "<div class='empty_text'>No teacher available</div>";
				 }
				 ?>
				</tbody>
				</table>
			</section>

	</body>
</html>