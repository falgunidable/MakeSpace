<?php
require 'connect.php';

$name =  $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$utype = $_POST['usertype'];

$sql = "INSERT INTO registerusers (name, email, password,usertype,date)
VALUES ('$name', '$email', '$password', '$utype',date(CURRENT_TIMESTAMP))";

if (mysqli_query($db, $sql)) {
    echo '<script>
    alert("You are Registered Successfully");
    window.location.href="../index.php";
    </script>';
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($db);
}

?> 