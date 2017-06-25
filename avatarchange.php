  <?php
  session_start();
    $pic=0;
    $filetodelete= "";
    $filename = $_FILES['avatar']['name']; //the avatar we appended in main.js
    //echo $filename;
    $tmpname = $_FILES['avatar']['tmp_name'];
    $session = $_SESSION['user'];
    $avatar_image_folder='uploads/'.$session.'/avatar';
    $destination = 'uploads/'.$session.'/avatar/'.$filename; //where the avatar mage is gping to get uploaded.

    move_uploaded_file($tmpname, $destination);//to move the file we have in built function.

    if($handle=opendir($avatar_image_folder)){ //now we check for the avatar image in avatar_image_folder.only one image.
      while(false!==($entry=readdir($handle)))//not false means ..true..we check for permisiion for opening the folder then read it with readdir.
      {
        if (($entry!='.') and ($entry!='..') and ($entry!=$filename)) {//there is no '.' or '..' in a file Name and the same filename
          # code...
          $pic=1;//as if there is no '.' or '..' means there ia a pic.
          $filetodelete=$entry;//as if v change the pic v need to delete the older pic as avatar pic is only one
        }
      }
      closedir($handle);
    }
    if($pic==1){
      if(unlink($avatar_image_folder.'/'.$filetodelete)) //default function to delete and v can only delete after the closing the handle
      {

      }
    }

    if($handle=opendir($avatar_image_folder)){ //now we check for the avatar image in avatar_image_folder.only one image.
      while(false!==($entry=readdir($handle)))//not false means ..true..we check for permisiion for opening the folder then read it with readdir.
      {
        if (($entry!='.') and ($entry!='..')) {//there is no '.' or '..' in a file Name
          # code...
            echo $avatar_image_path=$avatar_image_folder.'/'.$entry;
        }
      }
      closedir($handle);
    }

   ?>
