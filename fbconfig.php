<?php

session_start();

require 'connect.inc.php';

require 'Facebook\Entities\AccessToken.php';
require 'Facebook\HttpClients\FacebookHttpable.php';
require 'Facebook\HttpClients\FacebookCurl.php';
require 'Facebook\HttpClients\FacebookCurlHttpClient.php';


require 'Facebook\FacebookSession.php';
require 'Facebook\FacebookSDKException.php';
require 'Facebook\FacebookRedirectLoginHelper.php';
require 'Facebook\FacebookRequestException.php';
require 'Facebook\FacebookAuthorizationException.php';
require 'Facebook\GraphObject.php';
require 'Facebook\FacebookResponse.php';
require 'Facebook\FacebookRequest.php';


use Facebook\FacebookSession;
use Facebook\FacebookSDKException;
use Facebook\FacebookRedirectLoginHelper;
use Facebook\FacebookRequestException;
use Facebook\FacebookAuthorizationException;
use Facebook\GraphObject;
use Facebook\FacebookResponse;
use Facebook\FacebookRequest;

FacebookSession::setDefaultApplication('1561667477420286', '2c529a100fc9923d66977dd21e6ba018');

$helper = new FacebookRedirectLoginHelper('http://localhost/facebook-login/fbconfig.php');

try {
    $session = $helper->getSessionFromRedirect();
}catch( FacebookRequestException $ex ) {
    // When Facebook returns an error
}catch( Exception $ex ) {
    // When validation fails or other local issues
}

// see if we have a session
if ( isset( $session ) ) {
    // graph api request for user data
    $request = new FacebookRequest( $session, 'GET', '/me' );
    $response = $request->execute();
    // get response
    $graphObject = $response->getGraphObject();
    $fbid = $graphObject->getProperty('id');          
    $fbfullname = $graphObject->getProperty('name');
    $fbemail = $graphObject->getProperty('email');

    $query = "SELECT * FROM `users` WHERE `fb_id` = '$fbid'";
    $query_run = mysqli_query($con,$query);
    if($query_run){
        //check if user exist in database
        $query_num_rows = mysqli_num_rows($query_run);
        if($query_num_rows == 0){
            //if user doesn't exists store user in databse
            $query = "INSERT INTO `users` (username, email, fb_id) VALUES ('$fbfullname','$fbemail','$fbid')";
            $query_run = mysqli_query($con,$query);
            if($query_run){
                header("Location: fbconfig.php");
            }    
        }
        else{
            //store facebook id of user in session
            $_SESSION['FBID'] = $fbid;
            $_SESSION['USERNAME'] = $fbfullname;
            header("Location: index.php");
        }
    }
} 
else {
    $loginUrl = $helper->getLoginUrl();
    header("Location: ".$loginUrl);
}

?>