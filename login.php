<?php
//This script will handle login
session_start();

// check if the user is already logged in
if(isset($_SESSION['username'])){
    header("location: welcome");
    exit;
}
require_once "config.php";





use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
require 'credential.php';





$username = $password = "";
$err = $user_err = $pass_err = "";
$fault=0;
$mailstatus = "";
// if request method is post
if (isset($_POST['login'])){
    if(empty(trim($_POST['username'])) || empty(trim($_POST['password'])))
    {
        $user_err = "Please enter username or email";
        $pass_err = "Please enter password";
        $fault=1;
    }
    else{
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
    }

    $sql = "SELECT username, email,firstname,lastname, status FROM users";
    $result = mysqli_query($conn, $sql);

    $notfound=0;
    $notstatus=0;
    
    if ($fault==0 && (mysqli_num_rows($result) > 0)){
      // output data of each row
      while($row = mysqli_fetch_assoc($result)) {
        $usernamech = $row["username"];
        $emailch = $row["email"];
        $status = $row["status"];
        $firstname = $row["firstname"];
        $lastname = $row["lastname"];
        
        if($usernamech == $username || $emailch == $username){
          $notfound=$notfound+1;
          $username = $usernamech;
          $mailstatus = $emailch;
          if($status == "1"){

            $notstatus=$notstatus+1;
            if(empty($err)){
              $sql = "SELECT id, username, password FROM users WHERE username = ?";
              $stmt = mysqli_prepare($conn, $sql);
              mysqli_stmt_bind_param($stmt, "s", $param_username);
              $param_username = $username;
              
              
              // Try to execute this statement
              if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1){
                  mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                  if(mysqli_stmt_fetch($stmt)){
                    if(password_verify($password, $hashed_password)){
                      // this means the password is corrct. Allow user to login
                      session_start();
                      $_SESSION["username"] = $username;
                      $_SESSION["id"] = $id;
                      $_SESSION["loggedin"] = true;
          
                      //Redirect user to welcome page
                      header("location: welcome");        
                    }else{
                      $pass_err = "password is wrong !! try again";
                    }
                  }
                }else{
                  $user_err = "User name not found..create your account";
                }
              }
            }  
          }
        }
      }
      if($notfound==0){
        $user_err = "Username or email not found..create your account";
      }else if($notstatus==0){
        $user_err = "(".$mailstatus.") This email was not verified.<br> <a href=\"#\"  data-toggle=\"modal\" data-target=\"#myModal\" data-title=\"Send Verification Code\"><img width=\"15px\" src=\"img/clickme.png\"> Click here. <img width=\"15px\" src=\"img/clickme.png\"></a>";
      }
    }
    
}
?>











<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>codinglaugh - login</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/footer.css" rel="stylesheet">
  <!-- Custom styles for this template -->

  <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script async>(function(w, d) { w.CollectId = "5e81c4df080ddb1058a71cda"; var h = d.head || d.getElementsByTagName("head")[0]; var s = d.createElement("script"); s.setAttribute("type", "text/javascript"); s.setAttribute("src", "https://collectcdn.com/launcher.js"); h.appendChild(s); })(window, document);</script>
<script>
$(document).ready(function(){
    $("#myModal").on("show.bs.modal", function(event){
        // Get the button that triggered the modal
        var button = $(event.relatedTarget);

        // Extract value from the custom data-* attribute
        var titleData = button.data("title");
        $(this).find(".modal-title").text(titleData);
    });
});
</script>
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

@import url("//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css");
.login-block{
    width:100%;
    padding : 50px 0;
}
.containerr{background:#fff; border-radius: 10px; box-shadow:0px 0px 10px 10px rgba(0,0,0,0.5);}
.login-sec{padding: 50px 30px; position:relative;}
.login-sec .copy-text{position:absolute; width:80%; bottom:20px; font-size:13px; text-align:center;}
.login-sec .copy-text i{color:#FEB58A;}
.login-sec .copy-text a{color:#E36262;}
.login-sec h2{margin-bottom:30px; font-weight:800; font-size:30px; color: #DE6262;}
.login-sec h2:after{content:" "; width:100px; height:5px; background:#FEB58A; display:block; margin-top:20px; border-radius:3px; margin-left:auto;margin-right:auto}
.btn-login{background: #DE6262; color:#fff; font-weight:600;}
.carousel-inner img {
      width: 100%;
      height: 100%;
  }
.txt2:hover{
    color: green;
}
</style>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-light fixed-top" style="background-color: #FA8BFF;background-image: linear-gradient(45deg, #FA8BFF 0%, #2BD2FF 52%, #2BFF88 90%);">
    <div class="container">
      <a class="navbar-brand" href="index.php"><img width="140px" height="30px" src="img/codinglaugh.png" alt=""></a>
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" style="font-size: 14px;" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="font-size: 14px;" href="course.php">Course</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="font-size: 14px;" href="blog.php">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="font-size: 14px;" href="contact.php">Contact</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="font-size: 14px;" href="about.php">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" style="font-size: 14px;" href="login"><b>Login</b></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>




<?php
  
if (isset($_POST['send'])){

  $activationcode = rand(100000,999999);
  $sendmail=$_POST['send_email'];

  $sql = "SELECT username, email, firstname, lastname FROM users";
  $result = mysqli_query($conn, $sql);
  
  if (mysqli_num_rows($result) > 0){
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
      $usernames = $row["username"];
      $emails = $row["email"];
      $firstnames = $row["firstname"];
      $lastnames = $row["lastname"];
      
      if($emails == $sendmail){
        $updatesql = "UPDATE users SET activationcode='$activationcode' WHERE email='$sendmail'";

  $upresult = mysqli_query($conn, $updatesql);

  if($upresult){






    $mail = new PHPMailer(true);
				


				//Server settings
				// $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
				$mail->isSMTP();                                            // Send using SMTP
				$mail->SMTPAuth   = true;                                   // Enable SMTP authentication
				$mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
				
				$mail->Username   = EMAIL;                     // SMTP username
				$mail->Password   = PASS;                               // SMTP password
				$mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
				$mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
			
				//Recipients
				$mail->setFrom(EMAIL, 'Email Verification (codinglaugh.com)');
				$mail->addAddress($_POST['send_email']);     // Add a recipient
				// $mail->addAddress('ellen@example.com');               // Name is optional
				$mail->addReplyTo(EMAIL);
				// $mail->addCC('cc@example.com');
				// $mail->addBCC('bcc@example.com');
			
				// Attachments
				// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
				// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			
				// Content
				$mail->isHTML(true);                                  // Set email format to HTML
				$mail->Subject = 'Active Your Email Account from codinglaugh';
        $mail->Body    = "
        
        <!DOCTYPE html>
    <html>
    <head>
    <title></title>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge' />
    <style type=\"text/css\">
        /* FONTS */
        @media screen {
            @font-face {
              font-family: \"Lato\";
              font-style: normal;
              font-weight: 400;
              src: local(\"Lato Regular\"), local(\"Lato-Regular\"), url(https://fonts.gstatic.com/s/lato/v11/qIIYRU-oROkIk8vfvxw6QvesZW2xOQ-xsNqO47m55DA.woff) format(\"woff\");
            }
            
            @font-face {
              font-family: \"Lato\";
              font-style: normal;
              font-weight: 700;
              src: local(\"Lato Bold\"), local(\"Lato-Bold\"), url(https://fonts.gstatic.com/s/lato/v11/qdgUG4U09HnJwhYI-uK18wLUuEpTyoUstqEm5AMlJo4.woff) format(\"woff\");
            }
            
            @font-face {
              font-family: \"Lato\";
              font-style: italic;
              font-weight: 400;
              src: local(\"Lato Italic\"), local(\"Lato-Italic\"), url(https://fonts.gstatic.com/s/lato/v11/RYyZNoeFgb0l7W3Vu1aSWOvvDin1pK8aKteLpeZ5c0A.woff) format(\"woff\");
            }
            
            @font-face {
              font-family: \"Lato\";
              font-style: italic;
              font-weight: 700;
              src: local(\"Lato Bold Italic\"), local(\"Lato-BoldItalic\"), url(https://fonts.gstatic.com/s/lato/v11/HkF_qI1x_noxlxhrhMQYELO3LdcAZYWl9Si6vvxL-qU.woff) format(\"woff\");
            }
        }
        
        body, table, td, a { -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; }
        table, td { mso-table-lspace: 0pt; mso-table-rspace: 0pt; }
        img { -ms-interpolation-mode: bicubic; }
    
        img { border: 0; height: auto; line-height: 100%; outline: none; text-decoration: none; }
        table { border-collapse: collapse !important; }
        body { height: 100% !important; margin: 0 !important; padding: 0 !important; width: 100% !important; }
    
        /* iOS BLUE LINKS */
        a[x-apple-data-detectors] {
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }
        
        /* MOBILE STYLES */
        @media screen and (max-width:600px){
            h1 {
                font-size: 32px !important;
                line-height: 32px !important;
            }
        }
    
        /* ANDROID CENTER FIX */
        div[style*=\"margin: 16px 0;\"] { margin: 0 !important; }
    </style>
    </head>
    <body style=\"background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;\">
    
    
    <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
        <!-- LOGO -->
        <tr>
            <td bgcolor=\"#FFA73B\" align=\"center\">
                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\" >
                    <tr>
                        <td align=\"center\" valign=\"top\" style=\"padding: 40px 10px 40px 10px;\">
                            <a>
                                <img width=\"300px\" src=\"https://i.ibb.co/bHSvwfj/codinglaugh-titile.png\" alt=\">
                            
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        
        <tr>
            <td bgcolor=\"#f4f4f4\" align=\"center\" style=\"padding: 0px 10px 0px 10px;\">
                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\" >
                   <tr>
                    <td bgcolor=\"#ffffff\" align=\"center\" valign=\"top\" style=\"padding: 40px 20px 20px 20px; border-radius: 4px 4px 0px 0px; color: #111111; font-family: \"Lato\", Helvetica, Arial, sans-serif; font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;\">
                        <br><br><h1 style=\"font-size: 48px; font-weight: 400; margin: 0;\">Welcome!</h1><br><br>
                    </td>
                  </tr>
                  <tr>
                    <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 20px 30px 40px 30px; color: #666666; font-family: \"Lato\", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;\" >
                      <p style=\"margin: 0;\">We're excited to have you get started. First, you need to confirm your email address.</p>
                    </td>
                  </tr>
                  
                  <tr>
                    <td bgcolor=\"#ffffff\" align=\"center\">
                      <table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                        <tr>
                          <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 20px 30px 60px 30px;\">
                            <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
                            <center><p style=\"color: #666666; font-family: \"Lato\", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;\">Your Activation Code Here...<br></p></center>
                              <tr>
                                  <td align=\"center\" style=\"border-radius: 3px;\" bgcolor=\"#FFA73B\"><p style=\"font-size: 20px; font-family: Helvetica, Arial, sans-serif; color: #ffffff; text-decoration: none; color: #ffffff; text-decoration: none; padding: 0px 25px; border-radius: 2px; border: 1px solid #FFA73B; display: inline-block;\">$activationcode</p></td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                  
                  <tr>
                    <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 0px 30px 20px 30px; color: #666666; font-family: \"Lato\", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;\" >
                      <p style=\"margin: 0;\">If you have any questions, just reply to this email we're always happy to help out.</p>
                    </td>
                  </tr>
                  
                  <tr>
                    <td bgcolor=\"#ffffff\" align=\"center\" style=\"padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; color: #666666; font-family: \"Lato\", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;\" >
                      <br><p style=\"margin: 0;\">Marjuk Ahmed Siddiki<br><small>Founder at codinglaugh</small></p>
                    </td>
                  </tr>
                </table>
                
            </td>
        </tr>
        
        <tr>
            <td bgcolor=\"#f4f4f4\" align=\"center\" style=\"padding: 30px 10px 0px 10px;\">
                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\" >
                    
                    <tr>
                      <td bgcolor=\"#FFECD1\" align=\"center\" style=\"padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; color: #666666; font-family: \"Lato\", Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;\" >
                        <h2 style=\"font-size: 20px; font-weight: 400; color: #111111; margin: 0;\">Need more help?</h2>
                        <p style=\"margin: 0;\"><a style=\"color: #FFA73B;\">www.codinglaugh.com</a></p>
                      </td>
                    </tr>
                </table>
            </td>
        </tr>
        
        <tr>
            <td bgcolor=\"#f4f4f4\" align=\"center\" style=\"padding: 0px 10px 0px 10px;\">
                <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\" style=\"max-width: 600px;\" >
                  <br>
                  
                  <tr>
                    <td bgcolor=\"#f4f4f4\" align=\"left\" style=\"padding: 0px 30px 30px 30px; color: #666666; font-family: \"Lato\", Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;\" >
                      <center><p style=\"margin: 0;\">You received this email because you just signed up for a new account.</p></center>
                    </td>
                  </tr>
                  
                  <tr>
                    <td bgcolor=\"#f4f4f4\" align=\"left\" style=\"padding: 0px 30px 30px 30px; color: #666666; font-family: \"Lato\", Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; line-height: 18px;\" >
                      <center><p style=\"margin: 0;\">codinglaugh - Dhanmondi - Dhaka - Bangladesh</p></center>
                    </td>
                  </tr>
                </table>
            </td>
        </tr>
    </table>
        
    </body>
    </html>
        ";
				// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
			
				// $mail->send();
        // echo 'Message has been sent';
        

            if(!$mail->send()) {
                echo 'Message could not be sent.';
                echo 'Mailer Error: ' . $mail->ErrorInfo;
            } else {
                  $name = $firstnames.' '.$lastnames;
                    echo "<script>window.location = 'email_verification?mail=$emails&name=$name&uname=$usernames';</script>";
            }

}else{
    ?> 
        <div class="alert alert-danger alert-dismissible">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Wrong!</strong> Not successfully send activation code in your email...Please try again.
        </div>
  <?php
  }
      }
      
    }
  }







  
}
?>







  <div id="myModal" class="modal fade" tabindex="-1" style="position: absolute;width: 100%;height: 100%;background-image: url('img/model_bg.png');background-size: cover;">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="" method="post">
                    <div class="modal-header" style=" color: black; background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);">
                        <h5 class="modal-title"></h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="control-label">Email:</label>
                            <input style="background-color: white;" name="send_email" type="text" value="<?php echo $mailstatus;?>" readonly class="form-control">
                            <p style="font-size: 14px;"><br>This email was not verified. If email is not verified otherwise you cannot log in to codinglaugh.
                            <br><br><small style="color: red;"><b>Note:</b> If email is incorrect. Then you have to create your account again.</small></p>
                        </div>                       
                    </div>
                    <div class="modal-footer" style=" color: black; background-color: #85FFBD;background-image: linear-gradient(45deg, #85FFBD 0%, #FFFB7D 100%);">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button style="color: white;background-color: #85FFBD;background-image: linear-gradient(45deg, #009e49 0%, #c1bb00 100%);" type="submit" name="send" class="btn">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<br>


<section class="login-block mt-5 mb-3 p-3">
    <div class="container containerr">
	<div class="row align-items-center">
		<div class="col-md-4 login-sec">
		    <h2 class="text-center">Login Now</h2>
		    <form class="login-form" action="" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1" class="text-uppercase">Username or Email</label>
                    <input type="text" class="form-control" name="username" placeholder="Username or Email">
                    <div class="text-center">
						<div style="color: red;font-size:12px;">
							<?php
								echo $err;
								echo $user_err;
							?>
						</div>
						</div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1" class="text-uppercase">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
						<div class="text-center">
						<div style="color: red;font-size:12px;">
							<?php
								echo $err;
								echo $pass_err;
							?>
						</div>
						</div>
                </div>  
                <div class="form-check">
                    <label class="form-check-label">
                    <input type="checkbox" class="form-check-input">
                    <small>Remember Me</small>
                    </label>
                    <button type="submit" name="login" class="btn btn-login float-right">Login</button>
                </div>
            </form><br><br>
            <div class="text-center" style="font-size: 12px;">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>
            <div class="text-center" style="font-size: 12px;">
						<a class="txt2" href="registration">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
            <br>
            <div class="copy-text">Created with <i class="fa fa-heart"></i> by codinglaugh</div>
		</div> 
        <div class="col-lg-8">
        <div id="demo" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ul class="carousel-indicators">
            <li data-target="#demo" data-slide-to="0" class="active"></li>
            <li data-target="#demo" data-slide-to="1"></li>
            <li data-target="#demo" data-slide-to="2"></li>
            </ul>

            <!-- The slideshow -->
            <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="img/aboutcover01.png" alt="Los Angeles" width="1100" height="500">
            </div>
            <div class="carousel-item">
                <img src="img/cover03.png" alt="Chicago" width="1100" height="500">
            </div>
            <div class="carousel-item">
                <img src="img/cover02.png" alt="New York" width="1100" height="500">
            </div>
            </div>

            <!-- Left and right controls -->
            <a class="carousel-control-prev" href="#demo" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            </a>
            <a class="carousel-control-next" href="#demo" data-slide="next">
            <span class="carousel-control-next-icon"></span>
            </a>
            </div>
        </div>
	</div>
</div>
</section>


<?php include('footer.php'); ?>