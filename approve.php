<?php
  $picid=$_POST['id'];//id which is passed in approveimage function.
  include 'inc/db.inc.php';
  $approved=1;
  $query="UPDATE pics SET approved='$approved' where pid='$picid'";
  $query1="SELECT * from users where username=(select username from pics where pid='$picid')";//getting username for top uploaders.
  $queryrun=mysql_query($query);
  if($queryrun){
    echo 'approved<br>';
    $query1_run=mysql_query($query1);//this query runs if we approve image that is why inside the 1st query.
    while ($row=mysql_fetch_assoc($query1_run)) {
      # code...
      $new_upload=$row['uploads']+1;
      $query2="UPDATE users SET uploads='$new_upload' where username=(select username from pics where pid='$picid')";
      $query2_run=mysql_query($query2);
      if ($query2_run) {
        # code...
        echo 'yo!';
      }
    }
  }
  else{
     echo 'not aapproved';
  }


 ?>
