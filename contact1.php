<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: logininvite");
}

require_once "config.php";








$fullnamee = $subjectt = $emaill = $usernamee = $messagee = "";
$subjectt_err = $messagee_err = "";

$usernamee = $_SESSION['username'];


if ($_SERVER['REQUEST_METHOD'] == "POST"){
  $emaill = trim($_POST['emaill']);
  $fullnamee = trim($_POST['fullnamee']);	
  //cheak for firstname
  if(empty(trim($_POST['subjectt']))){
    $subjectt_err = "please enter your subject..";
  }
  else{
    $subjectt = trim($_POST['subjectt']);
  }

  if(empty(trim($_POST['messagee']))){
    $messagee_err = "please enter your message..";
  }
  else{
    $messagee = trim($_POST['messagee']);
  }

  if(empty($subjectt_err) && empty($messagee_err)){
  $sql = "INSERT INTO contact (username, fullname, email, messagee, subjectt) VALUES (?, ?, ?, ?, ?)";
  $stmt = mysqli_prepare($conn, $sql);

  if ($stmt){
    mysqli_stmt_bind_param($stmt, "sssss",$param_username, $param_fullname, $param_email, $param_messagee, $param_subjectt);

    // Set these parameters
    $param_username = $usernamee;
    $param_fullname = $fullnamee;
    $param_email = $emaill;
    $param_messagee = $messagee;
    $param_subjectt = $subjectt;

    // Try to execute the query
    if (mysqli_stmt_execute($stmt)){
      
      
      header("location: success1");
      }else{
        ?> 
        
        <?php
      }
  }
  mysqli_stmt_close($stmt);
}else{header("location: success");}
mysqli_close($conn);
}
?>



<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>codinglaugh - contact</title>

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
            <a class="nav-link" style="font-size: 14px;" href="course">Course</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="font-size: 14px;" href="blog">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" style="font-size: 14px;" href="contact">Contact</a>
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





























<!-- Page Content -->
<div class="container">
<?php
error_reporting(0);
  if("success" == $_GET['slug']){
    
    ?>
    <div class="alert alert-success alert-dismissible">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <strong>Success!</strong> Your message is send.
  </div>
  <?php
  }
?>
<!-- Page Heading/Breadcrumbs -->
<h1 class="mt-4 mb-3">Contact
</h1>


<!-- Content Row -->
<div class="row">
  <!-- Map Column -->
  <div class="col-lg-8 mb-4">
    <!-- Embedded Google Map -->
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3651.8330771760698!2d90.37697376463272!3d23.753331194582064!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8ac20cff015%3A0xff2b5ccc3b603741!2sShukrabad%2C%20Dhaka%201205!5e0!3m2!1sen!2sbd!4v1584213656325!5m2!1sen!2sbd" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
  </div>
  <!-- Contact Details Column -->
  <div class="col-lg-4 mb-4">
    <h3>Contact Details</h3>
    <p>
      Dhanmondi-32
      <br>Dhaka, 1207
      <br>
    </p>
    <p>
      <li title="Phone" class="fa fa-phone"></li> (+880) 1796007871
    </p>
    <p>
    <li title="Phone" class="fa fa-envelope"></li>
      <a href="mailto:marjuktech@gmail.com">marjuktech@gmail.com
      </a>
    </p>
    <p>
    <li title="Phone" class="fa fa-clock-o"></li> Everyday: 9:00 AM to 5:00 PM
    </p>
  </div>
</div>
<!-- /.row -->







<!-- Contact Form -->
<!-- In order to set the email address and subject line for the contact form go to the bin/contact_me.php file. -->
<div class="row">
  <div class="col-lg-8 mb-4">
    <h3>Send us a Message</h3>
    <form name="sentMessage" id="contactForm" novalidate action="" method="post">
      <div class="control-group form-group">
        <div class="controls">
        <?php
        $sqll = "SELECT username, firstname, lastname, email FROM users";
        $resultt = mysqli_query($conn, $sqll);
        
        if (mysqli_num_rows($resultt) > 0){
          // output data of each row
          while($row = mysqli_fetch_assoc($resultt)) {
            $username = $row["username"];
            $firstname = $row["firstname"];
            $lastname = $row["lastname"];
            $email = $row["email"];
      
            if($_SESSION['username'] == $username){
      
      ?>
          <input type="text" style="background-color:white;" class="form-control" name="fullnamee" id="name" value="<?php echo $firstname.' '.$lastname;?>" readonly required placeholder="Please enter your name">
          
          <p class="help-block"></p>
        </div>
      </div>
      <div class="control-group form-group">
        <div class="controls">
          <input type="email" class="form-control" style="background-color:white;" name="emaill" id="email" value="<?php echo $email;?>" readonly required placeholder="Please enter your email address">
          <?php 
      }}}
      ?>
        </div>
      </div>
      
      <div class="control-group form-group">
        <div class="controls">
          <input type="text" class="form-control" name="subjectt" id="phone" required placeholder="Please enter your subject">
          <div class="text-center">
						<div class="txt2" style="color: red;">
							<?php
								echo $subjectt_err;
							?>
						</div>
						</div>
        </div>
      </div>
      <div class="control-group form-group">
        <div class="controls">
          <textarea rows="6" cols="100" class="form-control" name="messagee" id="message" required placeholder="Please enter your message here" maxlength="999" style="resize:none"></textarea>
          <div class="text-center">
						<div class="txt2" style="color: red;">
							<?php
								echo $messagee_err;
							?>
						</div>
						</div>
        </div>
      </div>
      <div id="success"></div>
      <!-- For success/fail messages -->
      <a href="contact1"><button type="submit" class="btn" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);">Send Message</button></a>
    </form>
  </div>

</div>
<!-- /.row -->

</div>
<!-- /.container -->

















<?php include('footer.php'); ?>