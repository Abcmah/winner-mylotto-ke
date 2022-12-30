<?php
session_start();
if(isset($_SESSION['user']['is_authenticated'])){
    if($_SESSION['user']['is_authenticated']==1){
        if($_SESSION['user']['is_superuser']==1){
            include '../config/db.php';
            $winner_sql = "DELETE FROM winner
            WHERE id = ${_GET['winner']}";
           
            if (mysqli_query($conn, $winner_sql)) {
                $_SESSION['messages']['info']='This functionality is not available to all winners';
            echo "<script> location.href='/Admin/winners.php';</script>";
                } else {
                $_SESSION['messages']['danger']="Error deleting record: ${mysqli_error($conn)}";
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