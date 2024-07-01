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
							<a href="view_quizzes.php" type="submit" class="submit_btn">View quizzes</a>
						</div>
					</form>
				</section>

				<!-- display quizzes -->
				 <?php 
			if(isset($display_message)){
				echo " <div class='display_message'>
				<span>$display_message</span>
				<i class='fas fa-passwords' onclick='this.parentElement.style.display=`none`';></i>
			</div>";
			}
			?>
				<?php 
					if(isset($_GET['view'])){
						$view_id=$_GET['view'];
						$view_query=mysqli_query($conn,"Select * from quiz where quiz_id=$view_id");
						if(mysqli_num_rows($view_query)>0){
							$fetch_data=mysqli_fetch_assoc($view_query);
				
					echo "
					<table>
						<thead>
							<th>No</th>
							<th>Question</th>
							<th>Answer</th>
							<th>A</th>
							<th>B</>
							<th>C</>
							<th>D</>
						</thead>
						<tbody>";

						?>

						<tr>
							<td>1</td>
							<td><?php echo $fetch_data['quiz_q1']?></td>
							<td><?php echo $fetch_data['quiz_a1correct']?></td>
							<td><?php echo $fetch_data['quiz_a1a']?></td>
							<td><?php echo $fetch_data['quiz_a1b']?></td>
							<td><?php echo $fetch_data['quiz_a1c']?></td>
							<td><?php echo $fetch_data['quiz_a1d']?></td>
						</tr>
						<tr>
							<td>2</td>
							<td><?php echo $fetch_data['quiz_q2']?></td>
							<td><?php echo $fetch_data['quiz_a2correct']?></td>
							<td><?php echo $fetch_data['quiz_a2a']?></td>
							<td><?php echo $fetch_data['quiz_a2b']?></td>
							<td><?php echo $fetch_data['quiz_a2c']?></td>
							<td><?php echo $fetch_data['quiz_a2d']?></td>
						</tr>
						<tr>
							<td>3</td>
							<td><?php echo $fetch_data['quiz_q3']?></td>
							<td><?php echo $fetch_data['quiz_a3correct']?></td>
							<td><?php echo $fetch_data['quiz_a3a']?></td>
							<td><?php echo $fetch_data['quiz_a3b']?></td>
							<td><?php echo $fetch_data['quiz_a3c']?></td>
							<td><?php echo $fetch_data['quiz_a3d']?></td>
						</tr>
						<tr>
							<td>4</td>
							<td><?php echo $fetch_data['quiz_q4']?></td>
							<td><?php echo $fetch_data['quiz_a4correct']?></td>
							<td><?php echo $fetch_data['quiz_a4a']?></td>
							<td><?php echo $fetch_data['quiz_a4b']?></td>
							<td><?php echo $fetch_data['quiz_a4c']?></td>
							<td><?php echo $fetch_data['quiz_a4d']?></td>
						</tr>
						<tr>
							<td>5</td>
							<td><?php echo $fetch_data['quiz_q5']?></td>
							<td><?php echo $fetch_data['quiz_a5correct']?></td>
							<td><?php echo $fetch_data['quiz_a5a']?></td>
							<td><?php echo $fetch_data['quiz_a5b']?></td>
							<td><?php echo $fetch_data['quiz_a5c']?></td>
							<td><?php echo $fetch_data['quiz_a5d']?></td>
						</tr>
						<tr>
							<td>6</td>
							<td><?php echo $fetch_data['quiz_q6']?></td>
							<td><?php echo $fetch_data['quiz_a6correct']?></td>
							<td><?php echo $fetch_data['quiz_a6a']?></td>
							<td><?php echo $fetch_data['quiz_a6b']?></td>
							<td><?php echo $fetch_data['quiz_a6c']?></td>
							<td><?php echo $fetch_data['quiz_a6d']?></td>
						</tr>
						<tr>
							<td>7</td>
							<td><?php echo $fetch_data['quiz_q7']?></td>
							<td><?php echo $fetch_data['quiz_a7correct']?></td>
							<td><?php echo $fetch_data['quiz_a7a']?></td>
							<td><?php echo $fetch_data['quiz_a7b']?></td>
							<td><?php echo $fetch_data['quiz_a7c']?></td>
							<td><?php echo $fetch_data['quiz_a7d']?></td>
						</tr>
						<tr>
							<td>8</td>
							<td><?php echo $fetch_data['quiz_q8']?></td>
							<td><?php echo $fetch_data['quiz_a8correct']?></td>
							<td><?php echo $fetch_data['quiz_a8a']?></td>
							<td><?php echo $fetch_data['quiz_a8b']?></td>
							<td><?php echo $fetch_data['quiz_a8c']?></td>
							<td><?php echo $fetch_data['quiz_a8d']?></td>
						</tr>
						<tr>
							<td>9</td>
							<td><?php echo $fetch_data['quiz_q9']?></td>
							<td><?php echo $fetch_data['quiz_a9correct']?></td>
							<td><?php echo $fetch_data['quiz_a9a']?></td>
							<td><?php echo $fetch_data['quiz_a9b']?></td>
							<td><?php echo $fetch_data['quiz_a9c']?></td>
							<td><?php echo $fetch_data['quiz_a9d']?></td>
						</tr>
						<tr>
							<td>10</td>
							<td><?php echo $fetch_data['quiz_q10']?></td>
							<td><?php echo $fetch_data['quiz_a10correct']?></td>
							<td><?php echo $fetch_data['quiz_a10a']?></td>
							<td><?php echo $fetch_data['quiz_a10b']?></td>
							<td><?php echo $fetch_data['quiz_a10c']?></td>
							<td><?php echo $fetch_data['quiz_a10d']?></td>
						</tr>
				</tbody>
				</table>
			</section>
			<?php
			}
		}
			
			?>
	</body>
</html>