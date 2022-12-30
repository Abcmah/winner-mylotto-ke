<nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn'></i>
        <span class="dashboard">Dashboard</span>
      </div>
      <div class="search-box">
        <input type="text" placeholder="Search...">
        <i class='bx bx-search' ></i>
      </div>
      <div class="profile-details">
        <img src="../img/static/com.png" alt="">
        <?php
        if(isset($_SESSION['user']['is_authenticated'])){
          if($_SESSION['user']['is_authenticated'] == 1){
            echo "<span class='admin_name'>" . $_SESSION['user']['username'] . "</span>";
          }
        }
         ?>
        <i class='bx bx-chevron-down' ></i>
      </div>
    </nav>