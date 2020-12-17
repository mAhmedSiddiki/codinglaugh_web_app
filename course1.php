<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login");
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

  <title>codinglaugh - course</title>

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
                <div style="border-radius: 10px;box-shadow:0px 0px 10px 10px rgba(0,0,0,0.5);font-size:14px; background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);" class="text-center p-2 mr-5 mb-3 ml-5 mt-3 dropdown-menu dropdown-menu-right customClassForDropDown" aria-labelledby="navbarDropdownBlog">
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

<!-- Page Heading/Breadcrumbs -->
<br>
<!-- Intro Content -->
<div class="row  justify-content-center align-items-center">
  <div class="col-lg-6">
    <img class="img-fluid rounded mb-4" src="img/course.png" alt="">
  </div>
  <div class="col-lg-5">
    <h4 style="color: #007b5e">Why would you take our course?</h4>
    <p align="justify" style="font-size:14px;">Codinglaugh is the most popular company in over the world. Our life's most efficient problem is time. And here you solve this problem. Because this company provided to many video tutorial in our site or youtube channel. Sometimes you not found to whose programming language is better to the best performance in your professional life. But here you found to some videos tutorial in our site and easy to learn very most efficient programming language. Here you learn basic to high lavel programming language.
<br><br>If you are interested to python programming language. This site are the best to your time. Here you get python programming language's basic to high lavel performance.</p>
  </div>
</div>
<!-- /.row -->
<h3 style="color: #007b5e" class="mt-4 mb-3">Our Provided Courses</h3>
<hr>





<div class="rounded" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);">
   <br> <div class="row m-2">
          <?php 
            //video_playlist configure
            $sql = "SELECT sno, title, content, slug, img_file, madeby FROM video_playlist";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0){
              // output data of each row
              while($row = mysqli_fetch_assoc($result)) {
                $sno = $row["sno"];
                $title = $row["title"];
                $content = $row["content"];
                $slug = $row["slug"];
                $img_file = $row["img_file"];
                $madeby = $row["madeby"];

                
          ?>
      <div class="col-lg-4 mb-4">
        <div class="card h-100 text-center m-1" style="box-shadow: 0px 0px 10px 4px black;">

          <a href="python1?slug=<?php echo $slug;?>"><img class="card-img-top" src="img/python/video_playlist/<?php echo $img_file;?>" alt="video courses photo"></a>
          <div class="card-body">
            <a href="python1?slug=<?php echo $slug;?>"><h5 style="color: #007b5e" class="card-title"><?php echo $title;?></h5></a>
            <p align="justify" style="font-size:14px;" class="card-text text-dark"><?php echo substr("$content",0,100)."..."; ?></p>
          </div>
          <center><a href="python1?slug=<?php echo $slug;?>"><button style="color: white; background-color: #ce004c;background-image: linear-gradient(19deg, #ce004c 0%, #8203c4 100%);" class="btn btn-sm" name="savechange" type="submit">Open Course</button></a></center>
          <div class="card-footer">
            <small>Created By: <a target="_blank" href="marjuk"><?php echo $madeby; ?></a></small>
          </div>
        </div>
      </div>
      <?php
        }
      }
      ?>
    </div>





</div>
<!-- /.row -->

</div>
<!-- /.container -->









<?php include('footer.php'); ?>






