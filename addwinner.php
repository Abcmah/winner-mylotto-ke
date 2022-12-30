<?php
session_start();
include 'config/functions.php';
if($_SESSION['user']['is_authenticated'] != 1 && $_SESSION['user']['is_staff'] != 1){
  echo '<script> location.href="login.php"</script>';
  $_SESSION['messages']['primary'] = "You must be logged in";
}
$to_upload = 1;
$imgdir = 'img/uploads/';
if(isset($_POST['submit'])){
  echo "submited";
  $campaign_name = $_POST['campaign_name'];
  $title = $_POST['title'];
  $winner_name = $_POST['winner_name'];
  $winner_photo = $imgdir . basename($_FILES["winner_photo"]["name"]);
  $about_winner = $_POST['about_winner'];
  $winner_award = $imgdir . basename($_FILES["award_photo"]["name"]);
  $award_description = $_POST['photo_description'];
  $winner_story = $_POST['winner_story'];
  $region = $_POST['region'];
  $date = $_POST['date_won'];
  // $created = $_POST['submit']
  $author_id = 1;
  $award = $_POST['award'];
  // Check if file already exists
  if (file_exists($winner_photo) || file_exists($winner_award)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }
  if($to_upload == 1){
    move_uploaded_file($_FILES["winner_photo"]["tmp_name"], $winner_photo);
    move_uploaded_file($_FILES["award_photo"]["tmp_name"], $winner_award);
  }else{
    echo "something went wrong";
  }
  $body = " ${campaign_name} ${title} ${winner_name} ${winner_photo} ${about_winner} ${winner_award} ${award_description} ${winner_story} ${date}";
  echo $body;
// TO DATABASE
$winner_sql_q = "INSERT INTO winner(campaign_name, title, winner_name, winner_photo,about_winner, award_description, winner_story, author_id, award, date)
VALUES('$campaign_name', '$title', '$winner_name','$winner_photo','$about_winner',
'$award_description',
'$winner_story','1','$award','$date')";
$res = setInfo($winner_sql_q);
if($res === TRUE){
  $_SESSION['messages']['success'] = "You successively added a winner";
  echo "<script>location.href='index.php';</script>";
}else{
  $_SESSION['messages']['danger'] = "error occured during the process";
  echo "<script>location.href='addwinner.php';</script>";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'inc/head.php'?>
<body>
     <!-- header -->
     <header id="header" class="d-flex align-items-center ">
        <div class="container d-flex justify-content-between">
            <div class="brand">
                <img style="width: 80%;" src="./img/logo.png" alt="">
            </div>

            <nav id="navbar" class="navbar d-flex">
                <ul>
                    <li><a class="nav-link scrollto" href="./about.html">How to play</a></li>
                    <li><a class="nav-link scrollto" href="./about.html">Results</a></li>
                    <li><a class="nav-link active" href="./about.html">Winners</a></li>
                    <li><a class="nav-link scrollto" href="./contact.html">Contact</a></li>
                    <li><a class="btn btn-primary get-qt" href="">PLAY NOW</a></li>
                </ul>
                <i class='bx bx-menu-alt-right'></i>
                <!-- <i class="bi bi-list mobile-nv-toggle"></i> -->
            </nav>
        </div>
    </header>

    <section id="nav-blog">
        <div class="container">

            <div class="nav">
                <a href="">Home</a>
                <span><i class='bx bx-chevron-right'></i></span>
                <a href="#">New winner</a>
            </div>
            <div class="blog-title">
                <h2>New Winner</h2>
            </div>
        </div>
       </section>

    <main id="main">

        
        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
          <div class="container" data-aos="fade-up">
    
            <div  class="row">
    
              <div style="padding: 2rem; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);" class="col-lg-8 entries">
                <div class="form-group">
                    <form class="row g-3" action="" enctype="multipart/form-data"  method="post">
<!-- form -->
<div class="col-md-6">
    <label for="inputEmail4" class="form-label">Campaign name</label>
    <input class="form-control" type="text" name="campaign_name" id="">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Title</label>
    <input class="form-control" type="text" name="title" id="">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Winner' Name</label>
    <input class="form-control" type="text" name="winner_name" id="">
  </div>
  <div class="col-6">
    <label for="inputAddress" class="form-label">Winner's Photo</label>
    <input class="form-control" type="file" name="winner_photo" id="">
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">About winner</label>
    <textarea class="form-control" rows="5" cols="5" type="text" name="about_winner" id=""></textarea>
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">winner quote</label>
    <textarea class="form-control" rows="5" cols="5" type="text" name="winner_quote" id=""></textarea>
  </div>
  <div class="col-12">
    <label for="inputAddress" class="form-label">Winner story</label>
    <textarea class="form-control" rows="5" cols="5" type="text" name="winner_story" id=""></textarea>
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Award</label>
    <input class="form-control" type="text" name="award" id="">
  </div>
  <div class="col-md-6">
    <label for="inputZip" class="form-label">Award's photo</label>
    <input class="form-control" type="file" name="award_photo" id="">
  </div>
  <div class="col-12">
    <label for="inputAddress2" class="form-label">Photo description</label>
    <input class="form-control" type="text" name="photo_description" id="">
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
                </div>
    
              </div><!-- End blog entries list -->
    
              <div class="col-lg-4">
    
                <div class="sidebar">
                  <div class="sidebar-item search-form">
                    <form action="">
                      <input placeholder="Search" type="text">
                      <button type="submit"><i class="bi bi-search"></i></button>
                    </form>
                  </div><!-- End sidebar search formn-->
    
                  <h3 class="sidebar-title">Winners Categories</h3>
                  <div class="sidebar-item categories">
                    <ul>
                      <li><a href="#">All <span>(25)</span></a></li>
                      <li><a href="#">Cars<span>(12)</span></a></li>
                      <li><a href="#">Tvs <span>(5)</span></a></li>
                      <li><a href="#">Money <span>(22)</span></a></li>
                      <li><a href="#">Jiboost na lotto <span>(22)</span></a></li>
                    </ul>
                  </div><!-- End sidebar categories-->
    
                  <h3 class="sidebar-title">Recent Winners</h3>
                  <div class="sidebar-item recent-posts">
                    <div class="post-item clearfix">
                      <img src="assets/img/blog/blog-recent-1.jpg" alt="">
                      <h4><a href="blog-single.html">Nihil blanditiis at in nihil autem</a></h4>
                      <time datetime="2020-01-01">Jan 1, 2020</time>
                    </div>
    
                    <div class="post-item clearfix">
                      <img src="assets/img/blog/blog-recent-2.jpg" alt="">
                      <h4><a href="blog-single.html">Quidem autem et impedit</a></h4>
                      <time datetime="2020-01-01">Jan 1, 2020</time>
                    </div>
    
                    <div class="post-item clearfix">
                      <img src="assets/img/blog/blog-recent-3.jpg" alt="">
                      <h4><a href="blog-single.html">Id quia et et ut maxime similique occaecati ut</a></h4>
                      <time datetime="2020-01-01">Jan 1, 2020</time>
                    </div>
    
                    <div class="post-item clearfix">
                      <img src="assets/img/blog/blog-recent-4.jpg" alt="">
                      <h4><a href="blog-single.html">Laborum corporis quo dara net para</a></h4>
                      <time datetime="2020-01-01">Jan 1, 2020</time>
                    </div>
    
                    <div class="post-item clearfix">
                      <img src="assets/img/blog/blog-recent-5.jpg" alt="">
                      <h4><a href="blog-single.html">Et dolores corrupti quae illo quod dolor</a></h4>
                      <time datetime="2020-01-01">Jan 1, 2020</time>
                    </div>
    
                  </div><!-- End sidebar recent posts-->
    
                  <h3 class="sidebar-title">Tags</h3>
                  <div class="sidebar-item tags">
                    <ul>
                      <li><a href="#">App</a></li>
                      <li><a href="#">IT</a></li>
                      <li><a href="#">Business</a></li>
                      <li><a href="#">Mac</a></li>
                      <li><a href="#">Design</a></li>
                      <li><a href="#">Office</a></li>
                      <li><a href="#">Creative</a></li>
                      <li><a href="#">Studio</a></li>
                      <li><a href="#">Smart</a></li>
                      <li><a href="#">Tips</a></li>
                      <li><a href="#">Marketing</a></li>
                    </ul>
                  </div><!-- End sidebar tags-->
    
                </div><!-- End sidebar -->
    
              </div><!-- End blog sidebar -->
    
            </div>
    
          </div>
        </section><!-- End Blog Section -->
    
      </main><!-- End #main -->
</body>
</html>