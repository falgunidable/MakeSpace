<?php
ob_start();
session_start();
require 'db/connect.php';

if(isset($_SESSION['login_id']) && $_SESSION['login_id']!=''){
    header('Location: home.php');
    exit;
}

require 'vendor/autoload.php';

// Creating new google client instance
$client = new Google_Client();

// Enter your Client ID
$client->setClientId('366491194296-8n69pf2h54cp6bdk4bqojcpasu73tc0b.apps.googleusercontent.com');
// Enter your Client Secrect
$client->setClientSecret('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');
// Enter the Redirect URL
$client->setRedirectUri('http://localhost/makespace/index.php');

// Adding those scopes which we want to get (email & profile Information)
$client->addScope("email");
$client->addScope("profile");


if(isset($_GET['code'])):

    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

        // getting profile information
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();

        //echo "<pre>";
        //var_dump($google_account_info);
    
        // Storing data into database
        $id = mysqli_real_escape_string($db, $google_account_info->id);
        $full_name = mysqli_real_escape_string($db, trim($google_account_info->name));
        $email = mysqli_real_escape_string($db, $google_account_info->email);
        // $profile_pic = mysqli_real_escape_string($db, $google_account_info->picture);

        //echo $email;

        
        $get_user = mysqli_query($db, "SELECT `email` FROM `registerusers` WHERE `email`='$email'");
        if(mysqli_num_rows($get_user) > 0){
            $_SESSION['login_id'] = $email; 
            header('Location: home.php');
            exit;
        }
        else{
            // if user not exists we will insert the user
            $insert = mysqli_query($db, "INSERT INTO `registerusers`(`name`,`email`,`usertype`,`date`) VALUES('$full_name','$email','customer',date(CURRENT_TIMESTAMP))");
            if($insert){
                $_SESSION['login_id'] = $email; 
                header('Location: home.php');
                exit;
            }
            else{
                echo "Sign up failed!(Something went wrong).";
            }
        }
    
else:
    // Google Login Url = $client->createAuthUrl(); 
?>
    <a class="login-btn" href="<?php echo $client->createAuthUrl(); ?>">Login</a>
<?php 
endif; ?>