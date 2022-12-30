<?php
session_start();
if(isset($_SESSION['user']['is_authenticated'])){
    if($_SESSION['user']['is_authenticated']==1){
        if($_SESSION['user']['is_superuser']==1){
            include '../config/db.php';
            $user_sql = "DELETE FROM user
            WHERE id = ${_GET['user']}";
            if($_SESSION['user']['userid'] != $_GET['user']){
                if (mysqli_query($conn, $user_sql)) {
                    $_SESSION['messages']['info']='This functionality is not available to all users';
                echo "<script> location.href='/Admin/users.php';</script>";
                  } else {
                    $_SESSION['messages']['danger']="Error deleting record: ${mysqli_error($conn)}";
                  }
            }else{
                $_SESSION['messages']['danger']='You can not delete yourself';
                echo "<script> location.href='/Admin/users.php';</script>";
            }
           
            $conn->close();
        }else{
            $_SESSION['messages']['danger']='You are not authorised to delete';
            $_SESSION['messages']['danger']='You are not authorised to delete';
            echo "<script> location.href='/Admin/users.php';</script>";
        }
        
        
    }
    else{
        echo "<script> location.href='/login.php';</script>";
        $_SESSION['messages']['danger']='You are not authorised to delete';
    }
 
}
else{
    $_SESSION['messages']['danger']='You are not authorised to delete';
    echo "<script> location.href='/login.php';</script>";
}
?>