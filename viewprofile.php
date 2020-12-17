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

  <title>codinglaugh - view profile</title>

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
            <a class="nav-link" style="font-size: 14px;" href="course">Course</a>
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
                <div style="border-radius: 10px;box-shadow:0px 0px 10px 10px rgba(0,0,0,0.5);font-size:14px; background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);" class="text-center dropdown-menu dropdown-menu-right p-2 mr-5 mb-3 ml-5 mt-3 customClassForDropDown" aria-labelledby="navbarDropdownBlog">
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



















<?php
  $sql = "SELECT id, firstname, lastname, username, occupation, age, gender, email, phone, city, zip, state, about, img_file, facebook, linkedin, github, website FROM users";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0){
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $id = $row["id"];
      $firstname = $row["firstname"];
      $lastname = $row["lastname"];
      $username = $row["username"];
      $email = $row["email"];
      $city = $row["city"];
      $phone = $row["phone"];
      $state = $row["state"];
      $zip = $row["zip"];
      $about = $row["about"];
      $img_file = $row["img_file"];
      $facebook = $row["facebook"];
      $linkedin = $row["linkedin"];
      $github = $row["github"];
      $website = $row["website"];
      $occupation = $row["occupation"];
      $age = $row["age"];
      $gender = $row["gender"];
      
      if($username == $_GET['slug']){
?>
<div class="" style="background-color: #FA8BFF;background-image: linear-gradient(90deg, #FA8BFF 0%, #2BD2FF 52%, #2BFF88 90%);">
<br>
<div class="container">
  <div class="row justify-content-around align-items-center">  
      <div class="col-lg-3">
        <img class="w-100 rounded-circle" src="img/user/<?php echo $img_file;?>" alt="" style="box-shadow: 0px 0px 10px 8px black;">
      </div>
      <div class="col-lg-6">
        <br>
        <center><p class="navbar-brand" style="font-variant: small-caps; font-size: 30px; background: -webkit-linear-gradient(45deg, #ff0034, #007b5e);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><b><?php echo $firstname.' '.$lastname;?></b></p></center>

        <center><?php if(!empty($facebook)){?><a target="_blank" class="btn btn-outline-dark btn-social mx-2 rounded-circle" href="<?php echo $facebook;?>"><i class="fa fa-facebook-f"></i></a><?php }?>
        <?php if(!empty($linkedin)){?><a target="_blank" class="btn btn-outline-dark btn-social mx-2 rounded-circle" href="<?php echo $linkedin;?>"><i class="fa fa-linkedin"></i></a><?php }?>
        <?php if(!empty($github)){?><a target="_blank" class="btn btn-outline-dark btn-social mx-2 rounded-circle" href="<?php echo $github;?>"><i class="fa fa-github"></i></a><?php }?>
        <?php if(!empty($website)){?><a target="_blank" class="btn btn-outline-dark btn-social mx-2 rounded-circle" href="<?php echo $website;?>"><i class="fa fa-chrome"></i></a><?php }?></center>
        <br>
      </div>
      </div>
    </div>
    <br><br>
</div>

<br>
<div class="container">
  <div class="row justify-content-md-center" style="border: 8px solid transparent;padding: 5px; border-image: url(img/border.png) 20% round;">
  <?php if(!empty($about)){?>
    <div class="col-lg-4" style="border: 8px solid transparent;padding: 5px; border-image: url(img/border.png) 30 stretch;">
      <h5 class="text-center">About</h5>
      <textarea readonly type="text" rows="6" name="about" cols="" class="form-control" id="validationCustom03" required placeholder="Please enter your about here" style="resize:none; border: none; font-size: 14px; text-align: justify; background-color: white;"><?php echo $about;?></textarea>
    </div>
    <?php }?>
    <div class="col-lg-4" style="border: 8px solid transparent;padding: 5px; border-image: url(img/border.png) 30 stretch;">
      <h5 class="text-center">Information</h5>
      <p style="font-size: 14px;"><?php if(!empty($firstname)){?><strong>First Name: </strong><?php echo $firstname;?><br><?php }?>
      <?php if(!empty($lastname)){?><strong>Last Name: </strong><?php echo $lastname;?><br><?php }?>
      <?php if(!empty($username)){?><strong>Username: </strong><?php echo $username;?><br><?php }?>
      <?php if(!empty($occupation)){?><strong>Occupation: </strong><?php echo $occupation;?><br><?php }?>
      <?php if(!empty($age)){?><strong>Age: </strong><?php echo $age;?><br><?php }?>
      <?php if($gender!="Choose..." && !empty($gender)){?><strong>Gender: </strong><?php echo $gender;?><br><?php }?></p>
    </div>
    <div class="col-lg-4" style="border: 8px solid transparent;padding: 5px; border-image: url(img/border.png) 30 stretch;">
      <h5 class="text-center">Contact</h5>
      <p style="font-size: 14px;"><?php if(!empty($phone)){?><strong>Phone No: </strong><?php echo $phone;?><br><?php }?>
      <?php if(!empty($email)){?><strong>Email: </strong><?php echo $email;?><br><?php }?>
      <?php if(!empty($city)){?><strong>City: </strong><?php echo $city;?><br><?php }?>
      <?php if(!empty($zip)){?><strong>Zip/Postal: </strong><?php echo $zip;?><br><?php }?>
      <?php if(!empty($state)){?><strong>State: </strong><?php echo $state;?><br><?php }?></p>
    </div>
  </div>
</div>

<br>

<?php    
      }
    }
  }
?>

















<?php include('footer.php'); ?>