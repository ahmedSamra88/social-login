<?php

// satrt session
session_start();
// google client library
require_once "vendor/autoload.php";
// user class
require_once "user.php";
// database
$user=new  User();

// Google Client
$google_client = new Google_Client();
$google_client->setClientId('623252265251-e263j44ulpksp9elmi2scjffcoi2h7li.apps.googleusercontent.com');
$google_client->setClientSecret('y5_mC5lq27s7k4jpRjMFGiXK');
$google_client->setRedirectUri('http://localhost/social-login/');
$google_client->addScope('email');
$google_client->addScope('email');

// Facebook
$fb = new Facebook\Facebook([
    'app_id' => '549894026330303',
    'app_secret' => '89da0b1e8a44e3edbf972cccdf0a921f',
    'default_graph_version'=>'v2.10'
]);
$helper = $fb->getRedirectLoginHelper();
$fb_login_url = $helper->getLoginUrl('http://localhost/social-login/');
if (isset($_GET['code'])) {
    $goToken=$google_client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (!isset($goToken['error'])) {//access success
        $google_client->setAccessToken($goToken['access_token']);
        $_SESSION['go_access_token']=$goToken['access_token'];
        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();
        
        if(!empty($data['email'])){
            $_SESSION['email']=$data['email'];
            $user_name = $_SESSION['email'];
            //save data to db

            $user->replace($data['email'],date('d-m-y h:i:s'));
        }
        if(!empty($data['picture'])){
            $_SESSION['picture']=$data['picture'];
            $profile_pic=$_SESSION['picture'];
        }
    }else{
        try {
            $accesstoken = $helper->getAccessToken();
            if (isset($accesstoken)) {
                $_SESSION['fac_access_token']=(string) $accesstoken;
                // header("location:index.php");
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
        if (isset($_SESSION['fac_access_token'])) {
            $fb->setDefaultAccessToken($_SESSION['fac_access_token']);
            $res=$fb->get('/me?locale=en_us&fileds=name,email');
            $fb_profile= $res->getGraphuser();
            $user_name=$fb_profile['name'];
            $fid=$fb_profile['id'];
            $profile_pic='http://graph.facebook.com/'.$fid.'/picture?type=large';
            //save data to db

            $user->replace($user_name,date('d-m-y h:i:s'));
        }
    }
}
