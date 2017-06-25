<section class="registration">
  <div class="section-header center">
    <h1>Registration</h1>
    <h6><a href="index.php">Home</a> &gt; <span>Register</span></h6>
  </div>
  <div class="container">
    <div class="row">
        <form method="post" id="register-form" action="registration.php">
            <input type="text" name="fname" id="fname" placeholder="Enter first name" value="<?php
              if(isset($_POST['fname'])){echo $_POST['fname'];}?>"/>
            <input type="text" name="lname" id="lname" placeholder="Enter last name" value="<?php
              if(isset($_POST['lname'])){echo $_POST['lname'];}?>"/>
            <input type="text" name="username" id="username" placeholder="Choose a username" value="<?php
              if(isset($_POST['username'])){echo $_POST['username'];}?>"/>
            <input type="email" name="email" id="email" placeholder="Enter your email id"value="<?php
              if(isset($_POST['email'])){echo $_POST['email'];}?>"/>
            <input type="password" name="password" id="password" placeholder="Enter your password here"/>
            <input type="password" name="confirm-password" id="confirm-password" placeholder="Confirm your password here"/>
            <textarea name="bio" id="bio" placeholder="Enter your bio here(optional)"value="<?php
              if(isset($_POST['bio'])){echo $_POST['bio'];}?>"/></textarea>
            <input type="submit" name="submit" id="submit" value="Register" class="primary-bg"/>
        </form>
        <div id="error">

        </div>
        <div id="success">

        </div>
    </div>
  </div>
</section>
<?php
  include 'inc/db.inc.php';
  $fname="";
  $lname="";
  $username="";
  $password="";
  $email="";
  $bio="";
  $uploads=0;
  $id="";
  $error=array();
  function register($id,$fname,$lname,$username,$email,$password,$bio,$uploads){
      $newpwd=md5($password);
      $query="INSERT into users VALUES('$id','$fname','$lname','$username','$email','$newpwd','$bio','$uploads')";
      if (mysql_query($query)) {
        # code...
        ?>
        <script type="text/javascript">
          $('#success').append("You have been registered successfully.<a href='login.php'>Click here to login</a>");
        </script>
        <?php
      }
      else {
        # code...
        ?>
        <script type="text/javascript">
          $('#error').append("Error registering");
        </script>
        <?php
      }

  }
  function sanitize($data){
    $data=trim($data);
    $data=stripslashes($data);
    $data=htmlspecialchars($data);
    return $data;
  }
  if(isset($_POST['submit']))
  {
      //checking first name

      if (empty($_POST['fname'])) {
        # code...
        $error[]="First Name Required";
      }
      elseif(strlen($_POST['fname']>25)){  //in table v have given its length 25
        $error[]="First name should have maximum of 25 charaters";
      }
      else{
        $fname=sanitize($_POST['fname']);
      }
      // checking last name
      if (empty($_POST['lname'])) {
        # code...
        $error[]="Last Name Required";
      }
      elseif(strlen($_POST['lname']>25)){  //in table v have given its length 25
        $error[]="Last name should have maximum of 25 charaters";
      }
      else{
        $lname=sanitize($_POST['lname']);
      }
      //checkingusername
      if (empty($_POST['username'])) {
        # code...
        $error[]="Username Required";
      }
      elseif(strlen($_POST['username']>25)){  //in table v have given its length 25
        $error[]="Username should have maximum of 25 charaters";
      }
      else{
        $username=sanitize($_POST['username']);
      }
      //checking email
      if (empty($_POST['email'])) {
        # code...
        $error[]="Email Required";
      }
      elseif(strlen($_POST['email']>50)){  //in table v have given its length 25
        $error[]="Email should have maximum of 50 charaters";
      }
      elseif (!(filter_var($_POST['email'],FILTER_VALIDATE_EMAIL))) {//inbuilt function for email type
        # code...
        $error[]="Email id not a valid email address";
      }
      else{
        $email=sanitize($_POST['email']);
      }

  //checking password
  if (empty($_POST['password'])) {
    # code...
    $error[]="Password Required";
  }
  elseif(strlen($_POST['password']>32)){  //in table v have given its length 25
    $error[]="Password should have maximum of 32 charaters";
  }
  else{
    $password=sanitize($_POST['password']);
    if(!empty($_POST['confirm-password'])){
      if($_POST['password']!=$_POST['confirm-password']){
        $error[]="password and confirm password are not matching";
      }
    }
    else {
      $error[]="confirm your password";
    }
  }
   if(!empty($bio)){
     $bio=sanitize($_POST['bio']);
   }

   //checking for errors
   if(count($error)==0){
      $checkusername="select * from users where username='$username'";
      $runqueryusername=mysql_query($checkusername);

      $checkemail="select * from users where email='$email'";
      $runqueryemail=mysql_query($checkemail);

      if(mysql_num_rows($runqueryusername)>0){
        ?>
        <script type="text/javascript">
          $('#error').append("<?php echo 'Username Exists'."<br>";?>")
        </script>
        <?php
      }

      elseif(mysql_num_rows($runqueryemail)>0){
        ?>
        <script type="text/javascript">
          $('#error').append("<?php echo 'Email Exists'."<br>";?>");
        </script>
        <?php
      }
      else{
            register($id,$fname,$lname,$username,$email,$password,$bio,$uploads);
      }
   }
   else {
     foreach ($error as $key => $value) {
       # code...
       ?>
       <script type="text/javascript">
         $('#error').append("<?php echo $value."<br>";?>");
       </script>
       <?php

     }
   }
 }
 ?>
