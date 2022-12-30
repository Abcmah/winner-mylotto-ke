<?php

function getInfo($sql_query){
    include 'db.php';
    $conn = new mysqli($servername, $username, $password,$DB_NAME);
    return mysqli_query($conn, $sql_query);
}
?>
<?php
function setInfo($sql_query){
    include 'db.php';
    $conn = new mysqli($servername, $username, $password,$DB_NAME);
    if (mysqli_query($conn, $sql_query) === TRUE) {
        return TRUE;
      } else {
        return "Error: " . $sql_query . "<br>" . $conn->error;
      }
}
function authenticate($email, $user_password){
    // session_start();
    include 'db.php';
    $user_query = "SELECT * FROM user WHERE email = '$email'";
    // $conn = new mysqli($servername, $username, $password,$DB_NAME);
    $res = mysqli_query($conn, $user_query);

    if (mysqli_num_rows($res) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($res)) {
            $email = $row["email"];
            $is_staff = $row["is_staff"];
            $is_superuser = $row["is_superuser"];
            $id = $row["id"];
            $ps = $row["password"];
            $name = $row["name"];
          }
          if(password_verify($user_password, $ps)){
            $_SESSION['user'] = [
              'is_authenticated' => 1,
              'username' => $email,
              'is_staff' => $is_staff,
              'is_superuser' => $is_superuser,
              'userid' => $id,
              'email' => $email,
              'name' => $name
          ];
          return 1;
          }
          else{
            return 0;
          }
        
       
      }
       else {
        return FALSE;
      }
      
      mysqli_close($conn);
}

function logout_user(){
  
}
?>