<?php
if(isset($_SESSION['messages'])){
    foreach($_SESSION['messages'] as $tag => $message) {
        echo "<div class='container'><div class='alert alert-${tag} alert-dismissible fade show' role='alert'>
        <strong>${message}</strong>
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div></div>";
    }
    // unset($_SESSION['messages']);
}

?>