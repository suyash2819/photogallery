<?php
session_start();

  $filename = $_FILES['file1']['name']; //the file we appended in main.js
  //echo $filename;
  $tmpname = $_FILES['file1']['tmp_name'];
  $session = $_SESSION['user'];
  $destination = 'uploads/'.$session.'/'.$filename; //where the file mage is gping to get uploaded.

  $id='';
  $approved=0;
  include 'inc/db.inc.php';

  $query="INSERT into pics values('$id','$session','$filename','$approved')";
  $query_run=mysql_query($query);
  if ($query_run){
    if(move_uploaded_file($tmpname, $destination))//to move the file we have in built function.
    {
      echo $destination;
    }
  }

 ?>
