<?php
  @session_start();
  if (isset($_SESSION['user'])) {
    # code...
    $session = $_SESSION['user'];
  }
  else {
    $session = null;
  }
 ?>
<html>
<!DOCTYPE html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/reset.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/simpletextrotator.css">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="css/lightbox.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700,900" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  </head>
  <body>
    <header>
      <div class="container"><!--class whose width depends on device width -->
        <div class="row">
          <a href="#" class="logo pull-left bold">Photo<span class="primary">G</span>allery</a>
          <nav class="pull-right right">
               <button type="button" class="btn" data-toggle="collapse" data-target="#menu">
                      <i class="fa fa-navicon"></i>
               </button>
               <div class="collapse" id="menu">
                    <ul class="center">
                      <li><a href="index.php">Home</a></li>
                      <li><a href="gallery.php">Gallery</a></li>
                      <li><a href="#">About</a></li>
                      <li><a href="#">Contact</a></li>
                      <?php
                          if($session==null)
                          {
                    ?>
                                <li class="login"><a href="login.php" class="blue-bg">Login</a></li>
                                <li class="register"><a href="registration.php" class="primary-bg">Register</a></li>
                       <?php
                            }
                        else {
                          # code...
                          ?>
                          <li class="logout"><a href="index1.php" class="primary-bg">Logout</a></li>
                          <?php
                        }
                        ?>

               </div>
          </nav>
        </div>
      </div>
    </header>
