<?php 

    $servername = 'localhost';
    $username = 'shourav';
    $password = 'test1234';
    $dbname = 'food';
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // if ($conn->connect_error) {
    //     die("Connection Error: " . $conn->connect_error);
    // }
?>