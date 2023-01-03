<?php
session_start(); 
require 'connect.php';

if ($_POST['email'] != "" && $_POST['password'] != "") {

    $email = $_POST['email'];
    $pass = $_POST['password'];

        $sql = "SELECT * FROM registerusers WHERE email='$email' AND password='$pass'";
        $result = mysqli_query($db, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['email'] === $email && $row['password'] === $pass) {
                if($row['usertype'] == 'customer'){
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];
                    header("Location: ../Profile/profile.php");
                    exit();
                }
                if($row['usertype'] == 'verification'){
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];
                    header("Location: ../Profile/verify.php");
                    exit();
                }
                if($row['usertype'] == 'customer'){
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];
                    header("Location: ../Profile/profile.php");
                    exit();
                }
                if($row['usertype'] == 'admin'){
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['name'] = $row['name'];
                    $_SESSION['id'] = $row['id'];
                    header("Location: ../Profile/admin.php");
                }   
            }else{
                echo '<script>
        alert("Invalid Credentials");
        window.location.href="../index.php?err=1";
        </script>';
            }
    }
}else{
    echo '<script>
        alert("Invalid Credentials");
        window.location.href="../index.php?err=1";
        </script>';
    exit();
}

// // SQL QUERY
// $query = "SELECT * FROM `registerusers` where email = '$email' and password = '$password';";
// // FETCHING DATA FROM DATABASE
// $result = mysqli_query($db, $query);

// if (mysqli_num_rows($result) > 0) {
//     // OUTPUT DATA OF EACH ROW
//     // while($row = mysqli_fetch_assoc($result)) {
//     //     echo "Name: " . $row["name"]
//     //     . " - Email: " . $row["email"]. "<br>";
//     // }
    
//     header('location:../Profile/profile.php');
    
// } else {
//     echo '<script>
//     alert("Invalid Credentials");
//     window.location.href="../index.php?err=1";
//     </script>';
// }
?> 