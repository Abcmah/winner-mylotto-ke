<?php
session_start();
// number of records
$records_per_page = 20;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $records_per_page;
include '../config/db.php';
include '../config/functions.php';
$winner_sql = "SELECT campaign_name, winner_name, award FROM winner ORDER BY date DESC LIMIT $offset,$records_per_page";

$resql = "SELECT campaign_name FROM winner";
$winners = getInfo($winner_sql);
$allwinners = mysqli_query($conn, $resql);
$total_records = mysqli_num_rows($allwinners);
$total_pages = ceil($total_records / $records_per_page);
$conn->close();
?>
<?php if(isset($_SESSION['user']['is_authenticated'])):
  if($_SESSION['user']['is_authenticated'] == 1):
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Lotto </title>

    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="../asserts/bootstrap.css">
    <link rel="stylesheet" href="style.css">
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
          <div class="title">Recent Winners</div>
          
          <div class="sales-details">
          <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Campaign name</th>
      <th scope="col">winner</th>
      <th scope="col">Price</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($winners as $winner): ?>
    <tr>
      <td><?php echo $winner['campaign_name'] ?></td>
      <td><?php echo $winner['winner_name'] ?></td>
      <td><?php echo $winner['award'] ?></td>
    </tr>
    <?php endforeach; ?> 
  
  </tbody>
</table>

</div>
<div class="container">
<div class="blog-pagination ">
              <div aria-label="...">
                  <ul class="pagination">
                    <?php 
                    if($page <= 1){
                      echo " <li class='page-item disabled'>
                      <a class='page-link'>Previous</a>
                    </li>";
                    }else{
                      $page = $page - 1;
                      echo "<li class='page-item'>
                      <a href='index.php?page=$page' class='page-link'>Previous</a>
                    </li>";
                    }
                    ?>
                   
                    <li class="page-item"><a class="page-link" href="index.php?page=1">1</a></li>
                    <li class="page-item active" aria-current="page">
                      <a class="page-link" href="index.php?page=2">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="index.php?page=3">3</a></li>

                      <?php 
                      $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                      // $page = $_GET['page'] + 1;
                      $page = $page + 1;
                    if($total_pages < $page ){
                      echo " <li class='page-item disabled'>
                      <a class='page-link'>Next</a>
                    </li>";
                    }else{
                      
                      echo "<li class='page-item'>
                      <a href='index.php?page=${page}' class='page-link'>Next</a>
                    </li>";
                    }
                    ?>
                  </ul>
                </div>
          </div>
</div>
        
          <div class="button">
            <a href="winners.php">See All</a>
          </div>
        </div>

        <div class="top-sales box">
          <div class="title">Jackpot Winners</div>
          <ul class="top-sales-details">
        
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