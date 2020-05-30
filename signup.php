<?php 
  include_once 'header.php'; 
  $user = $mail = '';
  if(isset($_GET['error']) ) {
    include_once "includes/errors.php";
    echo '<span class="error-span">'.$error.'</span>';
    $user = $_GET['username'];
    $mail = $_GET['mail'];
  } 
  elseif (isset($_GET['signup'])) {
    echo '<span class="success-span">You are successfully signed up</span>';
  }

?>
  <div class="signup-form">
    <h3>Registeration Form</h3>
    <form action="includes/signup.inc.php" method="POST"> 
     <div class="form-group">
        <input type="text" name="fullname" placeholder="FullName..." value="<?php echo $user ?>">
      </div>
      <div class="form-group">
        <input type="text" name="email" placeholder="Email..." value="<?php echo $mail ?>">
      </div>
      <div class="form-group">
        <input type="password" name="password" placeholder="password...">
      </div>
      <div class="form-group">
        <input type="password" name="confirm_password" placeholder="confirm password...">
      </div>
      <div class="form-control">
      <button type="submit" name="signup_submit" class="submit" title="signup">signup</button>
      </div>
    </form>
  </div>
<?php include_once 'footer.php'; ?>