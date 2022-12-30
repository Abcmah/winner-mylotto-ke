<?php
session_start();
include '../config/db.php';
include '../config/functions.php';
$winner_sql = "SELECT * FROM user";
$winners = getInfo($winner_sql);
$conn->close();
?>
<?php if(isset($_SESSION['user']['is_authenticated'])):
  if($_SESSION['user']['is_authenticated'] == 1):
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Users | Lotto </title>
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
      <div class="overview-boxes">
      <?php include '../messages.php'?>
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
          <div class="d-flex justify-content-between">
          <div class="title">All users</div>
          <div><a style="border-radius:20px;cursor:pointer" class="btn btn-primary px-3" href="adduser.php"><i class='bx bx-plus' ></i> Add user</a></div>
          </div>
          
          <div class="sales-details">
          <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Is_superuser</th>
      <th scope="col">is_staff</th>
      <th scope="col">#</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($winners as $winner): ?>
    <tr>
   
      <td><?php echo $winner['name'] ?></td>
      <td> <a href="adduser.php?user=<?php echo $winner['id']?>&edit=true"><?php echo $winner['email']?></a></td>
      <td><?php echo $winner['is_superuser'] ?></td>
      <td><?php echo $winner['is_staff'] ?></td>
      <td><a style="font-size:25px; color:#d63f3f;" href="deleteuser.php?user=<?php echo $winner['id']?>"> <i class='bx bx-x'></i> </a></td>
    </tr>
    <?php endforeach; ?> 
  </tbody>
</table>
          </div>
          
        </div>

        <div class="top-sales box">
          <div class="title">Super users</div>
          <ul style="padding-left:0px" class="top-sales-details">
          <?php foreach($winners as $winner): ?>
          <?php if($winner['is_superuser'] == 1 && $winner['id'] != $_SESSION['user']['userid']): ?>

            <li>
            <a href="#">
              <img src="images/sunglasses.jpg" alt="">
              <span class="product"><?php echo $winner['email'] ?></span>
            </a>
            <span class="price">$1107</span>
          </li>
            
          <?php endif; ?> 
          <?php endforeach; ?> 
          </ul>
        </div>
      </div>
    </div>
    <?php  unset($_SESSION['messages']);?>
  </section>

  <script>
   let sidebar = document.querySelector(".sidebar");
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