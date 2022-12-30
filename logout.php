<?php
session_start();
if($_SESSION['user']['is_authenticated']){
    unset($_SESSION['user']);
    echo "<script>location.href='index.php';</script>";
    $_SESSION['user']['is_authenticated'] = 0;
    $_SESSION['user']['is_staff'] = 0;
    $_SESSION['user']['username'] = "";
    $_SESSION['user']['is_superuser'] = 0;
    $_SESSION['user']['userid'] = 0;
    $_SESSION['messages']['info'] = "you are logged out";
}
else{
    echo "<script>location.href='index.php';</script>";
    $_SESSION['messages']['danger'] = "You can not logout because you are not login";
}
?>