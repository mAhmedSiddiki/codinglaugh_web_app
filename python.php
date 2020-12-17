<?php

session_start();

// check if the user is already logged in
if(isset($_SESSION['username'])){
    header("location: python1");
    exit;
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

  <title>codinglaugh - python</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/footer.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <script async>(function(w, d) { w.CollectId = "5e81c4df080ddb1058a71cda"; var h = d.head || d.getElementsByTagName("head")[0]; var s = d.createElement("script"); s.setAttribute("type", "text/javascript"); s.setAttribute("src", "https://collectcdn.com/launcher.js"); h.appendChild(s); })(window, document);</script>

  <style>
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
          <li class="nav-item">
            <a class="nav-link active" style="font-size: 14px;" href="login"><b>Login</b></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>





















































































  <div class="container">
<br>

<div class="row align-items-center justify-content-center">

<?php 
  //video_playlist configure
  $sql = "SELECT sno, title, content, slug, img_file, madeby FROM video_playlist";
  $result = mysqli_query($conn, $sql);

  $found = 0;

  if (mysqli_num_rows($result) > 0){
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $sno = $row["sno"];
      $title = $row["title"];
      $content = $row["content"];
      $slug = $row["slug"];
      $img_file = $row["img_file"];
      $madeby = $row["madeby"];
      
      if($slug == $_GET["slug"]){
        ?>
        <!-- Intro Content -->
          <img class="col-lg-4 img-fluid rounded-pill" src="img/python/video_playlist/<?php echo $img_file;?>" alt="">
          <div class="col-lg-4">
            <h4 style="color: #007b5e"><?php echo $title;?></h4>
            <p align="justify" style="font-size: 14px;"><?php echo $content; ?></p>
          </div>
        <?php
        $found = $found+1;
      }
    }
    if($found==0){
      header("location: notfound");
    }
  }
?>

<div class="col-lg-3" >
  
            <ul class="list-group" style="font-size: 14px;">
            <li class="list-group-item" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);"><center><h6 style="color: #007b5e"><marquee scrollamount="5" width="40">&lt;&lt;&lt;</marquee>More Playlist<marquee scrollamount="5" direction="right" width="40">&gt;&gt;&gt;</marquee></h6></center></li>
            <?php 
              $sql = "SELECT title, slug FROM video_playlist";
              $result = mysqli_query($conn, $sql);
            
              if (mysqli_num_rows($result) > 0){
                // output data of each row
                while($row = mysqli_fetch_assoc($result)) {
                  $title = $row["title"];
                  $slug = $row["slug"];

                  if($slug == $_GET["slug"]){
            ?>
                    
              <a href="python?slug=<?php echo $slug;?>" class="font-weight-bold list-group-item list-group-item-action" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);"><?php echo $title; ?></a>
            
            <?php                  
                }else{
                ?>

            <a href="python?slug=<?php echo $slug;?>" class="text-dark list-group-item list-group-item-action" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);"><?php echo $title; ?></a>

                  <?php
                }
              }
              }
            ?>
            </ul>
          </div>
</div>




<hr>
















































<div class="row rounded">
  
<?php
  if("python_basic" == $_GET["slug"]){
    $sql = "SELECT title, slug, img_file FROM pythonvideo";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        $title = $row["title"];
        $slug = $row["slug"];
        $img_file = $row["img_file"];
        ?>
        <div class="col-lg-3 portfolio-item">
          <div class="card h-100" style="box-shadow: 0px 0px 10px 4px black;">
            <a style="color: black; background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);" href="viewvideo?slug=<?php echo $slug;?>"><h6 class="card-header"><?php echo $title;?></h6></a>
            <div class="card-body" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);">
              <a href="viewvideo?slug=<?php echo $slug;?>"><img class="img-fluid rounded-pill" src="img/python/basic_python/<?php echo $img_file;?>" alt=""></a>
            </div>
            <div class="card-footer" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);">
              <a class="btn btn-block btn-sm" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=<?php echo $slug;?>"><b>View</b></a>
            </div>
          </div>
        </div>
        <?php
      }
  }
}else if("pattern_python" == $_GET["slug"]){
  $sql = "SELECT title, slug, img_file FROM pythonpattern";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0){
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $title = $row["title"];
      $slug = $row["slug"];
      $img_file = $row["img_file"];
      ?>
      <div class="col-lg-3 portfolio-item">
      <div class="card h-100" style="box-shadow: 0px 0px 10px 4px black;">
      <a style="color: black; background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);" href="viewvideo?slug=<?php echo $slug;?>"><h6 class="card-header"><?php echo $title;?></h6></a>
        <div class="card-body" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);">
          <a href="viewvideo?slug=<?php echo $slug;?>"><img class="img-fluid rounded-pill" src="img/python/pattern_python/<?php echo $img_file;?>" alt=""></a>
        </div>
        <div class="card-footer" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);">
        <a class="btn btn-block btn-sm" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=<?php echo $slug;?>"><b>View</b></a>
        </div>
      </div>
      </div>
      <?php
    }
  }
}else if("file_handling_python" == $_GET["slug"]){
  $sql = "SELECT title, slug, img_file FROM filehandling";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0){
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $title = $row["title"];
      $slug = $row["slug"];
      $img_file = $row["img_file"];
      ?>
      <div class="col-lg-3 portfolio-item">
      <div class="card h-100" style="box-shadow: 0px 0px 10px 4px black;">
        <a style="color: black; background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);" href="viewvideo?slug=<?php echo $slug;?>"><h6 class="card-header"><?php echo $title;?></h6></a>
        <div class="card-body" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);">
        <a href="viewvideo?slug=<?php echo $slug;?>"><img class="img-fluid rounded-pill" src="img/python/file_python/<?php echo $img_file;?>" alt=""></a>
        </div>
        <div class="card-footer" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);">
        <a class="btn btn-block btn-sm" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=<?php echo $slug;?>"><b>View</b></a>
        </div>
      </div>
      </div>
      <?php
    }
  }
}else if("oop_python" == $_GET["slug"]){
  $sql = "SELECT title, slug, img_file FROM ooppython";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0){
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $title = $row["title"];
      $slug = $row["slug"];
      $img_file = $row["img_file"];
      ?>
      <div class="col-lg-3 portfolio-item">
      <div class="card h-100" style="box-shadow: 0px 0px 10px 4px black;">
        <a style="color: black; background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);" href="viewvideo?slug=<?php echo $slug;?>"><h6 class="card-header"><?php echo $title;?></h6></a>
        <div class="card-body" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);">
          <a href="viewvideo?slug=<?php echo $slug;?>"><img class="img-fluid rounded-pill" src="img/python/oop_python/<?php echo $img_file;?>" alt=""></a>
        </div>
        <div class="card-footer" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);">
        <a class="btn btn-block btn-sm" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="viewvideo?slug=<?php echo $slug;?>"><b>View</b></a>
        </div>
      </div>
      </div>
      <?php
    }
  }
}
?>
</div>
<br>





<!--card-->
  
      
        
      
  
  <!--card end-->
</div>














































































<?php include('footer.php'); ?>