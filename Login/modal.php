<?php

require 'db/connect.php';

if(isset($_SESSION['email']) && $_SESSION['email']!=''){
    header('Location: Profile/profile.php');
    exit;
}

// require 'vendor/autoload.php';

// // init configuration
// $clientID = '366491194296-2gmpgto38vqtlfjb65q1jm5usnj0ur3u.apps.googleusercontent.com';
// $clientSecret = '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';
// $redirectUri = 'http://localhost/makespace/Profile/profile.php';
   
// create Client Request to access Google API
// $client = new Google_Client();
// $client->setClientId($clientID);
// $client->setClientSecret($clientSecret);
// $client->setRedirectUri($redirectUri);
// $client->addScope("email");
// $client->addScope("profile");


// if(isset($_GET['code'])):

//     $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
//   $client->setAccessToken($token['access_token']);
   
//   // get profile info
//   $google_oauth = new Google_Service_Oauth2($client);
//   $google_account_info = $google_oauth->userinfo->get();
//   $email =  $google_account_info->email;
//   $name =  $google_account_info->name;

//         //echo "<pre>";
//         //var_dump($google_account_info);
    
//         // Storing data into database
//         $id = mysqli_real_escape_string($db, $google_account_info->google_oauth);
//         $full_name = mysqli_real_escape_string($db, trim($google_account_info->name));
//         $email = mysqli_real_escape_string($db, $google_account_info->email);
        // $profile_pic = mysqli_real_escape_string($db, $google_account_info->picture);

        //echo $email;

        
        // $get_user = mysqli_query($db, "SELECT `email` FROM `registerusers` WHERE `email`='$email'");
        // if(mysqli_num_rows($get_user) > 0){
        //     $_SESSION['id'] = $id; 
        //     $_SESSION['email'] = $email; 
        //     header('Location: Profile/profile.php');
        //     exit;
        // }
        // else{
        //     // if user not exists we will insert the user
        //     $insert = mysqli_query($db, "INSERT INTO `registerusers`(`name`,`email`,`usertype`,`date`) VALUES('$full_name','$email','customer',date(CURRENT_TIMESTAMP))");
        //     if($insert){
        //         $_SESSION['id'] = $id;
        //         $_SESSION['email'] = $email; 
        //         header('Location: Profile/profile.php');
        //         exit;
        //     }
        //     else{
        //         echo "Sign up failed!(Something went wrong).";
        //     }
        // }
    
// else:
    // Google Login Url = $client->createAuthUrl(); 
?>

<link rel="stylesheet" href="Login/modal.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@400&display=swap');

    #loginModal,#register {
        font-family: 'Roboto Slab', sans-serif;
        text-align:center;
        color: #1C0A00
    }

    #email,#emailr,#password,#passwordr,#name {
        box-shadow: 0 0 2px 2px #888;
    }
    #sublogin,#subregister {
        margin-top: 20px;
        border: none;
        background-color: #361500;
    }
    #sublogin:hover,#subregister:hover {
        opacity:0.8;
        border: 0;
        box-shadow: 0 10px 20px -8px rgba(0, 0, 0,1.0);
    }
    .glogin-btn{
        color:black;
        font-weight:600;
        background-color:white;
        padding:10px
    }
    .glogin-btn:hover{
        text-decoration:none;
        opacity:0.6
    }
    #name-error{
    margin-left:232px
  }
    @media only screen and (max-width: 600px) {
  #loginModal{
    width:90%;
    margin:auto
  }
  .login-form{
    width: 420px;
    padding-top: 10px;
    padding-bottom: 30px;
    border-radius: 8px;
  }
  #email,#password,#name,#emailr,#passwordr{
    width:80%
  }
  #name-error{
    margin-left:270px
  }
 }
</style>
<!-- <script src="https://apis.google.com/js/platform.js" async defer></script> -->

<div
    class="modal fade"
    id="loginModal"
    tabindex="-1"
    role="dialog"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body" style="background-color:#CC9544;padding:20px;">
                <div id="login" class="login-container" style="text-align:center">
                    <form
                        class="login-form"
                        method="post"
                        action="db/loginCheck.php"
                        style="background-color:#CC9544;">
                        <div class="login-form-content">
                            <h5 class="login-form-title" style="color: #1C0A00;"><b>LogIn</b>
                                <img src="assets/log.png" width="35px" style="vertical-align:middle"/></h5><br/>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align:left;color:#1C0A00">Email Id</label>
                                <div class="col-sm-8">
                                <span id="emaile" style="font-size:12px;color:#1C0A00;position:absolute;margin-left:120px;margin-top:0px;font-weight:600"></span>
                                    <input
                                        id="email"
                                        name='email'
                                        type='email'
                                        class="form-control"
                                        placeholder="Enter email" onkeyup="validateEmailL()"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align:left;color:#1C0A00">Password</label>
                                <div class="col-sm-8">
                                <span id="passe" style="font-size:12px;color:#1C0A00;position:absolute;margin-left:120px;margin-top:1px;font-weight:bolder"></span>
                                    <input
                                        id="password"
                                        name="password"
                                        type="password"
                                        class="form-control mt-1"
                                        placeholder="Enter password" onkeyup="validatePassL()"/>
                                </div>
                            </div>
                            <div class="d-grid gap-2 mt-3" style="text-align:center;">
                                <button id="sublogin" type="submit" class="btn btn-primary">
                                    SignIn
                                </button>
                            </div>
                            <p class="text-center mt-2" style="cursor:pointer;" onclick="Register()">
                                Not registered yet?
                                <span class="link-primary">
                                    <b>SignUp</b>
                                </span>
                            </p>
                            <div class="g-signin2" data-onsuccess="onSignIn"></div>
                        </div>
                        <!-- <a class="glogin-btn" href="<?php 
                        // echo $client->createAuthUrl(); ?>"><img src="assets/google.png" width="20px" style="vertical-align:middle"/> Google Login</a> -->
                    </form>
                </div>

                <div id="register" class="login-container" style="display:none;text-align:center">
                    <form class="login-form" method="post" action="db/insert.php">
                        <div class="login-form-content">
                            <h5 class="login-form-title" style="color: #1C0A00;"><b>SignUp</b> 
                                <img src="assets/log.png" width="40px" style="vertical-align:middle"/></h5><br/>
                            <div class="form-group row" style="text-align:left">
                                <label class="col-sm-4 col-form-label" style="color:#1C0A00">Full Name</label>
                                <div class="col-sm-8">
                                <span id="name-error" style="font-size:12px;color:#1C0A00;position:absolute;margin-top:2px;font-weight:bolder"></span>
                                    <input
                                        id="name"
                                        type="text"
                                        name='name'
                                        class="form-control mt-1"
                                        placeholder="e.g Jane Doe" onkeyup="validateName()" style="font-size:14px"/>   
                                        
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align:left;color:#1C0A00">Email</label>
                                <div class="col-sm-8">
                                <span id="email-error" style="font-size:12px;color:#1C0A00;position:absolute;margin-left:120px;margin-top:2px;font-weight:bolder"></span>
                                    <input
                                        id="emailr"
                                        type="email"
                                        name='email'
                                        class="form-control mt-1"
                                        placeholder="Email Address" onkeyup="validateEmail()"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label" style="text-align:left;color:#1C0A00">Password</label>
                                <div class="col-sm-8">
                                <span id="pass-error" style="font-size:12px;color:#1C0A00;position:absolute;margin-left:120px;margin-top:2px;font-weight:bolder"></span>
                                    <input
                                        id="passwordr"
                                        type="password"
                                        name='password'
                                        class="form-control mt-1"
                                        placeholder="Password" onkeyup="validatePass()"/>
                                </div>
                            </div>
                            <input type="hidden" name="usertype" value="customer"/>
                            <div class="d-grid gap-2 mt-3" style="text-align:center">
                                <button id="subregister" type="submit" class="btn btn-primary">
                                    SignUp
                                </button>
                            </div>
                            <p class="text-center mt-2" style="cursor:pointer" onclick="Login()">
                                Already registered?
                                <span class="link-primary">
                                    <b>SignIn</b>
                                </span>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function Register() {
        document.getElementById('login').style.display = "none";
        document.getElementById('register').style.display = "block";
    }
    function Login() {
        document.getElementById('register').style.display = "none";
        document.getElementById('login').style.display = "block";
    }

    var nameError = document.getElementById('name-error');
    var emailError = document.getElementById('email-error');
    var passError = document.getElementById('pass-error');
    var emailErr = document.getElementById('emaile');
    var passErr = document.getElementById('passe');

    function validateName(){
        var name = document.getElementById('name').value;

        if(name.length == 0){
            nameError.innerHTML = "Name required";
            return false;
        }
        if(!name.match(/^[A-Za-z]*\s{1}[A-Za-z]*$/)){
            nameError.innerHTML = "Full Name";
            return false;
        }
        nameError.innerHTML = '<i class="fa fa-check-circle" style="margin-top:10px;color:white;font-size:18px"></i>';
        return true;
    }
    function validateEmail(){
        var email = document.getElementById('emailr').value;

        if(email.length == 0){
            emailError.innerHTML = "Email required";
            return false;
        }
        if(!email.match(/^[A-Za-z\._\-[0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/)){
            emailError.innerHTML = "Invalid Email";
            return false;
        }
        emailError.innerHTML = '<i class="fa fa-check-circle" style="margin-top:10px;color:white;font-size:18px"></i>';
        return true;
    }
    function validateEmailL(){
        var email = document.getElementById('email').value;

        if(email.length == 0){
            emailErr.innerHTML = "Email required";
            return false;
        }
        if(!email.match(/^[A-Za-z\._\-[0-9]*[@][A-Za-z]*[\.][a-z]{2,4}$/)){
            emailErr.innerHTML = "Invalid Email";
            return false;
        }
        emailErr.innerHTML = '<i class="fa fa-check-circle" style="margin-top:10px;color:white;font-size:18px"></i>';
        return true;
    }
    function validatePass(){
        var pass = document.getElementById('passwordr').value;

        if(pass.length == 0){
            passError.innerHTML = "Password required";
            return false;
        }
        if(pass.length<7){
            passError.innerHTML = "Password too small";
            return false;
        }
        passError.innerHTML = '<i class="fa fa-check-circle" style="margin-top:10px;color:white;font-size:18px"></i>';
        return true;
    }
    function validatePassL(){
        var pass = document.getElementById('password').value;

        if(pass.length == 0){
            passErr.innerHTML = "Password required";
            return false;
        }
        if(pass.length<7){
            passErr.innerHTML = "Password too small";
            return false;
        }
        passErr.innerHTML = '<i class="fa fa-check-circle" style="margin-top:10px;color:white;font-size:18px"></i>';
        return true;
    }
</script>