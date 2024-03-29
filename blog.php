<?php

session_start();

// check if the user is already logged in
if(isset($_SESSION['username'])){
  header("location: blog1");
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

  <title>codinglaugh - blog</title>

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
            <a class="nav-link" style="font-size: 14px;" href="course">Course</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" style="font-size: 14px;" href="blog">Blog</a>
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

















































 <!-- Blog Post -->
 
 <?php 
            //video_playlist configure
            $sql = "SELECT sno, title, content, slug, img_file, made_by FROM post";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0){
              // output data of each row
              while($row = mysqli_fetch_assoc($result)) {
                $sno = $row["sno"];
                $title = $row["title"];
                $content = $row["content"];
                $slug = $row["slug"];
                $img_file = $row["img_file"];
                $madeby = $row["made_by"];
                ?>
    <div class="card mb-4 mt-4" style="border-color: #007b5e;">
      <div class="card-body">
        <div class="row justify-content-center align-items-center">
          <div class="col-lg-4">
            <a href="#">
              <a href="viewblog?slug=<?php echo $slug;?>"><img class="img-fluid rounded-pill" src="img/blog/<?php echo $img_file ?>" alt=""></a>
            </a>
          </div>
          <div class="col-lg-6">
          <a href="viewblog?slug=<?php echo $slug;?>"><h4 class="card-title" style="color: #007b5e"><?php echo $title;?></h4></a>
            <p class="card-text" style="font-size:14px;" align="justify"><?php echo substr("$content",0,350)."...";?></p>
            <a href="viewblog?slug=<?php echo $slug;?>" class="btn btn-sm" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);">Read More &rarr;</a>
          </div>
        </div>
      </div>
      <div class="card-footer text-center" style="font-size:14px;color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);">
        <b>Created By: </b><a style="color: white;" target="_blank" href="marjuk"><?php echo $madeby; ?></a>
      </div>
      </div>
      <?php
              }}
      ?>
    




























































    </div>





    <?php include('footer.php'); ?>