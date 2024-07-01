<!-- Author: Amberly Loh Binti Mohd Azlan Loh
     Email: amberly456loh@gmail.com
 -->
     
<?php include '../admin_connect.php';

if(isset($_GET['delete'])){
	$delete_id=$_GET['delete'];
	echo $delete_id;
	$delete_query=mysqli_query($conn, "Delete from quiz where quiz_id=$delete_id")or die("Query failed");
	if($delete_query){
		echo "Quiz deleted";
		header('location:view_quizzes.php');
	}else{
		echo "Failed to delete quiz";
	}
}
?>
