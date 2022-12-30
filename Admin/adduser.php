<?php

session_start();
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

// get user
$users = 0;
if(isset($_GET['edit'])){
  $user_sql = "SELECT name, email, is_staff, is_superuser FROM user  WHERE id = ${_GET['user']}";
  $users = mysqli_query($conn,$user_sql);
  if($users->num_rows < 0){
    $_SESSION['messages']['danger'] ="something went wrong";
  }
}
// update
if(isset($_POST['update'])){
  $name = mysqli_real_escape_string($conn,$_POST['name']) ;
  $is_superuser = mysqli_real_escape_string($conn, isset($_POST['is_superuser']) ? $_POST['is_superuser'] : 0);
  $is_staff = mysqli_real_escape_string($conn, isset($_POST['is_staff']) ? $_POST['is_staff'] : 0);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  
  $user_update_sql = "UPDATE user SET name = '$name',is_superuser = '$is_superuser', is_staff = '$is_staff', email = '$email' WHERE id = ${_GET['user']}";
  if(mysqli_query($conn,$user_update_sql) > 0){
    $_SESSION['messages']['success'] ="added";
    echo "<script> location.href='/Admin/users.php';</script>";
  }else{
    $_SESSION['messages']['danger'] ="something went wrong";
  }
}

if(isset($_POST['submit'])){
$name = mysqli_real_escape_string($conn,$_POST['name']) ;
$is_superuser = mysqli_real_escape_string($conn, isset($_POST['is_superuser']) ? $_POST['is_superuser'] : 0);
$is_staff = mysqli_real_escape_string($conn, isset($_POST['is_staff']) ? $_POST['is_staff'] : 0);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password_h = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO `user` (name,is_staff,is_superuser,email,username,password)
VALUES('$name',$is_staff,$is_superuser,'$email','$name','$password_h')";
if(mysqli_query($conn,$sql) > 0){
  echo "<script> location.href='/Admin/users.php';</script>";
  $_SESSION['messages']['success'] ="added";
}else{
  $_SESSION['messages']['danger'] ="something went wrong";
  echo "erro";
}
}


$conn->close();
?>

<?php if(isset($_SESSION['user']['is_authenticated'])):
  if($_SESSION['user']['is_authenticated'] == 1):
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Admin Add winner | Lotto</title>
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
          <div class="title my-4">Users Information</div>
          
          <div class="sales-details">
            <?php if(!isset($_GET['edit'])):?>
          <form class="row g-3" action=""  method="post">
<!-- form -->
<div class="col-md-6">
    <label for="inputEmail4" class="form-label">Name</label>
    <input class="form-control" type="text" name="name" id="">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Email</label>
    <input class="form-control" type="email" required name="email">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Is staff</label>
    <input type="checkbox" name="is_staff" value="1">
  </div>
  <div class="col-md-6">
    <label for="inputZip" class="form-label">Is superuser</label>
    <input type="checkbox" name="is_superuser" value="1">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Password</label>
    <input class="form-control" type="password" name="password">
  </div>
  <div class="col-6">
    <label for="inputAddress" class="form-label">Confirm password</label>
    <input class="form-control" type="password" name="cpassword">
  </div>

   <div class="col-12">
    <button type="submit" name="submit" class="btn btn-primary">Add</button>
  </div>
                    </form>
                   <?php else: ?>
                    <?php foreach($users as $user): ?>
                    <form class="row g-3" action=""  method="post">
<!-- form -->
<div class="col-md-6">
    <label for="inputEmail4" class="form-label">Name</label>
    <input class="form-control" value="<?php echo $user['name'] ?>"  type="text" name="name" id="">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Email</label>
    <input class="form-control" value="<?php echo $user['email'] ?>" type="email" required name="email">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Is staff</label>
    <input type="checkbox" <?php echo $user['is_staff'] == '1' ? 'checked' : '';?> name="is_staff" value="1">
  </div>
  <div class="col-md-6">
    <label for="inputZip" class="form-label">Is superuser</label>
    <input  type="checkbox" name="is_superuser" <?php echo $user['is_superuser'] == '1' ? 'checked' : '';?>  value="1">
  </div>
  
 
   <div class="col-12">
    <button type="submit" name="update" class="btn btn-primary">Update</button>
  </div>
                    </form>
                    <?php endforeach; ?>
                    <?php endif; ?>
          </div>
          
        </div>

        <div class="top-sales box">
          <div class="title">Additional</div>
          <ul class="top-sales-details">
            <?php if(isset($_GET['edit'])):?>
          <li>
            <a href="changepassword.php?user=<?php echo $_GET['user']?>&edit=true">
              <span style="font-size:20px;">

                <i class='bx bx-lock'></i>
              </span>
              <span class="product">Change password</span>
            </a>
          </li>
          <?php endif;?>
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