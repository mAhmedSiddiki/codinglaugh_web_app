<?php
require_once "config.php";







use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';
require 'credential.php';






$username = $password = $confirm_password = $email = $firstname = $lastname = "";
$username_err = $password_err = $confirm_password_err = $email_err = $firstname_err = $lastname_err =  "";

if ($_SERVER['REQUEST_METHOD'] == "POST"){	
	//cheak for firstname
	if(empty(trim($_POST['firstname']))){
		$firstname_err = "Enter first name..";
	}
	else{
		$firstname = trim($_POST['firstname']);
	}

	//cheak for lastname
	if(empty(trim($_POST['lastname']))){
		$lastname_err = "Enter last name..";
	}
	else{
		$lastname = trim($_POST['lastname']);
	}

    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Username cannot be blank";
    }
    else{
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = mysqli_prepare($conn, $sql);
        if($stmt)
        {
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set the value of param username
            $param_username = trim($_POST['username']);

            // Try to execute this statement
            if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                {
                    $username_err = "This username is already registered. Use different username.<br><a href=\"login\"><img width=\"15px\" src=\"img/clickme.png\"> Or Login <img width=\"15px\" src=\"img/clickme.png\"></a>"; 
                }
                else{
                    $username = trim($_POST['username']);
                }
            }
            else{
                echo "Something went wrong";
            }
		}
		mysqli_stmt_close($stmt);
    }
	
	//cheak for email
	if(empty(trim($_POST['email']))){
		$email_err = "Email cannot be blank";
	}
	else{
		$sql = "SELECT email FROM users";
		$result = mysqli_query($conn, $sql);
		$emailfound = 0;
		if (mysqli_num_rows($result) > 0){
		  // output data of each row
		  while($row = mysqli_fetch_assoc($result)) {
			$emails = $row["email"];
			
			if($emails == $_POST['email']){
				$emailfound=$emailfound+1;
				$email_err = "This email is already registered. Use different email.<br><a href=\"login\"><img width=\"15px\" src=\"img/clickme.png\"> Or Login <img width=\"15px\" src=\"img/clickme.png\"></a>";
			}
		}
	}
	if($emailfound==0){
		$email = trim($_POST['email']);
	}
		
		
	}

	// Check for password
	if(empty(trim($_POST['password']))){
		$password_err = "Password cannot be blank";
	}
	elseif(strlen(trim($_POST['password'])) < 5){
		$password_err = "Password cannot be less than 5 characters";
	}
	else{
		$password = trim($_POST['password']);
	}

	// Check for confirm password field
	if(trim($_POST['password']) !=  trim($_POST['confirm_password'])){
		$confirm_password_err = "Passwords not match";
	}

	
	$activationcode = rand(100000,999999);

	// If there were no errors, go ahead and insert into the database
	if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($email_err))
	{
		$sql = "INSERT INTO users (firstname, lastname, username, email, activationcode, password) VALUES (?, ?, ?, ?, ?, ?)";
		$stmt = mysqli_prepare($conn, $sql);
		if ($stmt)
		{
			mysqli_stmt_bind_param($stmt, "ssssss",$param_firstname, $param_lastname, $param_username, $param_email, $param_activationcode, $param_password);

			// Set these parameters
			$param_firstname = $firstname;
			$param_lastname = $lastname;
			$param_username = $username;
			$param_email = $email;
			$param_activationcode = $activationcode;
			$param_password = password_hash($password, PASSWORD_DEFAULT);

			// Try to execute the query
			if (mysqli_stmt_execute($stmt))
			{
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
				$mail->addAddress($_POST['email']);     // Add a recipient
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
					$name = $firstname.' '.$lastname;
					echo "<script>window.location = 'email_verification?mail=$email&name=$name&uname=$username';</script>";
				}


			}
			else{
				echo "Something went wrong... cannot registration!";
			}
		}
		mysqli_stmt_close($stmt);
	}
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

  <title>codinglaugh - registration</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="css/footer.css" rel="stylesheet">
  <!-- Custom styles for this template -->

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
.txt1{
    font-size: 12px;
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
          <li class="nav-item">
            <a class="nav-link active" style="font-size: 14px;" href="login"><b>Login</b></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>


<br>


<section class="login-block mt-5 mb-3 p-3">
    <div class="container containerr">
	<div class="row align-items-center">
		<div class="col-md-4 login-sec">
		    <h2 class="text-center">Registration Info</h2>
		    <form class="login-form" action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" name="firstname" placeholder="First Name">
						<div class="text-center">
						<div class="txt1" style="color: red;">
							<?php
								echo $firstname_err;
							?>
						</div>
						</div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="lastname" placeholder="Last Name">
						<div class="text-center">
						<div class="txt1" style="color: red;">
							<?php
								echo $lastname_err;
							?>
						</div>
						</div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="username" placeholder="Username">
						<div class="text-center">
						<div class="txt1" style="color: red;">
							<?php
								echo $username_err;
							?>
						</div>
						</div>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="email" placeholder="Email" data-validate = "Valid email is required: ex@abc.xyz">
						<div class="text-center">
						<div class="txt1" style="color: red;">
							<?php
								echo $email_err;
							?>
						</div>
						</div>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="password" placeholder="Password">
						<div class="text-center">
						<div class="txt1" style="color: red;">
							<?php
								echo $password_err;
							?>
						</div>
						</div>
                </div>  
                <div class="form-group">
                    <input type="password" class="form-control" name="confirm_password" placeholder="Confirm Password">
                    
						<div class="text-center">
						<div class="txt1" style="color: red;">
							<?php
								echo $confirm_password_err;
							?>
						</div>
						</div>
                </div>  
                <div class="form-check">
                    <center><button type="submit" class="btn btn-login">Create Account</button></center>
                </div>
            </form><br><br>
            <div class="text-center" style="font-size: 12px;">
						<a class="txt2" href="login">
							Already have an account
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