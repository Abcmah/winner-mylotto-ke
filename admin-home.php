<?php 
$page_name = "admin";

?>
<!DOCTYPE html>
<html lang="en">
<?php include 'inc/head.php' ?>
<body>
     <!-- header -->
     <?php include 'inc/header.php' ?>
    <style>
      .box{
        padding: 10px;
        display: flex;
        border-radius: 10px;
        flex-direction: column;
        justify-content: center;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
        /* align-items: center; */
      }
      .plus{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        padding: 10px;
      }
      .plu{
        border: 2px dotted rgba(8, 7, 7, 0.1);
        transition: 300ms all;
        cursor: pointer;
      }
      .plu:hover{
        background-color: aliceblue;
        scale: 1.1;
        color: rgb(73, 73, 231);
      }
      .bi-plus{
        font-size: 25px;
      }
    </style>
    <?php include 'inc/blog.php'?>
    <?php include 'messages.php'?>
    <main id="main">

        
        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
          <div class="container" data-aos="fade-up">
    
            <div  class="row">
    
              <div style="padding: 2rem; box-shadow: 0 4px 16px rgba(25, 25, 26, 0.1);" class="col-lg-8 entries">
                <div class="admin-home">
                <div>
        <h2>Deshboard</h2>
      </div>
      <div class="row g-3">
        <div class="col-md-4 col-lg-4 col-6 ">
          <div class="box">
            <div class="icon-box">
              <i class="bi bi-plus"></i>
            </div>
            <h5>Winners</h5>
            {{number_winners}}
            <div style="display:flex; justify-content:flex-end; color: rgb(109, 113, 116); font-size: 12px;" class="muted">
              since started
              
            </div>
          </div>
        </div>
        <div class="col-md-4 col-lg-4 col-6 ">
          <div class="box">
            <div class="icon-box">
              d
            </div>
            <h5>Winners</h5>
            {{number_winners}}
            <div style="display:flex; justify-content:flex-end; color: rgb(109, 113, 116); font-size: 12px;" class="muted">
              this year only
            </div>
          </div>
        </div>
        <div class="col-md-4 col-lg-4 col-6 ">
          <a href='addwinner.php'>
          <div class="box plu">
            <div class="plus">
              <div>New winner</div>
              <i class="bi bi-plus"></i>
            </div>
          </div>
        </a>
        </div>
      </div>
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