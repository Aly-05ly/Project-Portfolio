<!-- Author: Amberly Loh Binti Mohd Azlan Loh
     Email: amberly456loh@gmail.com
 -->
     
<?php include '../admin_connect.php';

if(isset($_GET['delete'])){
	$delete_id=$_GET['delete'];
	echo $delete_id;
	$delete_query=mysqli_query($conn, "Delete from student where student_id=$delete_id")or die("Query failed");
	if($delete_query){
		echo "Student deleted";
		header('location:view_students.php');
	}else{
		echo "Failed to delete student";
	}
}
?>
