<?php
session_start();
include '../config/db.php';
include '../config/functions.php';
// number of records
$records_per_page = 20;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$offset = ($page - 1) * $records_per_page;
$winner_sql = "SELECT id, winner_name, campaign_name, title, award, date FROM winner ORDER BY date DESC LIMIT $offset, $records_per_page";
$resql = "SELECT award FROM winner";
$winners = getInfo($winner_sql);
$allwinners = mysqli_query($conn, $resql);
$total_records = mysqli_num_rows($allwinners);
$total_pages = ceil($total_records / $records_per_page);
?>
<?php if(isset($_SESSION['user']['is_authenticated'])):
  if($_SESSION['user']['is_authenticated'] == 1):
  ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Admin Dashboard | Lotto </title>
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
          <div class="d-flex justify-content-between">
          <div class="title">All Winners</div>
          <div><a style="border-radius:20px;cursor:pointer" class="btn btn-primary px-3" href="addwinner.php"><i class='bx bx-plus' ></i> Add</a></div>
          </div>
          
          <div class="sales-details">
          <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Campaign name</th>
      <th scope="col">winner</th>
      <th scope="col">Price</th>
      <th scope="col">#</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($winners as $winner): ?>
    <tr>
      <td><?php echo $winner['campaign_name'] ?></td>
      <td><a href="addwinner.php?winner=<?php echo $winner['id']?>&edit=true"><?php echo $winner['winner_name'] ?></a> </td>
      <td><?php echo $winner['award'] ?></td>
      <td><a style="font-size:25px; color:#d63f3f;" href="deletewinner.php?winner=<?php echo $winner['id']?>"> <i class='bx bx-x'></i> </a></td>
    </tr>
    <?php endforeach; ?> 
  </tbody>
</table>
          </div>
          <!-- pagination -->
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
                      <a href='winners.php?page=$page' class='page-link'>Previous</a>
                    </li>";
                    }
                    ?>
                   
                    <li class="page-item<?php echo $page == 0 ? ' actve' : ''; ?>"><a class="page-link" href="winners.php?page=1">1</a></li>
                    <li class="page-item<?php echo $page == 1 ? ' actve' : ''; ?>" aria-current="page">
                      <a class="page-link" href="winners.php?page=2">2</a>
                    </li>
                    <li class="page-item<?php echo $page == 2 ? ' active' : ''; ?>"><a class="page-link" href="winners.php?page=3">3</a></li>

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
                      <a href='winners.php?page=${page}' class='page-link'>Next</a>
                    </li>";
                    }
                    ?>
                  </ul>
                </div>
          </div>
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