<?php 
  include_once 'header.php'; 

  if(!isset($_SERVER['HTTP_REFERER'])){
    header('Location: users.php');
  }
     $user = $mail = '';
  if(isset($_GET['error']) ) {
    include_once "includes/errors.php";
    echo '<span class="error-span">'.$error.'</span>';
  } 
  elseif (isset($_GET['signup'])) {
    echo '<span class="success-span">You are successfully signed up</span>';
  } 
  else {
    $id = $_GET['id'];
    include_once 'includes/dbh.inc.php';
  $sql = "SELECT name,email FROM users WHERE id= $id;";
  $result = mysqli_query($conn, $sql);
    $result_check = mysqli_num_rows($result);
    if($result_check > 0) {
      while($row = mysqli_fetch_assoc($result)) { 
      $user = $row['name'];
      $mail = $row['email'];
      }
    }
  }

?>
  <div class="signup-form">
    <h3>Edit Details</h3>
    <form action="includes/edit.inc.php" method="POST"> 
    <div class="form-group">
        <input type="hidden" name="id" value="<?php echo $id ?>">
      </div>
     <div class="form-group">
        <input type="text" name="fullname" placeholder="FullName..." value="<?php echo $user ?>">
      </div>
      <div class="form-group">
        <input type="text" name="email" placeholder="Email..." value="<?php echo $mail ?>">
      </div>
      <div class="form-control">
      <button type="submit" name="edit_submit" class="submit" title="edit">edit</button>
      </div>
    </form>
  </div>
<?php include_once 'footer.php'; ?>