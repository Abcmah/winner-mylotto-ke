<?php

session_start();
if(isset($_POST['update'])){
  $servername = "localhost";
  $username = "root";
  $password = "swafi";
  $DB_NAME = "db_winner";
  // Create connection
  $conn = new mysqli($servername, $username, $password,$DB_NAME);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $password = mysqli_real_escape_string($conn,$_POST['password']);
  $password_hash = password_hash($password, PASSWORD_DEFAULT);
  $user_update_sql = "UPDATE user SET password = '$password_hash' WHERE id = ${_GET['user']}";
  if(mysqli_query($conn,$user_update_sql) > 0){
    $_SESSION['messages']['success'] ="password changed";
    echo "<script> location.href='/Admin/users.php';</script>";
  }else{
    $_SESSION['messages']['danger'] ="something went wrong";
  }
  $conn->close();
}

?>

<?php if(isset($_SESSION['user']['is_authenticated'])):
  if($_SESSION['user']['is_authenticated'] == 1):
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Change password | Lotto</title>
        <!-- CSS only -->
    <link rel="stylesheet" href="../asserts/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

     <meta name="viewport" content="width=device-width, initial-scale=1.0">
 


   </head>
<body>
  <!-- sidebar goes here -->
<?php include 'sidebar.php'?>

  <section class="home-section">
    <!-- nav goes here -->
    <?php include 'nav.php'?>
    <div class="home-content">
    <?php include '../messages.php'?>
      <div class="overview-boxes">
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Winners</div>
            <div class="number">40,876</div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Since started</span>
            </div>
          </div>
          <i class='bx bx-cart-alt cart'></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Winners</div>
            <div class="number">38,876</div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bxs-cart-add cart two' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Profit</div>
            <div class="number">$12,876</div>
            <div class="indicator">
              <i class='bx bx-up-arrow-alt'></i>
              <span class="text">Up from yesterday</span>
            </div>
          </div>
          <i class='bx bx-cart cart three' ></i>
        </div>
        <div class="box">
          <div class="right-side">
            <div class="box-topic">Total Return</div>
            <div class="number">11,086</div>
            <div class="indicator">
              <i class='bx bx-down-arrow-alt down'></i>
              <span class="text">Down From Today</span>
            </div>
          </div>
          <i class='bx bxs-cart-download cart four' ></i>
        </div>
      </div>

      <div class="sales-boxes">
        <div class="recent-sales box">
          <div class="title my-4">Change password</div>
          
          <div class="sales-details">
            <?php if(!isset($_GET['edit'])):?>
              <p>error loading the page</p>
                   <?php else: ?>
                   
                    <form class="row g-3" action=""  method="post">
<!-- form -->
<div class="col-md-6">
    <label for="inputEmail4" class="form-label">new password</label>
    <input class="form-control pass" required type="password" name="password">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Confirm password</label>
    <input class="form-control cpass"  type="password" required name="cpassword">
    <div class='mess'></div>
  </div>
  
   <div class="col-12">
    <button type="submit" name="update" disabled class="btn btn-primary update">Update</button>
  </div>
                    </form>
              
                    <?php endif; ?>
          </div>
          
        </div>

        <div class="top-sales box">
          <div class="title">Additional</div>
          <ul class="top-sales-details">
          
          </ul>
        </div>
      </div>
    </div>
    <?php  unset($_SESSION['messages']);?>
  </section>

  <script>
   let sidebar = document.querySelector(".Sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
  sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");

}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
}

// password
let pass = document.querySelector(".pass");
let cpass = document.querySelector(".cpass");
let mess = document.querySelector(".mess");
const updatebtn = document.querySelector(".update");
cpass.addEventListener('keyup',()=>{
  if(pass.value != cpass.value){
    mess.innerHTML = 'password do not match';
    cpass.style.border = '1px solid red';
    updatebtn.disabled = true;
  }else{
    cpass.style.border = '1px solid green';
    updatebtn.disabled = false;
    mess.innerHTML = '';
  }
})
 </script>

</body>
</html>
<?php else:
  $_SESSION['messages']['danger'] = "you must login to access admin page";
  echo '<script> location.href="/login.php"</script>';
  ?>
  <h1>sdd</h1>
<?php endif;?>
<?php endif;?>