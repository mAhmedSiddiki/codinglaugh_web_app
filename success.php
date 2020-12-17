<?php

session_start();

// check if the user is already logged in
if(isset($_SESSION['username'])){
  header("location: contact1");
  exit;
}

?>

