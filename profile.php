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

  <title>codinglaugh - profile</title>

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

.imgh:hover{
  opacity: 0.5;
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

$username = $_SESSION['username'];

$err_oldpass = $err_confirmpass = "";


if (isset($_POST['savechange'])){
  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $email=$_POST['email'];
  $phnno=$_POST['phnno'];
  $city=$_POST['city'];
  $state=$_POST['state'];
  $zip=$_POST['zip'];
  $about=$_POST['about'];
  $facebook=$_POST['facebook'];
  $linkedin=$_POST['linkedin'];
  $github=$_POST['github'];
  $website=$_POST['website'];
  $occupation=$_POST['occupation'];
  $age=$_POST['age'];
  $gender=$_POST['gender'];

  if(!empty(trim($_POST['oldpass'])) && !empty(trim($_POST['newpass'])) && !empty(trim($_POST['confirmpass']))){
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
					if(password_verify($_POST['oldpass'], $hashed_password)){
						// this means the password is corrct. Allow user to login
            
            if(trim($_POST['newpass']) !=  trim($_POST['confirmpass'])){
              $err_confirmpass = "Confirm password not matched";
              ?> 
                    <div class="alert alert-danger alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Wrong!</strong> Not successfully updated your password...Please try again.
                    </div>
              <?php
            }else{
              $savepass = password_hash($_POST['confirmpass'], PASSWORD_DEFAULT);
              $updatesql = "UPDATE users SET password='$savepass' WHERE username='$username'";
              $upresult = mysqli_query($conn, $updatesql);

              if($upresult){
                ?> 
                    <div class="alert alert-success alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Success!</strong> Your password is successfully updated...
                    </div>
              <?php
              }else{
                ?> 
                    <div class="alert alert-danger alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Wrong!</strong> Not successfully updated your password...Please try again.
                    </div>
              <?php
              }
            }
					}else{
            $err_oldpass = "Old password not matched";
            ?> 
                    <div class="alert alert-danger alert-dismissible">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Wrong!</strong> Not successfully updated your password...Please try again.
                    </div>
              <?php
					}
				}
			}
		}
  }else{
        $updatesql = "UPDATE users SET firstname='$fname',gender='$gender',lastname='$lname',email='$email',phone='$phnno',city='$city',state='$state',zip='$zip',about='$about',facebook='$facebook',linkedin='$linkedin',github='$github',website='$website',occupation='$occupation',age='$age' WHERE username='$username'";

        $upresult = mysqli_query($conn, $updatesql);

        if($upresult){
          ?> 
              <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success!</strong> Your information is successfully updated...
              </div>
        <?php
        }else{
          ?> 
              <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Wrong!</strong> Not successfully updated your information...Please try again.
              </div>
        <?php
        }
      }
        
}
?>
















































  




<?php 
  if (isset($_POST['change_photo'])){
    echo "<script>window.location = 'change_pic';</script>";
  }
?>









<br>
<div class="row">
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
        
        if($username == $_SESSION['username']){
?>
    <div id="myModal" class="modal fade" tabindex="-1">
        <div class="modal-dialog">
        
            <div class="modal-content">
            <form action="" method="post">
                    <img class="w-100" src="img/user/<?php echo $img_file;?>" alt="">
            
                    <div class="modal-footer" style="background-color: white;">
            <button style="color: white; background-color: #ce004c;background-image: linear-gradient(19deg, #ce004c 0%, #8203c4 100%);" class="btn btn-block" name="change_photo" type="submit">Change Photo</button>
            </div>
            </form>
            </div>
        
        </div>
    </div>
    <div class="col-lg-4" >
    <div class="rounded-pill" style="background-color: #FEE140;background-image: linear-gradient(90deg, #FEE140 0%, #FA709A 100%);">
     <br>
            <center><a style="font-size: 14px; color: black;" href="#"  data-toggle="modal" data-target="#myModal"><img class="w-50 imgh rounded-circle" style="box-shadow: 0px 0px 15px 5px black;" src="img/user/<?php echo $img_file;?>" alt=""><br><br>
            <img width="17px" src="img/clickme.png" alt=""> <b>Update Profile Photo</b> <img width="17px" src="img/clickme.png" alt=""></a></center><br>
            <p class="text-center" style="font-variant: small-caps;font-size: 21px; background: -webkit-linear-gradient(45deg, #ff0034, #007b5e);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><b><?php echo $firstname.' '.$lastname;?></b></p>
              <div class="rounded-pill" style="background-color: #ce004c;background-image: linear-gradient(19deg, #ce004c 0%, #8203c4 100%);">
                <p class="p-2 pl-5" style="font-size: 14px; color: white; font-variant-caps: titling-caps;"><b>Username: </b><?php echo $username;?><br>
                <b>Email: </b><?php echo $email;?><br>
                <?php if(!empty($phone)){?><b>Phone: </b><?php echo $phone;?><br><?php }?>
                <?php if(!empty($city)){?><b>City: </b><?php echo $city;?><br><?php }?>
                <?php if(!empty($state)){?><b>State: </b><?php echo $state;?><?php }?></p>
              </div>
            </div>  
            <center><a href="viewprofile.php?slug=<?php echo $_SESSION['username'];?>"><p class="border btn btn-sm rounded-pill" style="font-variant: small-caps; background-color: #FEE140;background-image: linear-gradient(90deg, #FEE140 0%, #FA709A 100%);"><img width="20px" src="img/clickme.png" alt=""> <b>View Public Profile</b> <img width="20px" src="img/clickme.png" alt=""></p></a></center>
    </div>

    <div class="col-lg-8">
      <form class="needs-validation" novalidate action="profile.php" method="POST">
        <nav class="rounded nav-justified" style="background-color: #FEE140;background-image: linear-gradient(90deg, #FEE140 0%, #FA709A 100%);">
          <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" style="font-size: 15px; color: black;" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><small><b>Edit Profile</b></small></a>
            <a class="nav-item nav-link" style="font-size: 15px; color: black;" id="nav-password-tab" data-toggle="tab" href="#nav-password" role="tab" aria-controls="nav-password" aria-selected="false"><small><b>Change Password</b></small></a>
          </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active m-4" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
              <div class="form-row">
                <div class="col-md-4 mb-3 input-group-sm">
                  <label for="validationCustom01">First name</label>
                  <input type="text" name="fname" class="form-control" id="validationCustom01" placeholder="First name" value="<?php echo $firstname;?>" required>
                </div>
                <div class="col-md-4 mb-3 input-group-sm">
                  <label for="validationCustom02">Last name</label>
                  <input type="text" name="lname" class="form-control" id="validationCustom02" placeholder="Last name" value="<?php echo $lastname;?>" required>
                </div>
                <div class="col-md-4 mb-3 input-group-sm">
                  <label for="validationCustomUsername">Username</label>
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text" id="inputGroupPrepend">@</span>
                    </div>
                    <input type="text" name="uname" readonly class="form-control" id="validationCustomUsername" placeholder="Username" value="<?php echo $username;?>" aria-describedby="inputGroupPrepend" required>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-7 mb-3 input-group-sm">
                  <label for="validationCustom03">Email</label>
                  <input type="email" name="email" class="form-control" readonly id="validationCustom03" placeholder="Email" value="<?php echo $email;?>" required>
                </div>
                <div class="col-md-5 mb-3 input-group-sm">
                  <label for="validationCustomUsername">Phone No <small>(with country code)</small></label>
                  <div class="input-group input-group-sm">
                    <input type="text" name="phnno" class="form-control" id="validationCustomUsername" placeholder="Phone number" value="<?php echo $phone;?>" aria-describedby="inputGroupPrepend" required>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-4 mb-3 input-group-sm">
                  <label for="validationCustom01">Occupation</label>
                  <input type="text" name="occupation" class="form-control" id="validationCustom01" placeholder="Occupation" value="<?php echo $occupation;?>" required>
                </div>
                <div class="col-md-4 mb-3 input-group-sm">
                  <label for="validationCustom02">Age</label>
                  <input type="text" name="age" class="form-control" id="validationCustom02" placeholder="Age" value="<?php echo $age;?>" required>
                </div>
                <div class="col-md-4 mb-3 input-group-sm">
                  <label for="validationCustomUsername">Gender</label>
                  <select class="custom-select" name="gender" id="inputGroupSelect01">
                    <option selected>Choose...</option>
                    <option <?php if($gender == "Male") echo 'selected'?>>Male</option>
                    <option <?php if($gender == "Female") echo 'selected'?>>Female</option>
                    <option <?php if($gender == "Other") echo 'selected'?>>Other</option>
                  </select>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-6 mb-3 input-group-sm">
                  <label for="validationCustom03">City</label>
                  <input type="text" name="city" class="form-control" id="validationCustom03" value="<?php echo $city;?>" placeholder="City" required>
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                  <label for="validationCustom04">State</label>
                  <input type="text" name="state" class="form-control" id="validationCustom04" value="<?php echo $state; ?>" placeholder="State" required>
                </div>
                <div class="col-md-3 mb-3 input-group-sm">
                  <label for="validationCustom05">Zip/Postal</label>
                  <input type="text" name="zip" class="form-control" id="validationCustom05" value="<?php echo $zip;?>" placeholder="Zip/Postal" required>
                </div>
              </div>
              <div class="form-row">
                <div class="col-md-12 mb-3 input-group-sm">
                  <label for="validationCustom03">About</label>
                  <textarea type="text" rows="5" name="about" cols="50" class="form-control" id="validationCustom03" required placeholder="Please enter your about here" style="resize:none;text-align: justify;"><?php echo $about;?></textarea>
                </div>
              </div><br>
              <div class="form-row">
                <div class="col-md-8 mb-3 mx-auto">
                  <center><label for="validationCustomUsername" style="font-size: 20px;">Social Link</label></center>
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text fa fa-facebook" id="inputGroupPrepend"></span>
                    </div>
                    <input type="text" name="facebook" class="form-control" id="validationCustomUsername" placeholder="Facebook" value="<?php echo $facebook;?>" aria-describedby="inputGroupPrepend" required>
                  </div><br>
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text fa fa-linkedin" id="inputGroupPrepend"></span>
                    </div>
                    <input type="text" name="linkedin" class="form-control" id="validationCustomUsername" placeholder="Linkedin" value="<?php echo $linkedin;?>" aria-describedby="inputGroupPrepend" required>
                  </div><br>
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text fa fa-github" id="inputGroupPrepend"></span>
                    </div>
                    <input type="text" name="github" class="form-control" id="validationCustomUsername" placeholder="Github" value="<?php echo $github;?>" aria-describedby="inputGroupPrepend" required>
                  </div><br>
                  <div class="input-group input-group-sm">
                    <div class="input-group-prepend">
                      <span class="input-group-text fa fa-chrome" id="inputGroupPrepend"></span>
                    </div>
                    <input type="text" name="website" class="form-control" id="validationCustomUsername" placeholder="Website" value="<?php echo $website;?>" aria-describedby="inputGroupPrepend" required>
                  </div>
                </div>
              </div>
              <center><button style="color: white; background-color: #ce004c;background-image: linear-gradient(19deg, #ce004c 0%, #8203c4 100%);" class="btn btn-sm" name="savechange" type="submit">Save Change</button></center>
          </div>
          <div class="tab-pane fade m-4" id="nav-password" role="tabpanel" aria-labelledby="nav-password-tab">
                <center><div class="col-md-6 mb-3 input-group-sm">
                  <label for="validationCustom03">Present Password</label>
                  <input type="password"  aria-describedby="inputGroup-sizing-sm" name="oldpass" class="form-control text-center" id="validationCustom03" value="" placeholder="Enter present password" required>
                  <div class="text-center">
                    <div class="txt2" style="color: red;">
                      <?php
                        echo $err_oldpass;
                      ?>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 mb-3 input-group-sm">
                  <label for="validationCustom04">New Password</label>
                  <input type="password"  aria-describedby="inputGroup-sizing-sm" name="newpass" class="form-control text-center" id="validationCustom04" value="" placeholder="Enter new password" required>
                </div>
                <div class="col-md-6 mb-3 input-group-sm">
                  <label for="validationCustom05">Confirm New Password</label>
                  <input type="password"  aria-describedby="inputGroup-sizing-sm" name="confirmpass" class="form-control text-center" id="validationCustom05" value="" placeholder="Enter confirm new password" required>
                  <div class="text-center">
                    <div class="txt2" style="color: red;">
                      <?php
                        echo $err_confirmpass;
                      ?>
                    </div>
                  </div>
                </div></center>
              <center><button style="color: white; background-color: #ce004c;background-image: linear-gradient(19deg, #ce004c 0%, #8203c4 100%);" class="btn btn-sm" name="savechange" type="submit">Save Change</button></center>
          </div>
        </div>
        
      </form>
    </div>
    <?php
      }}}
      
    ?>
</div>

<script>
// Add the following code if you want the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>









































































































  </div>
  <!-- /.container -->




  <?php include('footer.php'); ?>