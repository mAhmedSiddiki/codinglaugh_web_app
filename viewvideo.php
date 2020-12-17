<?php
ob_start();
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: logininvite");
}
require_once "config.php";
?>








<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>codinglaugh - view video</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/footer.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">
  <link rel="stylesheet" href="css/list.css">

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  
  


  <script async>(function(w, d) { w.CollectId = "5e81c4df080ddb1058a71cda"; var h = d.head || d.getElementsByTagName("head")[0]; var s = d.createElement("script"); s.setAttribute("type", "text/javascript"); s.setAttribute("src", "https://collectcdn.com/launcher.js"); h.appendChild(s); })(window, document);</script>

  <style>
    code[class*="language-"],
    pre[class*="language-"] {
        max-height: 614px;
    }
    .commentContainer{
        overflow-x: scroll;
    }


    /* width */
::-webkit-scrollbar {
  width: 08px;
}

/* Track */
::-webkit-scrollbar-track {
  box-shadow: inset 0 0 05px #FA8BFF; 
  border-radius: 20px;
  
}
 
/* Handle */
::-webkit-scrollbar-thumb {
  background: #ff002aa6; 
  border-radius: 20px;
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
  background: #FF2B4E; 
}

    .scroll_change{
      overflow-y: scroll;
      height: 500px;
    }

    .hey{
      background-color: #007b5e;
    }
    @media (max-width: 991px) {
    .customClassForDropDown{
          height:340px;
          overflow-y:auto;
       }
    }
.dropdown-item{
  color: black;
}
.dropdown-item:hover {
    color: white;
    background-color: #85FFBD;
    font-weight: bold;
    background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);
}
</style>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light fixed-top" style="background-color: #FA8BFF;background-image: linear-gradient(45deg, #FA8BFF 0%, #2BD2FF 52%, #2BFF88 90%);">
    <div class="container">
      <a class="navbar-brand" href="index"><img width="140px" height="30px" src="img/codinglaugh.png" alt=""></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" style="font-size: 14px;" href="index">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" style="font-size: 14px;" href="course">Course</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="font-size: 14px;" href="blog">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="font-size: 14px;" href="contact">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="font-size: 14px;" href="about">About</a>
          </li>
          <li class="nav-item"  data-toggle="tooltip" data-placement="bottom" title="codinglaugh account">
                <a class="nav-link dropdown-toggle active" style="font-size: 14px;" href="#" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <?php 
                  $sql = "SELECT username,img_file,firstname,lastname,email FROM users";
                  $result = mysqli_query($conn, $sql);
                
                  if (mysqli_num_rows($result) > 0){
                    // output data of each row
                    while($row = mysqli_fetch_assoc($result)) {
                      $username = $row["username"];
                      $img_file = $row["img_file"];
                      $firstname = $row["firstname"];
                      $lastname = $row["lastname"];
                      $email = $row["email"];

                      
                      if($username == $_SESSION['username']){
                        ?>
                          <img width="25px" class="rounded-circle" src="img/user/<?php echo $img_file;?>" alt=""> <?php echo "<b>".$_SESSION['username']."</b>" ?>
                  
                </a>
                <div style="border-radius: 10px;box-shadow:0px 0px 10px 10px rgba(0,0,0,0.5);font-size:14px; background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);" class="text-center dropdown-menu p-2 mr-5 mb-3 ml-5 mt-3 dropdown-menu-right customClassForDropDown" aria-labelledby="navbarDropdownBlog">
                  <center><a style="color: black;" class="dropdown-item disabled" href="#"><img style="box-shadow: 0px 0px 10px 4px black;" width="200" class="rounded-circle mt-3 mb-3" src="img/user/<?php echo $img_file;?>" alt=""><br>
                  <?php echo $email;?><br>
                  <?php echo "<b>".$firstname." ".$lastname."</b>" ?></a></center><hr>
                  <?php
                      }}} 
                ?>
                  <a class="dropdown-item" href="profile">My Account</a>
                  <a class="dropdown-item" href="logout">Logout</a>
                </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<div class="container">



<!--send comment-->
  <?php
  $text = $username = $slug = "";

  $username = $_SESSION['username'];
  $slug = $_GET['slug'];
  error_reporting(0);

  if ($_SERVER['REQUEST_METHOD'] == "POST"){

    if(!(empty(trim($_POST['comment']))) || !(empty(trim($_POST['replytext'])))){
    if(empty(trim($_POST['comment']))){
      $text = trim($_POST['replytext']);
      $hiddenslug = trim($_POST['hiddenuser']).$slug;

      $sql = "INSERT INTO reply (username, reply, slug) VALUES (?, ?, ?)";
      $stmt = mysqli_prepare($conn, $sql);
      if ($stmt)
      {
        mysqli_stmt_bind_param($stmt, "sss",$param_username, $param_reply, $param_slug);

        // Set these parameters
        $param_username = $username;
        $param_reply = $text;
        $param_slug = $hiddenslug;

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
        ?> 
          <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> Your reply is successfully send.
          </div>
          <?php
        }
        else{
          ?> 
          <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Wrong!</strong> Your reply is not send.
          </div>
          <?php
        }
      }
      mysqli_stmt_close($stmt);
    }else if(empty(trim($_POST['replytext']))){
      $text = trim($_POST['comment']);
      $sql = "INSERT INTO comment (username, comment, slug) VALUES (?, ?, ?)";
      $stmt = mysqli_prepare($conn, $sql);
      if ($stmt)
      {
        mysqli_stmt_bind_param($stmt, "sss",$param_username, $param_comment, $param_slug);

        // Set these parameters
        $param_username = $username;
        $param_comment = $text;
        $param_slug = $slug;

        // Try to execute the query
        if (mysqli_stmt_execute($stmt))
        {
        ?> 
          <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> Your Comment is successfully send.
          </div>
          <?php
        }
        else{
          ?> 
          <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> Your Comment is not send.
          </div>
          <?php
        }
      }
      mysqli_stmt_close($stmt);
    }
  }    
  }

?>
































  























































<?php
  
  $text = $_GET["slug"];
  
  if("file" == substr("$text",0,4)){
    $sql = "SELECT sno, title, content, question, slug, img_file, video_url,code, madeby FROM filehandling";
    $result = mysqli_query($conn, $sql);
    $found = 0;

    if (mysqli_num_rows($result) > 0){
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        $sno = $row["sno"];
        $title = $row["title"];
        $content = $row["content"];
        $question = $row["question"];
        $slug = $row["slug"];
        $img_file = $row["img_file"];
        $video_url = $row["video_url"];
        $code = $row["code"];
        $madeby = $row["madeby"];

        if($slug == $_GET["slug"]){
          $serial = $sno;
          $found = $found+1;
          ?>
            <!-- Page Heading/Breadcrumbs -->
            <h4 class="mt-4 mb-3"><?php echo $title; ?>
              <small>by
                <a href="marjuk" target="_blank">Marjuk Ahmed Siddiki</a>
              </small>
            </h4>
            
            <hr>

            <div class="row">

              <!-- Post Content Column -->
              <div class="col-lg-9">
                <!-- Preview Video -->
                <div class="container videoContainer embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="<?php echo $video_url;?>" allowfullscreen></iframe>
                </div>
                <hr>
              <div class="container-fluid overflow-hidden">
                <?php
                  if($sno < 14 && $sno > 1){
                    ?>
                  <a class="btn btn-sm w-25 float-right" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=file_python_<?php echo $sno=$sno+1;?>">Next</a>
                  <a class="btn btn-sm w-25 float-left" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=file_python_<?php echo $serial=$serial-1;?>">Previous</a>
                <?php  
                }else if($sno > 1){
                  ?>
                  <a class="btn btn-sm w-25 float-left" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=file_python_<?php echo $serial=$serial-1;?>">Previous</a>
                  <a class="btn btn-sm w-25 float-right disabled" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=file_python_<?php echo $sno=$sno+1;?>">Next</a>
                <?php
                }else if($sno == 1){
                  ?>
                  <a class="btn btn-sm w-25 float-left disabled" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=file_python_<?php echo $serial=$serial-1;?>">Previous</a>
                  <a class="btn btn-sm w-25 float-right" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=file_python_<?php echo $sno=$sno+1;?>">Next</a>
                <?php
                }
                ?>

              </div>
              <hr>
                <!-- Date/Time -->
                <div class="card">
                  <div class="card-body">
                    <script src="https://apis.google.com/js/platform.js"></script>
                    <center><div class="g-ytsubscribe" data-channelid="UCtPoYxNA8UtdQg4aCNkS7Dg" data-layout="full" data-count="default"></div></center>
                  </div>
                </div>
                <hr>
            <nav class="nav-justified" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);">
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a style="color: black; font-size:14px;" class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><b>Description</b></a>
                <a style="color: black; font-size:14px;" class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><b>Code</b></a>
                <a style="color: black; font-size:14px;" class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><b>Exercise</b></a>
                <a style="color: black; font-size:14px;" class="nav-item nav-link" id="nav-contactt-tab" data-toggle="tab" href="#nav-contactt" role="tab" aria-controls="nav-contactt" aria-selected="false"><b>Contact</b></a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active p-3 mb-2" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <textarea readonly type="text" rows="7" name="about" cols="" class="form-control" id="validationCustom03" required placeholder="Hope you understand view this video" style="resize:none; border: none; font-size: 14px; text-align: justify; background-color: white;"><?php echo $content;?></textarea>
              </div>
              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
              <pre class='language-python border rounded p-3 mb-2 text-white' style="background-color: #002b36;">
                <code height='50%'>
<?php
   $file = "code/Python_File_Handling/".$code;
  $document = file_get_contents($file);
   echo $document;
?>
                </code></pre>
              </div>
              <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
              <textarea readonly type="text" rows="7" name="about" cols="" class="form-control" id="validationCustom03" required placeholder="Comming soon question paper" style="color: red; resize:none; border: none; font-size: 14px; text-align: justify; background-color: white;"><?php echo $question;?></textarea>
              </div>
              <div class="tab-pane fade p-3 mb-2" id="nav-contactt" role="tabpanel" aria-labelledby="nav-contactt-tab">
                <p style="font-size: 14px;"><b>Created by:</b><br>
                  Marjuk Ahmed Siddiki<br>
                  Computer Science And Engineering<br>
                  Daffodil International University</p>
                  <ul class="list-unstyled list-inline social">
                    <li class="list-inline-item"><a href="https://web.facebook.com/marjuk.tnssj" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="https://twitter.com/marjuk_ahmed0" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.youtube.com/channel/UCtPoYxNA8UtdQg4aCNkS7Dg" target="_blank"><i class="fa fa-youtube"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.instagram.com/marjuk_t/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="https://github.com/Marjuk-Ahmed-Siddiki" target="_blank"><i class="fa fa-github"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.linkedin.com/in/marjukahmed/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                  </ul>
              </div>
            </div>
          <?php
        }
      }if($found==0){
        header("location: notfound");
      }
    }
  }else if("python" == substr("$text",0,6)){
    $sql = "SELECT sno, title, content, question, slug, img_file, video_url,code, madeby FROM pythonvideo";
    $result = mysqli_query($conn, $sql);
    $found = 0;

    if (mysqli_num_rows($result) > 0){
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        $sno = $row["sno"];
        $title = $row["title"];
        $content = $row["content"];
        $question = $row["question"];
        $slug = $row["slug"];
        $img_file = $row["img_file"];
        $video_url = $row["video_url"];
        $code = $row["code"];
        $madeby = $row["madeby"];

        if($slug == $_GET["slug"]){
          $serial = $sno;
          $found = $found+1;
          ?>
            <!-- Page Heading/Breadcrumbs -->
            <h4 class="mt-4 mb-3"><?php echo $title; ?>
              <small>by
                <a href="marjuk" target="_blank">Marjuk Ahmed Siddiki</a>
              </small>
            </h4>
            
            <hr>

            <div class="row">

              <!-- Post Content Column -->
              <div class="col-lg-9">
                <!-- Preview Video -->
                <div class="container videoContainer embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="<?php echo $video_url;?>" allowfullscreen></iframe>
                </div>
                <hr>
              <div class="container-fluid overflow-hidden">
                <?php
                  if($sno < 86 && $sno > 1){
                    ?>
                  <a class="btn btn-sm w-25 float-right" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=python_video_<?php echo $sno=$sno+1;?>">Next</a>
                  <a class="btn btn-sm w-25 float-left" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=python_video_<?php echo $serial=$serial-1;?>">Previous</a>
                <?php  
                }else if($sno > 1){
                  ?>
                  <a class="btn btn-sm w-25 float-left" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=python_video_<?php echo $serial=$serial-1;?>">Previous</a>
                  <a class="btn btn-sm w-25 float-right disabled" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=python_video_<?php echo $sno=$sno+1;?>">Next</a>
                <?php
                }else if($sno == 1){
                  ?>
                  <a class="btn btn-sm w-25 float-left disabled" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=python_video_<?php echo $serial=$serial-1;?>">Previous</a>
                  <a class="btn btn-sm w-25 float-right" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=python_video_<?php echo $sno=$sno+1;?>">Next</a>
                <?php
                }
                ?>

              </div>
              <hr>
                <!-- Date/Time -->
                <div class="card">
                  <div class="card-body">
                    <script src="https://apis.google.com/js/platform.js"></script>
                    <center><div class="g-ytsubscribe" data-channelid="UCtPoYxNA8UtdQg4aCNkS7Dg" data-layout="full" data-count="default"></div></center>
                  </div>
                </div>
                <hr>
            <nav class="nav-justified" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);">
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a style="color: black; font-size:14px;" class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><b>Description</b></a>
                <a style="color: black; font-size:14px;" class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><b>Code</b></a>
                <a style="color: black; font-size:14px;" class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><b>Exercise</b></a>
                <a style="color: black; font-size:14px;" class="nav-item nav-link" id="nav-contactt-tab" data-toggle="tab" href="#nav-contactt" role="tab" aria-controls="nav-contactt" aria-selected="false"><b>Contact</b></a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active p-3 mb-2" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
              <textarea readonly type="text" rows="7" name="about" cols="" class="form-control" id="validationCustom03" required placeholder="Hope you understand view this video" style="resize:none; border: none; font-size: 14px; text-align: justify; background-color: white;"><?php echo $content;?></textarea>
              </div>
              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
              <pre class='language-python border rounded p-3 mb-2 text-white' style="background-color: #002b36;">
                <code height='50%'>
<?php
   $file = "code/Python_Basic/".$code;
  $document = file_get_contents($file);
   echo $document;
?>
                </code></pre>
              </div>
              <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
              <textarea readonly type="text" rows="7" name="about" cols="" class="form-control" id="validationCustom03" required placeholder="Comming soon question paper" style="color: red; resize:none; border: none; font-size: 14px; text-align: justify; background-color: white;"><?php echo $question;?></textarea>
              </div>
              <div class="tab-pane fade p-3 mb-2" id="nav-contactt" role="tabpanel" aria-labelledby="nav-contactt-tab">
                <p style="font-size: 14px;"><b>Created by:</b><br>
                  Marjuk Ahmed Siddiki<br>
                  Computer Science And Engineering<br>
                  Daffodil International University</p>
                  <ul class="list-unstyled list-inline social">
                    <li class="list-inline-item"><a href="https://web.facebook.com/marjuk.tnssj" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="https://twitter.com/marjuk_ahmed0" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.youtube.com/channel/UCtPoYxNA8UtdQg4aCNkS7Dg" target="_blank"><i class="fa fa-youtube"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.instagram.com/marjuk_t/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="https://github.com/Marjuk-Ahmed-Siddiki" target="_blank"><i class="fa fa-github"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.linkedin.com/in/marjukahmed/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                  </ul>
              </div>
            </div>
          <?php
        }
      }if($found==0){
        header("location: notfound");
      }
    }
  }else if("pattern" == substr("$text",0,7)){
    $sql = "SELECT sno, title, content, question, slug, img_file, video_url,code, madeby FROM pythonpattern";
    $result = mysqli_query($conn, $sql);
    $found = 0;

    if (mysqli_num_rows($result) > 0){
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        $sno = $row["sno"];
        $title = $row["title"];
        $content = $row["content"];
        $question = $row["question"];
        $slug = $row["slug"];
        $img_file = $row["img_file"];
        $video_url = $row["video_url"];
        $code = $row["code"];
        $madeby = $row["madeby"];

        if($slug == $_GET["slug"]){
          $serial = $sno;
          $found = $found+1;
          ?>
            <!-- Page Heading/Breadcrumbs -->
            <h4 class="mt-4 mb-3"><?php echo $title; ?>
              <small>by
                <a href="marjuk" target="_blank">Marjuk Ahmed Siddiki</a>
              </small>
            </h4>
            
            <hr>

            <div class="row">

              <!-- Post Content Column -->
              <div class="col-lg-9">
                <!-- Preview Video -->
                <div class="container videoContainer embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="<?php echo $video_url;?>" allowfullscreen></iframe>
                </div>
                <hr>
              <div class="container-fluid overflow-hidden">
                <?php
                  if($sno < 52 && $sno > 1){
                    ?>
                  <a class="btn btn-sm w-25 float-right" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=pattern_video_<?php echo $sno=$sno+1;?>">Next</a>
                  <a class="btn btn-sm w-25 float-left" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=pattern_video_<?php echo $serial=$serial-1;?>">Previous</a>
                <?php  
                }else if($sno > 1){
                  ?>
                  <a class="btn btn-sm w-25 float-left" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=pattern_video_<?php echo $serial=$serial-1;?>">Previous</a>
                  <a class="btn btn-sm w-25 float-right disabled" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=pattern_video_<?php echo $sno=$sno+1;?>">Next</a>
                <?php
                }else if($sno == 1){
                  ?>
                  <a class="btn btn-sm w-25 float-left disabled" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=pattern_video_<?php echo $serial=$serial-1;?>">Previous</a>
                  <a class="btn btn-sm w-25 float-right" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=pattern_video_<?php echo $sno=$sno+1;?>">Next</a>
                <?php
                }
                ?>

              </div>
              <hr>
                <!-- Date/Time -->
                <div class="card">
                  <div class="card-body">
                    <script src="https://apis.google.com/js/platform.js"></script>
                    <center><div class="g-ytsubscribe" data-channelid="UCtPoYxNA8UtdQg4aCNkS7Dg" data-layout="full" data-count="default"></div></center>
                  </div>
                </div>
                <hr>
            <nav class="nav-justified" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);">
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a style="color: black; font-size:14px;" class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><b>Description</b></a>
                <a style="color: black; font-size:14px;" class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><b>Code</b></a>
                <a style="color: black; font-size:14px;" class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><b>Exercise</b></a>
                <a style="color: black; font-size:14px;" class="nav-item nav-link" id="nav-contactt-tab" data-toggle="tab" href="#nav-contactt" role="tab" aria-controls="nav-contactt" aria-selected="false"><b>Contact</b></a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active p-3 mb-2" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
              <textarea readonly type="text" rows="7" name="about" cols="" class="form-control" id="validationCustom03" required placeholder="Hope you understand view this video" style="resize:none; border: none; font-size: 14px; text-align: justify; background-color: white;"><?php echo $content;?></textarea>
              </div>
              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
              <pre class='language-python border rounded p-3 mb-2 text-white' style="background-color: #002b36;">
                <code height='50%'>
<?php
   $file = "code/Python_Pattern/01 Introduction.py";
  $document = file_get_contents($file);
   echo $document;
?>
                </code></pre>
              </div>
              <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
              <textarea readonly type="text" rows="7" name="about" cols="" class="form-control" id="validationCustom03" required placeholder="Comming soon question paper" style="color: red; resize:none; border: none; font-size: 14px; text-align: justify; background-color: white;"><?php echo $question;?></textarea>
              </div>
              <div class="tab-pane fade p-3 mb-2" id="nav-contactt" role="tabpanel" aria-labelledby="nav-contactt-tab">
                <p style="font-size: 14px;"><b>Created by:</b><br>
                  Marjuk Ahmed Siddiki<br>
                  Computer Science And Engineering<br>
                  Daffodil International University</p>
                  <ul class="list-unstyled list-inline social">
                    <li class="list-inline-item"><a href="https://web.facebook.com/marjuk.tnssj" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="https://twitter.com/marjuk_ahmed0" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.youtube.com/channel/UCtPoYxNA8UtdQg4aCNkS7Dg" target="_blank"><i class="fa fa-youtube"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.instagram.com/marjuk_t/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="https://github.com/Marjuk-Ahmed-Siddiki" target="_blank"><i class="fa fa-github"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.linkedin.com/in/marjukahmed/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                  </ul>
              </div>
            </div>
          <?php
        }
      }if($found==0){
        header("location: notfound");
      }
    }
  }else if("oop" == substr("$text",0,3)){
    $sql = "SELECT sno, title, content, question, slug, img_file, video_url,code, madeby FROM ooppython";
    $result = mysqli_query($conn, $sql);
    $found = 0;
    if (mysqli_num_rows($result) > 0){
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        $sno = $row["sno"];
        $title = $row["title"];
        $content = $row["content"];
        $question = $row["question"];
        $slug = $row["slug"];
        $img_file = $row["img_file"];
        $video_url = $row["video_url"];
        $code = $row["code"];
        $madeby = $row["madeby"];

        if($slug == $_GET["slug"]){
          $serial = $sno;
          $found = $found+1;
          ?>
            <!-- Page Heading/Breadcrumbs -->
            <h4 class="mt-4 mb-3"><?php echo $title; ?>
              <small>by
                <a href="marjuk" target="_blank">Marjuk Ahmed Siddiki</a>
              </small>
            </h4>
            
            <hr>

            <div class="row">

              <!-- Post Content Column -->
              <div class="col-lg-9">
                <!-- Preview Video -->
                <div class="container videoContainer embed-responsive embed-responsive-16by9">
                  <iframe class="embed-responsive-item" src="<?php echo $video_url;?>" allowfullscreen></iframe>
                </div>
                <hr>
              <div class="container-fluid overflow-hidden">
                <?php
                  if($sno < 22 && $sno > 1){
                    ?>
                  <a class="btn btn-sm w-25 float-right" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=oop_video_<?php echo $sno=$sno+1;?>">Next</a>
                  <a class="btn btn-sm w-25 float-left" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=oop_video_<?php echo $serial=$serial-1;?>">Previous</a>
                <?php  
                }else if($sno > 1){
                  ?>
                  <a class="btn btn-sm w-25 float-left" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=oop_video_<?php echo $serial=$serial-1;?>">Previous</a>
                  <a class="btn btn-sm w-25 float-right disabled" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=oop_video_<?php echo $sno=$sno+1;?>">Next</a>
                <?php
                }else if($sno == 1){
                  ?>
                  <a class="btn btn-sm w-25 float-left disabled" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=oop_video_<?php echo $serial=$serial-1;?>">Previous</a>
                  <a class="btn btn-sm w-25 float-right" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=oop_video_<?php echo $sno=$sno+1;?>">Next</a>
                <?php
                }
                ?>

              </div>
              <hr>
                <!-- Date/Time -->
                <div class="card">
                  <div class="card-body">
                    <script src="https://apis.google.com/js/platform.js"></script>
                    <center><div class="g-ytsubscribe" data-channelid="UCtPoYxNA8UtdQg4aCNkS7Dg" data-layout="full" data-count="default"></div></center>
                  </div>
                </div>
                <hr>
            <nav class="nav-justified" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);">
              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a style="color: black; font-size:14px;" class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><b>Description</b></a>
                <a style="color: black; font-size:14px;" class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><b>Code</b></a>
                <a style="color: black; font-size:14px;" class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false"><b>Exercise</b></a>
                <a style="color: black; font-size:14px;" class="nav-item nav-link" id="nav-contactt-tab" data-toggle="tab" href="#nav-contactt" role="tab" aria-controls="nav-contactt" aria-selected="false"><b>Contact</b></a>
              </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active p-3 mb-2" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
              <textarea readonly type="text" rows="7" name="about" cols="" class="form-control" id="validationCustom03" required placeholder="Hope you understand view this video" style="resize:none; border: none; font-size: 14px; text-align: justify; background-color: white;"><?php echo $content;?></textarea>
              </div>
              <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
              <pre class='language-python border rounded p-3 mb-2 text-white' style="background-color: #002b36;">
                <code height='50%'>
<?php
   $file = "code/Python_Object_Oriented_Programming/".$code;
  $document = file_get_contents($file);
   echo $document;
?>
                </code></pre>
              </div>
              <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
              <textarea readonly type="text" rows="7" name="about" cols="" class="form-control" id="validationCustom03" required placeholder="Comming soon question paper" style="color: red; resize:none; border: none; font-size: 14px; text-align: justify; background-color: white;"><?php echo $question;?></textarea>
              </div>
              <div class="tab-pane fade p-3 mb-2" id="nav-contactt" role="tabpanel" aria-labelledby="nav-contactt-tab">
                <p style="font-size: 14px;"><b>Created by:</b><br>
                  Marjuk Ahmed Siddiki<br>
                  Computer Science And Engineering<br>
                  Daffodil International University<br>
                  Mob: +8801796007871</p>
                  <ul class="list-unstyled list-inline social">
                    <li class="list-inline-item"><a href="https://web.facebook.com/marjuk.tnssj" target="_blank"><i class="fa fa-facebook"></i></a></li>
                    <li class="list-inline-item"><a href="https://twitter.com/marjuk_ahmed0" target="_blank"><i class="fa fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.youtube.com/channel/UCtPoYxNA8UtdQg4aCNkS7Dg" target="_blank"><i class="fa fa-youtube"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.instagram.com/marjuk_t/" target="_blank"><i class="fa fa-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="https://github.com/Marjuk-Ahmed-Siddiki" target="_blank"><i class="fa fa-github"></i></a></li>
                    <li class="list-inline-item"><a href="https://www.linkedin.com/in/marjukahmed/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                  </ul>
              </div>
            </div>
          <?php
        }
      }if($found==0){
        header("location: notfound");
      }
    }
  }else{
    header("location: notfound");
  }
?>




























<div class="row">
  <div class="col-lg-12 mb-4">
    <h5 style="color: #007b5e;">Leave a comment</h5>
    <form name="sentcomment" id="commentform" novalidate action="" method="post">
      <div class="control-group form-group">
        <div class="controls">
          <textarea rows="4" cols="100" class="form-control" name="comment" required placeholder="Write a comment here..." maxlength="999" style="resize:none"></textarea>
        </div>
      </div>
      <!-- For success/fail messages -->
      <button class="btn btn-sm" name="commentbtn" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);">Send Comment</button>
    </form>
  </div>

</div>






<!--comment-->
<div class="card rounded" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);">
  <div class="card-header" style="background-color: #FA8BFF;background-image: linear-gradient(45deg, #FA8BFF 0%, #2BD2FF 52%, #2BFF88 90%);">
    <h5 style="color: black;">Comments</h5>
  </div>

<?php
  $sqlc = "SELECT sno, username, slug, comment,currentdate FROM comment";
  $resultc = mysqli_query($conn, $sqlc);

  if (mysqli_num_rows($resultc) > 0){
    // output data of each row
    while($row = mysqli_fetch_assoc($resultc)) {
      $snoc = $row["sno"];
      $usernamec = $row["username"];
      $slugc = $row["slug"];
      $commentc = $row["comment"];
      $currentdatec = $row["currentdate"];

      if($slugc == $_GET['slug']){
        ?>

          <div class="card-body row">
            <div class="col-lg-1">
              <?php 
              $sql = "SELECT username,img_file FROM users";
              $result = mysqli_query($conn, $sql);
            
              if (mysqli_num_rows($result) > 0){
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                  $username = $row["username"];
                  $img_file = $row["img_file"];
                  
                  if($username == $usernamec){
                    ?>
                      <a href="viewprofile?slug=<?php echo $usernamec;?>"><img data-toggle="tooltip" data-placement="bottom" title="view profile" width="60px" class="rounded-circle" src="img/user/<?php echo $img_file;?>" alt=""></a>
                    <?php
                  }}} 
            ?>
            </div>
            <div class="col-lg-11">
              <a href="viewprofile?slug=<?php echo $usernamec;?>" style="color: darkblue;"><h5 data-toggle="tooltip" data-placement="bottom" title="view profile" class="card-title"><?php echo $usernamec; ?></a><small> at <?php echo $currentdatec; ?></small></h5>
              <p class="card-text"><?php echo $commentc;?></p>
              <p>
                <button style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" class="btn btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                  Reply
                </button>
              </p>
              
              <div class="collapse" id="collapseExample">
                <form name="sentreply" id="replyform" novalidate action="" method="post">
                  <div class="control-group form-group">
                    <div class="controls">
                      <input type="hidden" name="hiddenuser" value="<?php echo $usernamec ?>">
                      <textarea rows="3" cols="100" class="form-control" name="replytext" required placeholder="Write your reply here..." maxlength="999" style="resize:none"></textarea>
                    </div>
                  </div>
                  <button class="btn" name="sendbtn" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);">Send Reply</button>
                </form>
              </div>
            </div>
          </div>
          <!--reply-->
            <?php
              $sqlr = "SELECT sno, username, slug, reply, currentdate FROM reply";
              $resultr = mysqli_query($conn, $sqlr);

              if (mysqli_num_rows($resultr) > 0){
                // output data of each row
                while($row = mysqli_fetch_assoc($resultr)) {
                  $snor = $row["sno"];
                  $usernamer = $row["username"];
                  $slugr = $row["slug"];
                  $reply = $row["reply"];
                  $currentdater = $row["currentdate"];

                  if($usernamec == substr($slugr,0,strlen($usernamec)) && $_GET['slug'] == substr($slugr,strlen($usernamec),strlen($_GET['slug']))){
                    ?>

                    <div class="card-body mx-auto row" style="width: 90%">
                      <div class="col-lg-1">
                      <?php 
              $sql = "SELECT username,img_file FROM users";
              $result = mysqli_query($conn, $sql);
            
              if (mysqli_num_rows($result) > 0){
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                  $username = $row["username"];
                  $img_file = $row["img_file"];
                  
                  if($username == $usernamer){
                    ?>
                      <a href="viewprofile?slug=<?php echo $usernamer;?>"><img data-toggle="tooltip" data-placement="bottom" title="view profile" width="60px" class="rounded-circle" src="img/user/<?php echo $img_file;?>" alt=""></a>
                    <?php
                  }}} 
            ?>
                      </div>
                      &nbsp;&nbsp;
                      <div class="col-lg-10">
                        <a style="color: darkblue;" href="viewprofile?slug=<?php echo $usernamer;?>"><h5 data-toggle="tooltip" data-placement="bottom" title="view profile" class="card-title"><?php echo $usernamer; ?></a> <small>at <?php echo $currentdater; ?></small></h5>
                        <p class="card-text"><?php echo $reply; ?></p>
                      </div>
                    </div>
                    
                    <?php
                  }
                }
              }
            ?>
          


          <hr class="bg-success">
          
          
        

        <?php
      }
    }
    ?>
    <div class="mx-auto"><h6 style="color: black;" class="card-title">Please comment your feelings to learn programming</h6></div>
    <?php
  }
?>

</div>

  




  























<br>




<div class="rounded" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);">
<center><h2 style="color: #007b5e;">Our Courses</h2></center>
<div class="row">
<?php 
  //video_playlist configure
  $sql = "SELECT sno, slug, img_file FROM video_playlist";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0){
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $sno = $row["sno"];
      $slug = $row["slug"];
      $img_file = $row["img_file"];
      ?>

      <div class="col-lg-3 col-sm-4 mb-4">
        <a href="python1?slug=<?php echo $slug;?>"><img class="img-fluid img-thumbnail rounded-circle" src="img/python/video_playlist/<?php echo $img_file ?>" alt=""></a>
      </div>
      
      <?php
    }
  }
?>
</div>
</div>




</div>






































  <div class="col-md-3">
  <center><h6 class="list-group-item" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);"><marquee scrollamount="5" width="40">&lt;&lt;&lt;</marquee>Recommended<marquee scrollamount="5" direction="right" width="40">&gt;&gt;&gt;</marquee></h6></center>
  <ul class="list-group scroll_change" height='50%'>

  
  <?php
  
  $text = $_GET["slug"];
  
  if("file" == substr("$text",0,4)){
    $sql = "SELECT sno, title, content, question, slug, img_file, video_url,code, madeby FROM filehandling";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        $sno = $row["sno"];
        $title = $row["title"];
        $slug = $row["slug"];

        if($slug == $_GET["slug"]){
          ?>
                  
            <small><a href="viewvideo?slug=<?php echo $slug;?>" class="font-weight-bold list-group-item list-group-item-action rounded-pill" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);"><?php echo $title; ?></a></small>
          
          <?php                  
              }else{
              ?>

          <small><a href="viewvideo?slug=<?php echo $slug;?>" class="text-dark list-group-item list-group-item-action" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);"><?php echo $title; ?></a></small>

                <?php
              }
        
      }
    }
  }else if("python" == substr("$text",0,6)){
    $sql = "SELECT sno, title, content, question, slug, img_file, video_url,code, madeby FROM pythonvideo";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        $sno = $row["sno"];
        $title = $row["title"];
        $slug = $row["slug"];

        if($slug == $_GET["slug"]){
          ?>
                  
            <small><a href="viewvideo?slug=<?php echo $slug;?>" class="font-weight-bold list-group-item list-group-item-action rounded-pill" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);"><?php echo $title; ?></a></small>
          
          <?php                  
              }else{
              ?>

          <small><a href="viewvideo?slug=<?php echo $slug;?>" class="text-dark list-group-item list-group-item-action" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);"><?php echo $title; ?></a></small>

                <?php
              }
      }
    }
  }else if("pattern" == substr("$text",0,7)){
    $sql = "SELECT sno, title, content, question, slug, img_file, video_url,code, madeby FROM pythonpattern";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        $sno = $row["sno"];
        $title = $row["title"];
        $slug = $row["slug"];

        if($slug == $_GET["slug"]){
          ?>
                  
            <small><a href="viewvideo?slug=<?php echo $slug;?>" class="font-weight-bold list-group-item list-group-item-action rounded-pill" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);"><?php echo $title; ?></a></small>
          
          <?php                  
              }else{
              ?>

          <small><a href="viewvideo?slug=<?php echo $slug;?>" class="text-dark list-group-item list-group-item-action" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);"><?php echo $title; ?></a></small>

                <?php
              }
      }
    }
  }else if("oop" == substr("$text",0,3)){
    $sql = "SELECT sno, title, content, question, slug, img_file, video_url,code, madeby FROM ooppython";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        $sno = $row["sno"];
        $title = $row["title"];
        $slug = $row["slug"];

        if($slug == $_GET["slug"]){
          ?>
                  
            <small><a href="viewvideo?slug=<?php echo $slug;?>" class="font-weight-bold list-group-item list-group-item-action rounded-pill" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);"><?php echo $title; ?></a></small>
          
          <?php                  
              }else{
              ?>

          <small><a href="viewvideo?slug=<?php echo $slug;?>" class="text-dark list-group-item list-group-item-action" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);"><?php echo $title; ?></a></small>

                <?php
              }
      }
    }
  }
?>
   </ul>
   
 
 </div>



 
  
</div>



<!-- /.row -->

</div>
<!-- /.container -->


























<br>
<?php include('footer.php'); ?>