<?php 
$email = $_SESSION['email'];
$sql = "SELECT name FROM registerusers WHERE email='$email'";
$result = mysqli_query($db, $sql);
$row = mysqli_fetch_assoc($result);
?>
<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="../Navigation/style.css" />
        <style>
           #logout{
                border:none;
                background-color: transparent;
                font-weight:600;
                padding:10px;
            }
            #logout a{
                color: black;
            }
            #logout:focus{
                outline:none;
            }
            #logout:hover{
                background-color: #361500;
                color: white;
                font-weight:300;
            }
            #logout a:hover{
                color: white;
            }
        </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg" style="background-color:#FFC064;font-family:Roboto Slab">
            <a class="navbar-brand" href="../index.php">
                <img src="assets/logoicon.png" width="180" height="45" class="d-inline-block align-top" alt="">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto"></ul>
                <h5 style="margin-top:8px;margin-right:10px"><a href="Profile/profile.php" style="text-decoration:none;color:black">Profile</a></h5>
                <h6 style="color:black;margin-top:10px;margin-right:10px;font-weight:600">Hello, <?php echo $_row['name']; ?></h6>
                <!-- <button id="logbtn" class="btn btn-outline-success my-2 my-lg-0"><b><a href="db/logout.php">Logout</a></b></button>   -->
                <button id="logout"><a style="text-decoration:none;" href="db/logout.php">Logout</a></button>
            </div>
        </nav>
    </body>
</html>