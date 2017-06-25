<?php
  session_start();
  $adminsession=NULL;
  if(isset($_SESSION['user']))
  {
    unset($_SESSION['user']);
  }
  if(isset($_SESSION['admin']))
  {
    $adminsession=$_SESSION['admin'];
    include 'functions.php';
  }
  else{
    $adminsession=NULL;
  }
  include 'inc/header.php';
  include 'inc/slider.php';

  if($adminsession==NULL)
  {
    include 'inc/admin-login-form.php';
  }
  else{
    include 'inc/admin-content.php';
  }
  include 'inc/footer.php'
  ?>
