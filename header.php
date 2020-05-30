<?php 
  $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
  $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
  session_start();
?>

<!doctype html>

<!-- If multi-language site, reconsider usage of html lang declaration here. -->
<html lang="zxx"> 
<head>
  <meta charset="utf-8">
  <title>Home | landscaper</title>
  <!-- Place favicon.ico in the root directory: mathiasbynens.be/notes/touch-icons -->
  <link rel="shortcut icon" href="favicon.ico" />

  <!--font-awesome link for icons-->
<link rel="stylesheet" media="screen" href="assets/vendor/font-awesome/css/all.min.css" >
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Default style-sheet is for 'media' type screen (color computer display).  -->
  <link rel="stylesheet" media="screen" href="assets/css/style.css" >

</head>

<body>
  <!--container start-->
  <div class="container">
    <!--header section start-->
    <header>
      <div class="wrapper">
        <div class="logo">
          <h1>
            <a href="index.html" title="Landscaper"><img src="https://via.placeholder.com/145x30" alt="landscaper"></a>
          </h1>
        </div>
        <nav>
          <ul>
            <li>
              <a href="index.php" class="active" title="HOME">Home</a>
            </li>
            <?php if(strpos($url, 'index.php') !== false && isset($_SESSION['user_email']) ) { ?>
            <li>
              <a href="users.php" title="user">Users</a>
            </li>
            <?php } ?>
            <?php if(!isset($_SESSION['user_email'])) { ?>
              <li>
              <a href="login.php" title="Login">Login</a>
            </li>
            <li>
              <a href="signup.php" title="SignUp">SignUp</a>
            </li>
            <?php } else { ?>
              <li>
              <a href="includes/logout.inc.php" title="Logout">Logout</a>
            </li>
            <?php } ?>
          </ul>
        </nav> 
      </div>
    </header>
    <!--header section end-->