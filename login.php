<?php 
session_start();
include 'config/functions.php';

if(isset($_POST['loginUser'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  if(authenticate($email, $password)==1){
   
    echo '<script> location.href="Admin"</script>';
    $_SESSION['messages']['success'] = "Welcome you are login";
  }
  $_SESSION['messages']['danger'] = "Incorrect Email or Password";
}
if(isset($_SESSION['user']['is_authenticated'])){
  if($_SESSION['user']['is_authenticated']==1){
    $_SESSION['messages']['success'] = "You are already logged in";
    echo '<script> location.href="Admin"</script>';
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Lotto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="login.css">
</head>
<body class="text-center">
  <div class="popup">
    <?php include 'messages.php' ?>   
</div>
    <main class="form-signin w-100 m-auto">
      <form action="" method="post">
        <img class="mb-4" src="img/static/logo.png" alt="" width="200" height="90">
        <h1 class="h3 mb-3 fw-normal">Please login</h1>
    
        <div class="form-floating">
          <input required type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
          <label for="floatingInput">Email address</label>
        </div>
        <div class="form-floating">
          <input required type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Password</label>
        </div>
    
        <button name="loginUser" class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-4">or</p>
        <a href="">Sign up</a>
      </form>
    </main>
    <?php  unset($_SESSION['messages']);?>
      </body>
</html>