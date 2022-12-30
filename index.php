<?php
session_start();
include 'config/db.php';
$page_name = "home";
$page_title = "Winners";
// number of records
$records_per_page = 15;

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$offset = ($page - 1) * $records_per_page;
$sql = "SELECT * FROM winner ORDER BY date DESC LIMIT $offset,$records_per_page";
$resql = "SELECT * FROM winner";
$usersSql = "SELECT id, name, is_staff, is_superuser,email,photo FROM user";
$users = mysqli_query($conn, $usersSql);
$winners = mysqli_query($conn, $sql);
$allwinners = mysqli_query($conn, $resql);
$total_records = mysqli_num_rows($allwinners);
$total_pages = ceil($total_records / $records_per_page);
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'inc/head.php'?>
<body>
     <!-- header goes here-->
    <?php include 'inc/header.php'?>
    <?php include 'inc/blog.php'?>
    <?php include 'messages.php'?>

    <section>
        <main id="main">

        
            <!-- ======= Blog Section ======= -->
            <section id="blog" class="blog">
              <div class="container" data-aos="fade-up">
        
                <div class="row">
        
                  <div class="col-lg-8 entries">
                <?php foreach($winners as $winner): ?>
                    <article class="entry">
        
                      <div class="entry-img">
                        <img src="<?php echo $winner['winner_photo'];?>" alt="" class="img-fluid">
                      </div>
        
                      <h2 class="entry-title">
                        <a href="winner.php?winner=<?php echo $winner['id']?>"><?php echo $winner['title'] ?></a>
                      </h2>
        
                      <div class="entry-meta">
                        <ul>
                          <li class="d-flex align-items-center"><i class="bi bi-person"></i> @ <a href="winner.php?winner=<?php echo $winner['id']?>"><?php 
                          while($row = $users->fetch_assoc()) {
                            if ($winner['author_id'] === $row['id']){
                              echo "sa";
                            }
                          }
                          ?></a></li>
                          <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="winner.php?winner=<?php echo $winner['id']?>"><time datetime="2020-01-01"><?php echo $winner['date']; ?></time></a></li>
                          
                        </ul>
                      </div>
        
                      <div class="entry-content">
                        <p>
                          <?php echo $winner['winner_story']; ?>
                        </p>
                        <div class="comment entry-meta mt-4">
                            <li class="d-flex align-items-center"></li><i class="bi bi-chat-dots"></i><a href="winner.php?winner=<?php echo $winner['id']?>#com">leave a comment</a></li>
                        </div>
                        <div class="read-more">
                          <a href="winner.php?winner=<?php echo $winner['id']?>">Read More</a>
                        </div>
                      </div>
        
                    </article><!-- End blog entry -->
                <?php endforeach; ?>    
                    <div class="blog-pagination">
                        <nav aria-label="...">
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
                              <li class="page-item actve" aria-current="page">
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
                          </nav>
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
                      <h3 class="sidebar-title">Jackpot winners</h3>
                      <div class="sidebar-item recent-posts mb-4">
                      <?php foreach($winners as $winner): ?>
                        <?php if($winner['amount'] >= 100000000):?>
                        <div class="post-item clearfix">
                          <img src="<?php echo $winner['winner_photo'] ?>" alt="">
                          <h4><a href="winner.php?winner=<?php echo $winner['id']?>"><?php echo $winner['winner_name'] ?></a></h4>
                          <time datetime="2020-01-01"><?php echo $winner['date'] ?></time>
                        </div>
                          <?php endif;?>
                        <?php endforeach; ?>  
        
                        
                       
        
                        
        
                      </div><!-- End sidebar recent posts-->                    
                      <div class="sidebar-item recent-posts">
                        <h4>How to play</h4>
                        <div class="card bg-info p-2 m-2">
                          <h4>SMS</h4>
                          <ul>
                            <li>SMS WEB to 79007.</li>
                            <li class="text-danger "><b>Enter Mpesa PIN to authorise a charge of Ksh50 and get your ticket.</b></li>
                            <b>To pick your own numbers;</b>
                            <li class="text-danger "><b>SMS 6 Numbers from 0-49 (separated by comma or space) followed by WEB to 79007.</b></li>
                            <li><b>Enter Mpesa PIN to authorise a charge of Ksh50 and get your ticket.</b></li>
                          </ul>
                        </div>
        
                      </div><!-- End sidebar recent posts-->        
                    </div><!-- End sidebar -->
        
                  </div><!-- End blog sidebar -->
        
                </div>
        
              </div>
            </section><!-- End Blog Section -->
        
          </main><!-- End #main -->
          <?php  unset($_SESSION['messages']);?>
    </section>
    <?php include 'inc/footer.php'?>
      <!-- go up button -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</body>
</html>