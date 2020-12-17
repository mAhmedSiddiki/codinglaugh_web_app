<?php

session_start();

// check if the user is already logged in
if(isset($_SESSION['username'])){
  header("location: viewblog1");
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

  <title>codinglaugh - view post</title>

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

code[class*="language-"],
    pre[class*="language-"] {
        max-height: 614px;
    }
    .commentContainer{
        overflow-x: scroll;
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



















































<!-- Page Content -->
<div class="container">

<?php 
            //video_playlist configure
    $sql = "SELECT sno, title, content, slug, img_file, made_by FROM post";
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
        $madeby = $row["made_by"];

        if($slug == $_GET['slug']){
          $found = $found+1;
        ?>
        
<!-- Page Heading/Breadcrumbs -->
<h2 class="mt-4 mb-3"><?php echo $title;?>
  <small>by
    <a href="marjuk" target="_blank">Marjuk Ahmed Siddiki</a>
  </small>
</h2>

<hr>

<div class="row">
  <!-- Post Content Column -->
  <div class="col-lg-8">
    <!-- Preview Image -->
    <img class="img-fluid rounded" src="img/blog/<?php echo $img_file;?>" alt="">
    <hr>
    <!-- Date/Time -->
    <hr>
    <!-- Post Content -->
    <p class="language-" align="justify"><?php echo $content;?></p>
  <?php
        }}if($found==0){
          header("location: notfound");
        }
      }
?>
    <br>


  </div>

  <!-- Sidebar Widgets Column -->
  <div class="col-md-4">
  <center><h6 class="list-group-item list-group-item-action list-group-item-success" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);"><marquee scrollamount="5" width="40">&lt;&lt;&lt;</marquee>Recommended<marquee scrollamount="5" direction="right" width="40">&gt;&gt;&gt;</marquee></h6></center>
  <ul class="list-group scroll_change" height='50%'>
    
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

        if($slug == $_GET['slug']){
        ?>
        <small><a href="viewblog?slug=<?php echo $slug;?>" class="font-weight-bold list-group-item list-group-item-action rounded-pill" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);"><?php echo $title; ?></a></small>

        <?php
        }else{
            ?>
            <small><a href="viewblog?slug=<?php echo $slug;?>" class="text-dark list-group-item list-group-item-action" style="background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);"><?php echo $title; ?></a></small>
            <?php
        }}}
        ?>
  </div>

</div>
<!-- /.row -->

</div>
<!-- /.container -->





























































    </div>








    <?php include('footer.php'); ?>