<?php
  include 'inc/db.inc.php';
  function get_top_uploaders()
  {
    $limit=3;
    $query="SELECT * from users order by uploads desc limit $limit";
    $query_run=mysql_query($query);
    if(mysql_num_rows($query_run)>0)
    {
      while ($row=mysql_fetch_assoc($query_run))
       {
        # code...
        $pic=0;

        $author=$row['username'];
        $avatar_image_folder='uploads/'.$author.'/avatar';
        /*** file handling for getting the avatar image ***/
        if($handle=opendir($avatar_image_folder))
        { //now we check for the avatar image in avatar_image_folder.only one image.
          while(false!==($entry=readdir($handle)))//not false means ..true..we check for permisiion for opening the folder then read it with readdir.
          {
            if (($entry!='.') and ($entry!='..'))
            {//there is no '.' or '..' in a file Name
              # code...
              $pic=1;//as if there is no '.' or '..' means there ia a pic.
              $avatar_image_path = $avatar_image_folder.'/'.$entry;
              //echo "<img src=$avatar_image_path alt=$entry  width='300px'/>";
              ?>
              <div class="col-md-4">
                <div class="gallery-image">
                  <img src="<?php echo $avatar_image_path;?>"class="front">
                  <div class="back">
                      <div class="back-content">
                          <h3><?php echo $author; ?></h3>
                          <h6><i>No. of Uploads </i><?php echo $row['uploads']; ?></h6>
                      </div>
                  </div>
                </div>
              </div>
              <?php
            }
          }
          closedir($handle);//we need to close the handle if we have opened it.
        }
        if($pic==0){
          ?>
          <div class="col-md-4">
            <div class="gallery-image">
              <img src="images/user-default.jpg"class="front">
              <div class="back">
                  <div class="back-content">
                      <h3><?php echo $author; ?></h3>
                      <h6><i>No. of Uploads:</i><?php echo $row['uploads']; ?></h6>
                  </div>
              </div>
            </div>
          </div>
          <?php
          }
        }
      }
    }

  function get_recent_pics()
  {
      $limit=3;
      $query="SELECT * from pics order by pid desc limit $limit";
      $query_run=mysql_query($query);
      if(mysql_num_rows($query_run)>0)
      {
        while ($row=mysql_fetch_assoc($query_run)) {
          # code...
          $picname=$row['picname'];
          $pid=$row['pid'];
          $author=$row['username'];
          $src='uploads/'.$author.'/'.$picname;
          ?>
          <div class="col-md-4">
            <div class="gallery-image">
              <img src="<?php echo $src;?>"class="front">
              <div class="back">
                  <div class="back-content">
                      <h3><?php echo $picname ?></h3>
                      <h6><i>By </i><?php echo $author ?></h6>
                      <a href="<?php echo $src?>"data-lightbox="gallery"><i class="fa fa-expand"></i></a>
                  </div>
              </div>
            </div>
          </div>
          <?php
        }
      }
  }


  function get_home_gallery_content($x)
  {
    $approved=1;
    $query="SELECT * from pics where approved='$approved' limit $x";//that is length from 0 to 2 i.e length is 3;
    $query_run=mysql_query($query);
    if(mysql_num_rows($query_run)>0){
      while($row=mysql_fetch_assoc($query_run))
      {
        $picname=$row['picname'];
        $pid=$row['pid'];
        $author=$row['username'];
        $src='uploads/'.$author.'/'.$picname;
        ?>
        <div class="col-md-4">
            <div class="gallery-image">
                <img src="<?php echo $src;?>" class="front">
                <div class="back">
                    <div class="back-content">
                        <h3><?php echo $picname ?></h3>
                        <h6><i>By </i><?php echo $author ?></h6>
                        <a href="<?php echo $src?>"data-lightbox="gallery"><i class="fa fa-expand"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <?php
      }

    }

?>

<script type="text/javascript">
lightbox.option({
 'resizeDuration': 200,
 'wrapAround': true
})
</script>
<?php
  }



  function get_gallery_content()
  {
    if(isset($_GET['page']))  //we need two things , page number and no. of images per page.
    {
        $page=(int)$_GET['page'];
    }
    else {
      $page=$_GET['page']=1;
    }
    if(isset($_GET['per_page'])&&($_GET['per_page']<21))
    {
      $per_page=$_GET['per_page'];
    }
    else {
      $per_page=3;
    }
    $approved=1;
    $total_query="SELECT * from pics where approved='$approved'";
    $total=mysql_num_rows(mysql_query($total_query));//to get the no. of images so we are retrieving the no. of rows we are getting
    $pages=ceil($total/$per_page);//no. of pages ,to make it round of we have ceil function in php.
    //echo $pages;
    $start=($page*$per_page)-$per_page;//needed for query purpose , if at 1st page so start will be 0 , we want images to be shown from 1 to 3so index will be from 0 to 2.
    //echo $start;
    $query="SELECT * from pics where approved='$approved' limit $start,$per_page";//that is length from 0 to 2 i.e length is 3;
    $query_run=mysql_query($query);
    if(mysql_num_rows($query_run)>0){
      while($row=mysql_fetch_assoc($query_run))
      {
        $picname=$row['picname'];
        $pid=$row['pid'];
        $author=$row['username'];
        $src='uploads/'.$author.'/'.$picname;
        ?>
        <div class="col-md-4">
            <div class="gallery-image">
                <img src="<?php echo $src;?>" class="front">
                <div class="back">
                    <div class="back-content">
                        <h3><?php echo $picname ?></h3>
                        <h6><i>By </i><?php echo $author ?></h6>
                        <a href="<?php echo $src?>"data-lightbox="gallery"><i class="fa fa-expand"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <?php
      }

    }
?>
<div class="clearfix">

</div>
<div id="pagination">
  <?php
  for($i=1;$i<=$pages;$i++)
  {
    ?>
    <a href="?page=<?php echo $i.'&perpage='.$per_page;?>">Page<?php echo $i; ?></a>
    <?php
  }
   ?>
</div>
<script type="text/javascript">
lightbox.option({
 'resizeDuration': 200,
 'wrapAround': true
})
</script>
<?php
  }


  function get_profile_info($username){
    $fname="";
    $lname="";
    $email="";
    $bio="";

    $query="select * from users where username='$username'";
    $query_run=mysql_query($query);
    if(mysql_num_rows($query_run)>0){
      echo "<div class='col-md-3'>
              First Name :<br>
              Last Name :<br>
              Email :<br>
              Bio :<br>
              </div>";
              while($row=mysql_fetch_assoc($query_run)){
                echo "<div class='col-md-4'>";
                echo $fname=$row['fname'].'<br>';
                echo $lname=$row['lname'].'<br>';
                echo $email=$row['email'].'<br>';
                if($row['bio']==''){
                  echo 'you did not provide your bio yet<br>';
                }
                else{
                  echo $row['bio'];
                }
                  echo "</div>";
              }
    }
  }

  function get_avatar_image($user){
    $pic=0; //to check avatar folder contains only one image.
    $upload_folder="uploads"; //its  a folder
    $user_folder=$upload_folder.'/'.$user; //user folder
    $avatar_image_folder=$user_folder.'/avatar';

    if(is_dir($upload_folder)) //is Directory ...means if a folder exists or not.
    {
      if(is_dir($user_folder)){        //now if we have upload folder so we check for user folder

      }
      else {
        mkdir($user_folder);
      }
    }
    else { //if no such folder exists then we create one.
          mkdir($upload_folder);
          if(is_dir($user_folder)){

          }
          else {
            mkdir($user_folder);
          }
    }
    if(is_dir($avatar_image_folder)) {    //now for check for avatar_image_folder
      # code...
    }
    else {
      mkdir($avatar_image_folder);
    }
    if($handle=opendir($avatar_image_folder)){ //now we check for the avatar image in avatar_image_folder.only one image.
      while(false!==($entry=readdir($handle)))//not false means ..true..we check for permisiion for opening the folder then read it with readdir.
      {
        if (($entry!='.') and ($entry!='..')) {//there is no '.' or '..' in a file Name
          # code...
          $pic=1;//as if there is no '.' or '..' means there ia a pic.
          $avatar_image_path = $avatar_image_folder.'/'.$entry;
          echo "<img src=$avatar_image_path alt=$entry id=avatar-image-id width='300px'/>";
        }
      }
      closedir($handle);//we need to close the handle if we have opened it.
    }
    if($pic==0){
      echo "<img src='images/user-default.jpg'  id=avatar-image-id width='300px'/>"; //default profile pic.

    }
  }
  //uploaded pics
  function get_user_uploaded_pics($username){
    $query="SELECT * from pics where username='$username' order by pid desc";
    $query_run=mysql_query($query);
    if(mysql_num_rows($query_run)>0){
      while ($row=mysql_fetch_assoc($query_run)) {
        # code...
        $picid=$row['pid'];
        $picname=$row['picname'];
        $path='uploads/'.$username.'/'.$picname;
        ?>
        <div class="col-md-4">
              <img src="<?php echo $path;?>">
        </div>
        <?php
      }
    }
  }

  //admin function
  function get_unapproved_pics(){
          $approved=0;
          $query="SELECT * from pics where approved='$approved'";

          $queryrun=mysql_query($query);
          if(mysql_num_rows($queryrun)>0){
            while($row=mysql_fetch_assoc($queryrun))
            {
              $pid=$row['pid'];
              $picname=$row['picname'];
              $uname=$row['username'];
              $src='uploads/'.$uname.'/'.$picname;
              ?>
                  <div id="row-<?php echo $pid?>">
                      <div class="col-md-4">
                        <img src="<?php echo $src; ?>"id="<?php echo $pid;?>"/>
                      </div>
                      <div class="col-md-4">
                            <?php echo $picname;?>
                      </div>
                      <div class="col-md-4">
                            <button id="yes-<?php echo $pid;?>"onclick="approveimage(<?php echo $pid;?>)">YES</button>
                            <button id="no-<?php echo $pid;?>"onclick="deleteimage(<?php echo $pid;?>)">No</button>
                          </div>
                  </div>
                  <div class="clearfix">
                  </div>
              <?php
            }
          }
  }
 ?>
