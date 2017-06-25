<?php
  $picid=$_POST['id'];//id which is passed in approveimage function.
  include 'inc/db.inc.php';
  //$approved=1;
  $query="DELETE FROM pics where pid='$picid'";
  $queryrun=mysql_query($query);
  if($queryrun){
    echo 'deleted';
  }
  else{
     echo 'oops';
  }


 ?>
