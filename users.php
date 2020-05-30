<?php include_once 'header.php';
  if(isset($_SESSION['user_email'])) { 
?>
     <!-- services section start-->
     <section class="services"> 
        <div class="wrapper">
        <?php if($_SESSION['admin'] == 'yes') { 
          echo '<a href="includes/Crud.inc.php?name=add" class="submit" title="Add">Add new Member</a>';    
        }  
        ?>
          <h2>Users</h2>
          <p>Members of Landscaper Team</p>
          <div class="service users">
            <?php 
            include_once 'includes/dbh.inc.php';
            if($_SESSION['admin'] == 'no') {
              $sql = "SELECT id,name,email FROM users where id > 1;";
            } else {                   
              $sql = "SELECT id,name,email FROM users;";
            }
            $result = mysqli_query($conn, $sql);
              $result_check = mysqli_num_rows($result);
              if($result_check > 0) {
                while($row = mysqli_fetch_assoc($result)) { 
                  echo 
                  '<article class="serve box">
                    <figure>
                    <img src="https://via.placeholder.com/206?text='.substr($row['name'], 0, 1).'" alt="lawn care">
                    </figure>
                    <h3>'.$row['name'].'</h3>
                    <p>'.$row['email'].'</p>
                    <a href="includes/Crud.inc.php?name=edit&id='.$row['id'].'" class="submit" title="edit">edit</a>';
                    if($_SESSION['admin'] == 'yes') { 
                    echo '
                      <a data-id="'.$row['id'].'" class="delete submit" title="delete">delete</a>
                      '
                      ; }                 
                    echo "</article>"; 
                }
              } else {
              echo "<p class='no-user'>NO USERS</p>";
            } ?>
          </div>
        </div>            
     </section>
     <script>
        var deleteBtns = document.querySelectorAll('.delete');
        deleteBtns.forEach(button => {
          button.addEventListener('click', () => {
            console.log(button);
            var conf = confirm("are you sure you want to delete this record!");
            if(!conf) {
              window.location.href = "users.php";
            }
            else {
              window.location.href = "includes/Crud.inc.php?name=delete&id="+button.dataset.id;
            } 
          });
        });
    </script>
     <!--services section end-->
<?php include_once 'footer.php';
  } else {
    header("Location: login.php");
  }
?>