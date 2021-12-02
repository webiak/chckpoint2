<?php
    $conn = new mysqli("localhost","root", "", "todolist");

    if ($conn->connect_error){
        die("Could not connect to the database!".$conn->connect_error);
    }
?>
