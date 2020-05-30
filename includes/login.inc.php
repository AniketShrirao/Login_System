<?php

if (isset($_POST['login_submit'])) {

	require_once 'dbh.inc.php';

	$email = $_POST['email'];
	$password = $_POST['password'];

  if (empty($email) || empty($password)) {
		header("Location: ../login.php?error=EmptyFields&mail=".$email);
    exit();
  }
  else {
    $sql = "SELECT * FROM users WHERE email= ?;";
    $stmt = mysqli_stmt_init($conn);
		if(!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../login.php?error=SqlError");
			exit();
		}
		else {
			mysqli_stmt_bind_param($stmt,"s",$email);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $result_check = mysqli_num_rows($result);
      if($result_check > 0) {
        if($row = mysqli_fetch_assoc($result)) {
          $password_verification = password_verify($password,$row['password']);
          if($password_verification == false) {
            header("Location: ../login.php?error=WrongPassword");
            exit();
          }
          elseif ($password_verification == true) {
            session_start();
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_email'] = $row['email'];
            if($row['id'] == 1) {
              $_SESSION['admin'] = 'yes';
            } else {
              $_SESSION['admin'] = 'no';
            }
            if(isset($_SESSION['user_email']))
            header("Location: ../users.php");        
          }
          else {
            header("Location: ../login.php?error=WrongPassword");
            exit();
          }
        }
      }
      else {
        header("Location: ../login.php?error=NoEntry");
      }
    }
  }
} 
else {
  header("Location: ../users.php");
	exit();
}

?>