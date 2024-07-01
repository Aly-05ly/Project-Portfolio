<?php
session_start();
include "admin_connect.php";
if(isset($_POST['admin_username']) && isset($_POST['admin_password'])){
    
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $admin_username = validate($_POST['admin_username']);
    $admin_password = validate($_POST['admin_password']);

    if(empty($admin_username)){
        header("Location: admin_login.php?error= Admin name is required.");
        exit();

    }else if(empty($admin_password)){
        header("Location: admin_login.php?error= admin password is required.");
        exit();
    }else{
        $sql = "SELECT * FROM admin WHERE admin_username = '$admin_username' AND admin_password= '$admin_password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['admin_username'] === $admin_username && $row['admin_password'] === $admin_password){
                //echo "Login success.";
                $SESSION['admin_username']= $row['admin_username'];
                $SESSION['admin_id']= $row['admin_id'];
                $SESSION['admin_name']= $row['admin_name'];
                header("Location: notes/view_notes.php");

            }else{
                header("Location: admin_login.php?error= Incorrect Admin Name or admin password.");
                exit();

        }
        }else{
            header("Location: admin_login.php?error= Incorrect Admin Name or admin password.");
            exit();

        }
    }

}else{
    header("Location: admin_login.php");
    exit;
}