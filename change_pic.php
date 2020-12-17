<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
    header("location: login");
}
require_once "config.php";
$username = $_SESSION['username'];
$imgW = 400;
$imgH = 400;
if(isset($_REQUEST['doAction']) && $_REQUEST['doAction']== 'submit'){
    
    if(isset($_FILES['image'])){
        $time = time();
        $rand = rand();
        $filename =  $time . '_' . $rand . '.png';
        $output_file = "img/user/".$filename;
        move_uploaded_file($_FILES["image"]["tmp_name"], $output_file);
        $ret['status'] = true;
        $ret['msg'] = "Successfully changed profile photo to your codinglaugh profile.";
        echo json_encode($ret);
        $updatesql = "UPDATE users SET img_file='$filename' WHERE username='$username'";
        $upresult = mysqli_query($conn, $updatesql);
        exit;
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

<link type="text/css" media="screen" rel="stylesheet" href="css/jquery.cropbox.css">
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












<div class="container">
    <center><form id="formbanner" action="" method="post" enctype="multipart/form-data">
        <input type="file" name="banner" class="upImage" >
        <input type="hidden" name="photo" value="" id="fileinp">
        <br>
        <br>
        <img class="cropimage" id="myImg" src="#" alt="" />
        <br>
        <br>
        <div class="form-group" >
            <input type="submit" style="color: white; background-color: #ce004c;background-image: linear-gradient(19deg, #ce004c 0%, #8203c4 100%);" class="btn btn-sm" name="submit" id="save_banner" value="Submit">
                            <img class="loadingimage" style="display: none;" src="img/loading.gif" width="64" height="20"/>
        </div>
        <br>
    </form></center>
</div>
















<!-- Footer -->
<section id="footer" style="background-color: #FA8BFF;background-image: linear-gradient(45deg, #FA8BFF 0%, #2BD2FF 52%, #2BFF88 90%);">
		<div class="container">
			<div class="row text-center text-xs-center text-sm-left text-md-left">
				<div class="col-xs-12 col-sm-4 col-md-4">
					<h5>codinglaugh</h5>
					<p align=" justify" style="color: black;font-size:14px;">
                        This is a biggest website to learn programming language. Best for the python programming language.
                        Enjoy and learn programming language from codinglaugh.
                    </p>
        <ul class="list-unstyled quick-links">
        <li><a target="_blank" class="text-xs-center list-unstyled" style="font-size: 18px;" href="https://play.google.com/store/apps/details?id=com.codinglaugh.codinglaugh&hl=en&gl=US"><i class="fa fa-angle-double-right"></i>Get App</a></li>
        </ul>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="container videoContainer embed-responsive embed-responsive-16by9">
                        <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/hb7BVSQxiy4?>" allowfullscreen></iframe>
                    </div>
                </div>
				<div class="col-xs-12 col-sm-4 col-md-4">
					<h5>Quick links</h5>
					<ul class="list-unstyled quick-links">
						<li style="font-size: 15px;"><a target="_blank" href="index"><i class="fa fa-angle-double-right"></i>Home</a></li>
						<li style="font-size: 15px;"><a target="_blank" href="course"><i class="fa fa-angle-double-right"></i>Course</a></li>
						<li style="font-size: 15px;"><a target="_blank" href="blog"><i class="fa fa-angle-double-right"></i>Blog</a></li>
						<li style="font-size: 15px;"><a target="_blank" href="contact"><i class="fa fa-angle-double-right"></i>Contact</a></li>
						<li style="font-size: 15px;"><a target="_blank" href="marjuk"><i class="fa fa-angle-double-right"></i>Founder</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
					<ul class="list-unstyled list-inline social text-center">
						<li class="list-inline-item"><a href="https://www.facebook.com/codinglaugh" target="_blank"><i class="fa fa-facebook"></i></a></li>
						<li class="list-inline-item"><a href="https://twitter.com/marjuk_ahmed0" target="_blank"><i class="fa fa-twitter"></i></a></li>
						<li class="list-inline-item"><a href="https://www.youtube.com/channel/UCtPoYxNA8UtdQg4aCNkS7Dg" target="_blank"><i class="fa fa-youtube"></i></a></li>
						<li class="list-inline-item"><a href="https://www.instagram.com/codinglaugh/" target="_blank"><i class="fa fa-instagram"></i></a></li>
						<li class="list-inline-item"><a href="https://github.com/Marjuk-Ahmed-Siddiki" target="_blank"><i class="fa fa-github"></i></a></li>
						<li class="list-inline-item"><a href="https://www.linkedin.com/in/marjukahmed/" target="_blank"><i class="fa fa-linkedin"></i></a></li>
					</ul>
				</div>
				</hr>
			</div>	
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
					<p class="h6" style="color: black;">&copy All right Reversed. codinglaugh</p>
				</div>
				</hr>
			</div>	
		</
	</section>
	<!-- ./Footer -->

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>




 <script src="js/jquery.js"></script>
   <script type="text/javascript" src="js/jquery.mousewheel.js"></script>
  <script type="text/javascript" src="js/jquery.cropbox.js"></script>
  
  <script type="text/javascript">
var myImage = '';   
$(function () {
   
    $(".upImage").change(function () {
       
        var ext = $(this).val().split('.').pop().toLowerCase();
        if($.inArray(ext, ['gif','png','jpg','jpeg']) == -1) {
           alert('Please select a valid image [ jpg | jpeg | gif | png ]');
            $(this).val('');
            myImage= '';
            clearImage();
       
        }else{   
       
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                reader.readAsDataURL(this.files[0]);
            }
        }
    });
    
    function imageIsLoaded(e) {
        $('.cropCont').show();
        $('#myImg').attr('src', e.target.result);
        $('#myImg').show();
        $( '.cropimage' ).cropbox( {width: <?php echo $imgW; ?>, height: <?php echo $imgH; ?>, showControls: 'auto' } ).on('cropbox', function( event, results, img ) {
            myImage = img.getDataURL();
        });
    }
    
    function clearImage(){
        $('.cropCont').hide();
        $("#banner").val('');
        $("#myImg").removeAttr('src');
        $('#myImg').hide();
    }
    
    $('#formbanner').submit(function(e){
        
        e.preventDefault();
        $('#save_banner').attr('disabled',true);
        $('.loadingimage').show();
        var form = $('#formbanner')[0]; 
        var fd = new FormData(form);
        if(myImage != ''){
            var block = myImage.split(";");
            var contentType = block[0].split(":")[1];// In this case "image/gif"
            var realData = block[1].split(",")[1];// In this case "R0lGODlhPQBEAPeoAJosM...."
            var blob = b64toBlob(realData, contentType);
            fd.append("image", blob);
        }
        $.ajax({
          url: '?doAction=submit',
          data: fd,
          processData: false,
          contentType: false,
          type: 'POST',
          dataType : 'json',
          success: function(data){
             alert(data.msg);
             if(data.status){
                window.location='profile';
            }else{
                $('#save_banner').attr('disabled',false);
                $('.loadingimage').hide(3000);
            }


          }
        });

    });
});






function b64toBlob(b64Data, contentType, sliceSize) {
        contentType = contentType || '';
        sliceSize = sliceSize || 512;

        var byteCharacters = atob(b64Data);
        var byteArrays = [];

        for (var offset = 0; offset < byteCharacters.length; offset += sliceSize) {
            var slice = byteCharacters.slice(offset, offset + sliceSize);

            var byteNumbers = new Array(slice.length);
            for (var i = 0; i < slice.length; i++) {
                byteNumbers[i] = slice.charCodeAt(i);
            }

            var byteArray = new Uint8Array(byteNumbers);

            byteArrays.push(byteArray);
        }

      var blob = new Blob(byteArrays, {type: contentType});
      return blob;
}


    </script>
             


             </body>

</html>             