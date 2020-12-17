<?php

    //define database
    define('DB_SERVER','localhost');
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','codinglaugh');

    //connection database
    $conn = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_NAME);

    //cheak connection
    if($conn == false){
        die("Error: Cannot Connection");
    }
?>