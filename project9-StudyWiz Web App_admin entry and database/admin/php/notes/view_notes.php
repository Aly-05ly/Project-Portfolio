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
		<title>admin view note</title>
		<link rel="stylesheet" href="../../css/admin.css">
		<link rel="stylesheet" href="../../css/admin_note.css">
		<!-- ICONS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
	</head>
	<body>
		<?php 
		include('../admin_header.php')
		?>
			<section class="display_notes">
				<section>
					<form action="" class="view_notes" method="post">
						<div class="btns">
							<a href="add_notes.php" type="submit" class="submit_btn">Add notes</a>
						</div>
					</form>
				</section>

				<!-- display notes -->
				 <?php 
				 $display_notes=mysqli_query($conn,"select * from note");
				 $num=1;
				 if(mysqli_num_rows($display_notes)>0){
					echo "
					<table>
						<thead>
							<th>No</th>
							<th>Cover Photo</th>
							<th>Name</th>
							<th>Subject</th>
							<th>Teacher ID</th>
							<th>Description</th>
							<th>File</th>
							<th>Action</th>   
						</thead>
						<tbody>";
						while($row=mysqli_fetch_assoc($display_notes)){
						?>

						<tr>
							<td><?php echo $num?></td>
							<td><img src="../../img/<?php echo $row['note_cover']?>" alt=<?php echo $row['note_name']?>></td>
							<td><?php echo $row['note_name']?></td>
							<td><?php echo $row['note_subject']?></td>
							<td><?php echo $row['note_teacher_id']?></td>
							<td><?php echo $row['note_desc']?></td>
							<td><?php echo $row['note_file']?></td>
							<td>
								<a href="delete_notes.php?delete=<?php echo $row['note_id']; ?>" class="delete_note_btn" onclick="return confirm('Comfirm delete?');"><i class="fas fa-trash"></i></a>
								<a href="edit_notes.php?edit=<?php echo $row['note_id']; ?>" class="edit_note_btn"><i class="fas fa-edit"></i></a>
							</td>
						</tr>
						<?php 
						$num++;
						
						}
				 }else{
					echo "<div class='empty_text'>No note available</div>";
				 }
				 ?>
				</tbody>
				</table>
			</section>
	</body>
</html>