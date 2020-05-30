<?php

if (isset($_POST['edit_submit'])) {
  if(isset($_POST['id'])) {
    $post_id = $_POST['id'];
    $username = $_POST['fullname'];
    $email = $_POST['email'];
    require_once 'dbh.inc.php';
  }
  function locate($error,$username,$email) 
  {
    header("Location: ../edit.php?error=".$error."&username=".$username."&mail=".$email);
  }
    if(empty($username) || empty($email)) {
      locate('EmptyFields',$username,$email);
      exit();
    } 
    elseif(!preg_match("/^[a-zA-Z0-9]*$/",$username) && !filter_var($email,FILTER_VALIDATE_EMAIL)) {
      header("Location: ../edit.php?error=InvalidDetails");
      exit();
    }
    elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
      locate('InvalidEmail',$username,$email);
      exit();
    }
    elseif(!preg_match("/^[a-zA-Z0-9]*$/",$username)) {
      locate('InvalidName',$username,$email);
      exit();
    }
    else {
      $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?;";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../edit.php?error=SqlError");
        exit();
      }
      else {
        mysqli_stmt_bind_param($stmt,"ssi",$username,$email,$id);
          mysqli_stmt_execute($stmt);          
        header("Location: ../users.php");
      }
    }
  
  } else { 
    header("Location: ../users.php");
    exit();
  }     

?>