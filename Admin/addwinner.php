<?php
session_start();
include '../config/db.php';
include '../config/functions.php';

$to_upload = 1;
$imgdir = 'img/uploads/';
if(isset($_POST['submit'])){
  $campaign_name = $_POST['campaign_name'];
  $title = $_POST['title'];
  $winner_name = $_POST['winner_name'];
  $winner_photo = $imgdir . basename($_FILES["winner_photo"]["name"]);
  $about_winner = $_POST['about_winner'];
  $winner_quote = $_POST['winner_quote'];
  $winner_award = $imgdir . basename($_FILES["winner_award"]["name"]);
  $award_description = $_POST['photo_description'];
  $winner_story = $_POST['winner_story'];
  $region = $_POST['region'];
  $date = $_POST['date_won'];
  $amount = $_POST['amount'];
  $author_id = $_SESSION['user']['userid'];
  $award = $_POST['award'];
  // Check if file already exists
  if (file_exists($winner_photo) || file_exists($winner_award)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  if($to_upload == 1){
    move_uploaded_file($_FILES["winner_photo"]["tmp_name"], $winner_photo);
    move_uploaded_file($_FILES["winner_award"]["tmp_name"], $winner_award);
  }else{
    echo "something went wrong";
  }
  
// TO DATABASE
$winner_sql_q = "INSERT INTO winner(campaign_name, title, winner_name, winner_photo,about_winner,winner_quote, winner_award,amount, award_description, winner_story, author_id, award, date)
VALUES('$campaign_name', '$title', '$winner_name','$winner_photo','$about_winner','$winner_quote','$winner_award','$amount',
'$award_description',
'$winner_story','$author_id','$award','$date')";
$res = setInfo($winner_sql_q);
if($res === TRUE){
  $_SESSION['messages']['success'] = "You successively added a winner";
  echo "<script>location.href='/Admin';</script>";
}else{
  $_SESSION['messages']['danger'] = "error occured during the process";
  echo "<script>location.href='addwinner.php';</script>";
}
}

// get winner

$winnerdb = 0;
if(isset($_GET['edit'])){
  $winner_sql = "SELECT * FROM winner  WHERE id = ${_GET['winner']}";
  $winnerdb = mysqli_query($conn,$winner_sql);
}
// update
if(isset($_POST['update'])){
  $campaign_name = $_POST['campaign_name'];
  $title = $_POST['title'];
  $winner_name = $_POST['winner_name'];
  $winner_photo = $imgdir . basename($_FILES["winner_photo"]["name"]);
  $about_winner = $_POST['about_winner'];
  $winner_quote = $_POST['winner_quote'];
  $winner_award = $imgdir . basename($_FILES["winner_award"]["name"]);
  $award_description = $_POST['photo_description'];
  $winner_story = $_POST['winner_story'];
  $region = $_POST['region'];
  $date = $_POST['date_won'];
  $amount = $_POST['amount'];
  $author_id = $_SESSION['user']['userid'];
  $award = $_POST['award'];
  // Check if file already exists
  if (file_exists($winner_photo) || file_exists($winner_award)) {
    $uploadOk = 0;
  }
  if($to_upload == 1){
    move_uploaded_file($_FILES["winner_photo"]["tmp_name"], $winner_photo);
    move_uploaded_file($_FILES["winner_award"]["tmp_name"], $winner_award);
  }else{
    echo "something went wrong";
  }

// TO DATABASE
$winner_sql_q = "UPDATE winner SET campaign_name='$campaign_name',title='$title', winner_name='$winner_name', winner_photo='$winner_photo',about_winner='$about_winner',winner_quote='$winner_quote',winner_award='$winner_award',amount='$amount', award_description='$award_description', winner_story='$winner_story', author_id='$author_id', award='$award', date='$date' WHERE id = ${_GET['winner']}";
$res = setInfo($winner_sql_q);
if($res === TRUE){
  $_SESSION['messages']['success'] = "You successively added a winner";
  echo "<script>location.href='/Admin';</script>";
}else{
  $_SESSION['messages']['danger'] = "error occured during the process";
  echo "<script>location.href='';</script>";
}
}
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
          <div class="title">Recent Winners</div>
          
          <div class="sales-details">
          <?php if(!isset($_GET['edit'])):?>
          <form class="row g-3" action="" enctype="multipart/form-data"  method="post">
<!-- form -->
<div class="col-md-6">
    <label for="inputEmail4" class="form-label">Campaign name</label>
    <input required class="form-control" type="text" name="campaign_name" id="">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Title</label>
    <input required class="form-control" type="text" name="title" id="">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Winner' Name</label>
    <input class="form-control" required type="text" name="winner_name" id="">
  </div>
  <div class="col-6">
    <label for="inputAddress" class="form-label">Winner's Photo</label>
    <input required class="form-control" type="file" name="winner_photo" id="">
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">About winner</label>
    <textarea required class="form-control" rows="5" cols="5" type="text" name="about_winner"></textarea>
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">winner quote</label>
    <textarea class="form-control" rows="5" cols="5" type="text" name="winner_quote" required></textarea>
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">Winner story</label>
    <textarea class="form-control" rows="5" cols="5" type="text" name="winner_story" required></textarea>
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Award</label>
    <input class="form-control" type="text" name="award" id="">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Amount</label>
    <input class="form-control" type="number" name="amount">
  </div>
  <div class="col-md-12">
    <label for="inputZip" class="form-label">Award's photo</label>
    <input class="form-control" required type="file" name="winner_award" id="">
  </div>
  <div class="col-12">
    <label for="inputAddress2" class="form-label">Photo description</label>
    <input class="form-control" required type="text" name="photo_description" id="">
  </div>
 
  <div class="col-md-6">
    <label for="inputCity" class="form-label">City/Town</label>
    <input class="form-control" type="text" name="region" id="">
  </div>
  <div class="col-md-6">
    <label for="inputZip" class="form-label">Date</label>
    <input class="form-control" type="date" name="date_won" id="">
  </div>
   <div class="col-12">
    <button type="submit" name="submit" class="btn btn-primary">Add</button>
  </div>
                    </form>

                    <?php else: ?>
                      <?php foreach($winnerdb as $winner): ?>
                      <form class="row g-3" action="" enctype="multipart/form-data"  method="post">
<!-- form -->
<div class="col-md-6">
    <label for="inputEmail4" class="form-label">Campaign name</label>
    <input value="<?php echo $winner['campaign_name'] ?>" class="form-control" type="text" name="campaign_name" id="">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Title</label>
    <input value="<?php echo $winner['title'] ?>" class="form-control" type="text" name="title" id="">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Winner' Name</label>
    <input class="form-control" type="text" name="winner_name" value="<?php echo $winner['winner_name'] ?>">
  </div>
  <div class="col-6">
    <label for="inputAddress" class="form-label">Winner's Photo</label>
    <input  file="<?php echo $winner['winner_photo'] ?>" class="form-control" type="file" name="winner_photo" id="">current:
    <a href="<?php echo $winner['winner_photo'] ?>" target="_blank" rel="noopener noreferrer"><?php echo $winner['winner_photo'] ?></a>
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">About winner</label>
    <textarea class="form-control" rows="5" cols="5" type="text" name="about_winner" ><?php echo $winner['about_winner'] ?></textarea>
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">winner quote</label>
    <textarea class="form-control" rows="5" cols="5" type="text" name="winner_quote" id=""><?php echo $winner['winner_quote'] ?></textarea>
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">Winner story</label>
    <textarea class="form-control" rows="5" cols="5" type="text" name="winner_story" id=""><?php echo $winner['winner_story'] ?></textarea>
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Award</label>
    <input class="form-control" type="text" name="award" value="<?php echo $winner['award'] ?>" >
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Amount</label>
    <input class="form-control" type="text" name="amount" value="<?php echo $winner['amount'] ?>" >
  </div>
  <div class="col-md-12">
    <label for="inputZip" class="form-label">Award's photo</label>
    <input value="<?php echo $winner['winner_award'] ?>" class="form-control" type="file" name="winner_award" id="">
    <a href="<?php echo $winner['winner_award'] ?>" target="_blank" rel="noopener noreferrer"><?php echo $winner['winner_award'] ?></a>
  </div>
  <div class="col-12">
    <label for="inputAddress2" class="form-label">Photo description</label>
    <input class="form-control" type="text" name="photo_description" value="<?php echo $winner['award_description'] ?>">
  </div>
 
  <div class="col-md-6">
    <label for="inputCity" class="form-label">City/Town</label>
    <input class="form-control" type="text" name="region" >
  </div>
  <div class="col-md-6">
    <label for="inputZip" class="form-label">Date</label>
    <input value="<?php echo $winner['date'] ?>" class="form-control" type="date" name="date_won" id="">
  </div>
   <div class="col-12">
    <button type="submit" name="update" class="btn btn-primary">update</button>
  </div>
                    </form>
                    <?php endforeach; ?>
                    <?php endif; ?>

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