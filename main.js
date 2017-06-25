jQuery(document).ready(function(){

  "use strict";
  $(".rotate").textrotator({
  animation: "flip", // You can pick the way it animates when rotating through words. Options are dissolve (default), fade, flip, flipUp, flipCube, flipCubeUp and spin.
  separator: ",", // If you don't want commas to be the separator, you can define a new separator (|, &, * etc.) by yourself using this field.
  speed: 2000 // How many milliseconds until the next word show.
});
$(window).scroll(function(){
  var top = $(window).scrollTop(); //tells how much a user has scrolled
  if(top>=70){
    $("header").addClass('transparent-bg');
  }
    else
    {
      if($("header").hasClass('transparent-bg'))
      {
        $("header").removeClass('transparent-bg');
      }
    }
  });
$('#user-avatar-upload').on("change",function(){
        var avatarfile=$(this)[0].files[0];//returns the jquery and DOM object.1
        var type=avatarfile.type  //stores the type of image file.
        //alert (type);
        var type1=type.substring(type.indexOf("/")+1);//select all the characters after thi "/".
        //alert(type1);
        var size = avatarfile.size;//image size
        if(type1!="png" && type1!="jpg" && type1!="jpeg"){
          alert('file type is not supported');
        }
        else if (size>500000) //500kb's
        {
              alert('file size should be less than 500kb');
        }
        else
        {
            var formdata=new FormData();
            formdata.append('avatar',avatarfile);// appending the avatar file at 1.
            var xhr=new XMLHttpRequest();
            xhr.addEventListener("load",avatarloadedhandler,false);//event handler is on load
            xhr.open('POST','avatarchange.php');//sending request to avatar change.php
            xhr.send(formdata);

            function avatarloadedhandler(evt){
                $('#avatar-image-id').attr('src',evt.target.responseText);//to uplotad image dynamically v r retrieving the previous pic throught the id.
                }
        }
    });

//for uploading image
    $('#new-image').on("change",function(){
            var file=$(this)[0].files[0];//returns the jquery and DOM object.1
            var type=file.type  //stores the type of image file.
            //alert (type);
            var type1=type.substring(type.indexOf("/")+1);//select all the characters after thi "/".
            //alert(type1);
            var size = file.size;//image size
            if(type1!="png" && type1!="jpg" && type1!="jpeg"){
              alert('file type is not supported');
            }
            else if (size>500000) //500kb's
            {
                  alert('file size should be less than 500kb');
            }
            else
            {
                var formdata=new FormData();
                formdata.append('file1',file);// appending the avatar file at 1.
                var xhr=new XMLHttpRequest();
                xhr.addEventListener("load",loadedhandler,false);//event handler is on load
                xhr.open('POST','fileupload.php');//sending request to avatar change.php
                xhr.send(formdata);

                function loadedhandler(evt){
                        $('#user-uploaded-pics').prepend("<div class='col-md-4'><img src="+evt.target.responseText+"></div>");
                      //  alert(evt.target.responseText);

                      }

            }
        });
  });

  function approveimage(id){
    var rowid="row-"+id;
    $.ajax({
      url:'approve.php',
      data:{id:id},//data  to be passed ,the name and value are same that is id.
      type:'post',
      success:function(result){
          $('#row-'+id).hide(2000);
          //alert(result);
      }
    });
  }

  function deleteimage(id){
    var rowid="row-"+id;
    $.ajax({
      url:'delete.php',
      data:{id:id},//data  to be passed ,the name and value are same that is id.
      type:'post',
      success:function(result){
          $('#row-'+id).hide(2000);
          //alert(result);
      }
    });
  }
