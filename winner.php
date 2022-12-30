<?php include 'config/functions.php';
session_start();
include 'config/db.php';
$page_name = "winner";
$winner_sql = "SELECT * FROM winner WHERE id = ${_GET['winner']}";
$comments_sql = "SELECT * FROM comment WHERE  winner = ${_GET['winner']}";
$users_sql = "SELECT id, name, is_staff, is_superuser,email,photo FROM user";
$winners = getInfo($winner_sql);
$users = getInfo($users_sql);
$comments = getInfo($comments_sql);

if(isset($_POST['comment_admin'])){
  // session_start();
  $body = mysqli_real_escape_string($conn,$_POST['body']);
  $name = $_SESSION['user']['name'];
  $email = $_SESSION['user']['email'];
  $winner = $_GET['winner'];
  $sql = "INSERT INTO comment (name, email, winner,body) VALUES('$name','$email','$winner', '$body')";
  if(mysqli_query($conn,$sql) > 0){
    // echo "<script> location.href='';</script>";
    $_SESSION['messages']['success'] ="added";
  }else{
    $_SESSION['messages']['danger'] ="something went wrong";
  }
}elseif(isset($_POST['comment'])){
  $name = mysqli_real_escape_string($conn,$_POST['name']);
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $winner = $_GET['winner'];
  $body = mysqli_real_escape_string($conn,$_POST['body']);
  $sql = "INSERT INTO comment (name, email, winner,body) VALUES('$name','$email','$winner', '$body')";
  if(mysqli_query($conn,$sql) > 0){
    // echo "<script> location.href='';</script>";
    $_SESSION['messages']['success'] ="added";
  }else{
    $_SESSION['messages']['danger'] ="something went wrong";
  }
}
$page_title = "";
foreach($winners as $winner){
  $page_title = $winner['title'];
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'inc/head.php'?>
<body>
     <!-- header -->
     <?php include 'inc/header.php'?>
     <?php include 'inc/blog.php'?>
     



       <main id="main">
       <?php include 'messages.php'?>
        <!-- ======= Blog Single Section ======= -->
        <section id="blog" class="blog">
          <div class="container" data-aos="fade-up">
    
            <div class="row">
    
              <div class="col-lg-8 entries">
              <?php foreach($winners as $winner): ?>
                <article class="entry entry-single">
    
                  <div class="entry-img">
                    <img src="<?php echo $winner['winner_photo'];?>" alt="" class="img-fluid">
                  </div>
    
                  <h2 class="entry-title">
                    <a href="#"><?php echo $winner['title'];?></a>
                  </h2>
    
                  <div class="entry-meta">
                    <ul>
                      <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="#">@<?php 
                          while($row = $users->fetch_assoc()) {
                            if ($winner['author_id'] == $row['id']){
                              echo $row['name'];
                            }
                          }
                          ?></a></li>
                      <li class="d-flex align-items-center"><i class="bi bi-clock"></i><time datetime="2020-01-01"><?php echo $winner['date'];?></time>
                    </ul>
                  </div>
    
                  <div class="entry-content">
                  <h3><?php echo $winner['winner_name']; ?>'s Story</h3>
                    <p>
                    <?php echo $winner['winner_story'];?> 
                    </p>
                    <div class="testi puple">
                      <div class="header">
                        <img src="./img/static/winner.webp" alt="<?php echo $winner['winner_name'];?>">
                        <span>
                          <h3><?php echo $winner['winner_name'];?></h3>
                        </span>
                      </div>
                      <p class="qute">
                        “ <?php echo $winner['winner_quote'];?> ”
                      </p>
                
                    </div>
    
                    <p>
                        </p>
                        <img src="<?php echo $winner['winner_award']; ?>" class="img-fluid" alt="">
                        <div style="color:rgb(44, 29, 1);;font-weight:bold;font-size:12px"><?php echo $winner['award_description']; ?></div>
                    <h3> About <?php echo $winner['winner_name']; ?></h3>
                    <p>
                    <?php echo $winner['about_winner']; ?>
                    </p> 
                  </div>
    
                  <div class="entry-footer">
                    <div class="comment entry-meta mt-4">
                      <li class="d-flex align-items-center"></li><i class="bi bi-chat-dots"></i><a href="#com">write a comment</a></li>
                  </div>
                  </div>
    
                </article><!-- End blog entry -->
                <?php endforeach; ?> 
                 <!-- new comment -->
                 <h4>comments</h4>
                 <div class="wraper">
                  <div class="comment-con">
                  <?php foreach($comments as $comment): ?>
                    <div class="comment-wraper my-2">
                      <div class="like-wraper"></div>
                      <div class="content-wraper">
                        <div class="top">
                          <span class="dp">
                            <span class="pic">
                              <img src="./img/static/com.png" alt="pic">
                            </span>
                            <b><?php echo $comment['name']; ?></b>
                            <span style="font-size:12px" class="created"><?php echo  $comment['posted']; ?></span>
                          </span>
                          <span style="display: flex; align-items:center;">                        
                          <span style="display: flex; align-items:center;">
                          <a class="text-danger" href="deletecomment.php?comment=<?php echo $comment['id']?>&winner=<?php echo $_GET['winner']?>">
                          <i class="bi bi-trash"></i>
                          </a>
                          </span>
                          </span>
                        </div>
                        <div class="comment-body">
                        <?php echo $comment['body']; ?>
                        </div>
                      </div>
                    </div>
                    <?php endforeach; ?> 
                    <!-- sub comments  -->

                  </div>
                  <!-- form -->
                  <?php if(isset($_SESSION['user']['is_authenticated'])):
                  if($_SESSION['user']['is_authenticated'] == 1):
                     ?>
                  
                  <form  action="" method="post" id="com" class="form-wraper">
                    <span class="dp">
                      <span class="pic">
                        <img src="./img/static/winner.webp" alt="pic">
                      </span>
                    </span>
                    <span style="width: 100%;">
                      <textarea required class="form-control" name="body" cols="30" rows="4"></textarea>
                    </span>
                    <span>
                      <button class="btn btn-primary" type="submit" name="comment_admin">comment</button>
                    </span>
                  </form>
                  <?php else:?>
                  <!-- unregisted users -->
                  <form action="" id="com" method="post" class="form-wraper">
                    
                    <div style="margin: auto;" class="row g-3">
                      <div class="col-md-6">
                        <div class="form-floating">
                          <input required type="text" name="name" class="form-control" id="floatingInput" placeholder="name">
                          <label for="floatingInput">Name</label>
                        </div>
    
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating">
                          <input required name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                          <label for="floatingInput">Email address</label>
                        </div>
                      </div>
                      <div class="col-md-12">
                       
                        <label class=" my-4" for="">Comments</label>
                  
                          <textarea class="form-control" required name="body" id="floatingInput"  cols="" rows="4"></textarea>
                         
                        
                       
                      </div>
                      <button name="comment" class="btn btn-primary" type="submit">comment</button>
                    </div>
                    
                  </form>
                  <?php endif; ?>
                  <?php else: ?>
                     <!-- unregisted users -->
                  <form action="" id="com" method="post" class="form-wraper">
                    
                    <div style="margin: auto;" class="row g-3">
                      <div class="col-md-6">
                        <div class="form-floating">
                          <input required name="name" type="text" class="form-control" id="floatingInput" placeholder="name">
                          <label for="floatingInput">Name</label>
                        </div>
    
                      </div>
                      <div class="col-md-6">
                        <div class="form-floating">
                          <input required name="email" type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                          <label for="floatingInput">Email address</label>
                        </div>
                      </div>
                      <div class="col-md-12">
                       
                        <label class=" my-4" for="">Comment</label>
                          <textarea 
                          required class="form-control" name="body" id="floatingInput"  cols="" rows="4"></textarea>
                         
                        
                       
                      </div>
                      <button name="comment"  class="btn btn-primary" type="submit">comment</button>
                    </div>
                    
                  </form>
                  <?php endif; ?>

                 </div>
              </div><!-- End blog entries list -->
    
              <div class="col-lg-4">
    
                <div class="sidebar">
                  <div class="sidebar-item search-form">
                    <form action="">
                      <input type="text" placeholder="Search" type="search">
                      <button type="submit"><i class="bi bi-search"></i></button>
                    </form>
                  </div><!-- End sidebar search formn-->
    
                  <h4>How to play</h4>
                        <div class="card bg-warning p-2 m-2">
                          <h4>SMS</h4>
                          <ul>
                            <li>Enter your mobile number.</li>
                            <li> Enter 6 Lucky numbers from 0-49 or click Random Picks get auto-picked numbers.</li>
                            <li>Enter amount between Ksh50-1,000.</li>
                            <li class="text-danger "><b>Click PLAY NOW. Check your phone to authorize Mpesa charge. Enter PIN to complete transaction</b></li>
                            
                          
                            <li><a href="" target="_blank" rel="noopener noreferrer">Click here</a> <b> to play</b></li>
                          </ul>
                        </div>
    
                </div><!-- End sidebar -->
    
              </div><!-- End blog sidebar -->
    
            </div>
    
          </div>
        </section><!-- End Blog Single Section -->
        <?php  unset($_SESSION['messages']);?>
      </main><!-- End #main -->
      <?php include 'inc/footer.php'?>
</body>
</html>