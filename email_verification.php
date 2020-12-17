
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>codinglaugh - email verification</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/footer.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $("#myModal").modal('show');
    });
</script>
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
.bs-example{
    	margin: 20px;
    }
</style>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light fixed-top" style="background-color: #FA8BFF;background-image: linear-gradient(45deg, #FA8BFF 0%, #2BD2FF 52%, #2BFF88 90%);">
    <div class="container">
      <a class="navbar-brand" target="_blank" href="index"><img width="140px" height="30px" src="img/codinglaugh.png" alt=""></a>
    </div>
  </nav>
<br>

















<?php 
  require_once "config.php";
  
  if ($_SERVER['REQUEST_METHOD'] == "POST"){
    $sql = "SELECT username, email, activationcode FROM users";
    $result = mysqli_query($conn, $sql);
    $error = 0;

    if (mysqli_num_rows($result) > 0){
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        $username = $row["username"];
        $email = $row["email"];
        $activationcode = $row["activationcode"];
        
        if($username == $_GET['uname'] && $email == $_GET['mail'] && $activationcode == $_POST['code']){
          $error = $error+1;
          $updatestatus = "UPDATE users SET status=1 WHERE username='$username'";

          $upresult = mysqli_query($conn, $updatestatus);

          if($upresult){
            ?> 
              <div class="bs-example">
                <div id="myModal" class="modal fade" tabindex="-1"style="position: absolute;width: 100%;height: 100%;background-image: url('img/model_bg.png');background-size: cover;">
                    <div class="modal-dialog">
                        <div class="modal-content" style="box-shadow: 0px 10px 15px 05px black;">
                            <div class="modal-header" style=" color: black; background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);">
                                <h5 class="modal-title">Confirmation</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="modal-body">
                                <center><img class="w-50" src="img/confirm.gif" alt=""></center>
                                <p>Your email <b>(<?php echo $email;?>)</b> is now verified for codinglaugh account.</p>
                                <p class="text-secondary"><small>Now you can log in to codinglaugh. <br><b><a href="index">www.codinglaugh.com</a></b></small></p>
                            </div>
                            <div class="modal-footer"style=" color: black; background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);">
                                <a class="btn btn-block btn-sm" style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" href="login"><b>Login</b></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="alert alert-success alert-dismissible container text-center col-lg-5" style="font-size: 14px;">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <a href="login"><img width="25px" src="img/clickme.png" alt=""> <strong>Success!</strong> Now you log in to codinglaugh --> <b>Login</b> <img width="25px" src="img/clickme.png" alt=""></a>
                </div>
          <?php
          }else{
            ?> 
                <div class="alert alert-danger alert-dismissible">
                  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  <strong>Wrong!</strong> Not successfully active your email...Please try again.
                </div>
          <?php
          }
        }
      }if($error==0){
        ?> 
              <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Wrong!</strong> Your activation code was wrong...Please give original activation code.
              </div>
        <?php
      }
    }
  }
?>
















<div class="container">
    <div class="row align-items-center justify-content-center">
        <div class="col-lg-6 text-center m-3 p-3" style="font-size: 14px;border-radius: 10px;box-shadow:0px 0px 10px 10px rgba(0,0,0,0.5);">
            <img class="col-lg-5" src="img/sendmail.gif" alt="">
            <h5 style="font-size: 25px; background: -webkit-linear-gradient(45deg, #ff0034, #007b5e);-webkit-background-clip: text;-webkit-text-fill-color: transparent;">Confirm Verification Code</h5>
            <p style="font-size: 17px;"><strong>Hi</strong> <?php echo $_GET['name']?>,</p>
            <p>codinglaugh just sent a mail with a verification code to <b><?php echo $_GET['mail'];?></b></p>
            <form action="" method="post">
                <div class="form-group">
                        <input type="text" class="form-control text-center" name="code" placeholder="Enter six-digit code">
                </div>
                <center><button style="color: white; background-color: #ce004c;background-image: linear-gradient(19deg, #ce004c 0%, #8203c4 100%);" class="btn btn-login" name="verify" type="submit">Verify</button></center>
            </form>
        </div>
    </div>
</div>

<br>


























































<?php include('footer.php'); ?>