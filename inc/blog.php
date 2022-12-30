<?php
// session_start();


?>
<section id="nav-blog">
        <div class="container d-flex justify-content-between">
          <span>
            <div class="nav">
              <a href="/">Home</a>
              <span><i class='bx bx-chevron-right'></i></span>
              <a href=""><?php echo $page_name ?></a>
          </div>
          <div class="blog-title">
              <h2><?php echo $page_title ?></h2>
          </div>
          </span>
            
            <div class="auth">
             <?php 
             if(isset($_SESSION['user']['is_authenticated'])){
              if($_SESSION['user']['is_authenticated'] == 1){
                echo "<span>" . $_SESSION['user']['username'] . "</span>";
           
                echo '<a style="font-size: 15px; font-weight:700; text-decoration: underline;" class="" href="Admin">Admin lotto</a>' ;
              
              echo '<a style="font-size: 15px; font-weight:700; text-decoration: underline;" class="text-danger" href="logout.php">Logout</a>';
              }
              else{
               echo '  <a style="font-size: 15px; font-weight:700; text-decoration: underline;" class="login.php" href="login.php">Login</a>';
              }
             }else{
              echo '  <a style="font-size: 15px; font-weight:700; text-decoration: underline;" class="login.php" href="login.php">Login</a>';
             }
             
             ?>
              
            
              
            
            
        
            </div>
        </div>
       </section>