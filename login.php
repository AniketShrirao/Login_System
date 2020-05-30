  <?php 
    include_once 'header.php'; 
  if(!isset($_SESSION['user_email'])) { 
    if(isset($_GET['error']) ) {
      include_once "includes/errors.php";
      echo '<span class="error-span">'.$error.'</span>';
    } 
  ?>
  <div class="login-form">
    <h3>Login Form</h3>
    <form action="includes/login.inc.php" method="POST"> 
      <div class="form-group">
        <input type="text" name="email" placeholder="Email...">
      </div>
      <div class="form-group">
        <input type="password" name="password" placeholder="password...">
      </div>
      <div class="form-control">
      <button type="submit" name="login_submit" class="submit" title="Login">Login</button>
      </div>
    </form>
  </div>
<?php include_once 'footer.php';
  } else {
    session_unset();
    session_destroy();
    header("Location: index.php");
  }
?>