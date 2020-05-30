<?php

if(isset($_GET['name'])) {

  switch ($_GET['name']) {
    case 'add':
      header("Location: ../signup.php?name=add");
      break;
    case 'edit':
      $id = $_GET['id'];
      header("Location: ../edit.php?name=edit&id=".$id);
      break;
    case 'delete':
      $id = $_GET['id'];
      include_once 'dbh.inc.php';
      $sql = "DELETE FROM users WHERE id = ?;";
      $stmt = mysqli_stmt_init($conn);
      mysqli_stmt_prepare($stmt, $sql);
      mysqli_stmt_bind_param($stmt,"s",$id);
      mysqli_stmt_execute($stmt);
      header("Location: ../users.php");
      break;
    default:
      break;
  }
}

?>