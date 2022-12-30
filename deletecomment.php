<?php
session_start();
if(isset($_SESSION['user']['is_authenticated'])){
    if($_SESSION['user']['is_authenticated']==1){
        include 'config/db.php';
        $comment_sql = "DELETE FROM comment
        WHERE id = ${_GET['comment']}";
        if (mysqli_query($conn, $comment_sql)) {
            $_SESSION['messages']['success']='deleted';
        echo "<script> location.href='winner.php?winner=${_GET['winner']}';</script>";
          } else {
            $_SESSION['messages']['danger']="Error deleting record: ${mysqli_error($conn)}";
          }
    }else{
    echo "<script>location.href='login.php';</script>";
    }

}else{
    echo "<script>location.href='login.php';</script>";
}
?>