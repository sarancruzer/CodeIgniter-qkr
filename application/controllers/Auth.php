<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//define('FACEBOOK_SDK_V4_SRC_DIR', '/path/to/fb-php-sdk-v4/src/Facebook/');
//require __DIR__ . '/../../facebook-php-sdk-v4-4.0-dev/autoload.php';
require __DIR__ . '/../../google-api-php-client-master/autoload.php';

require __DIR__ . '/../../twitteroauth/autoload.php';

use Abraham\TwitterOAuth\TwitterOAuth;

class Auth extends CI_Controller {
	public function google_oauth2()
	{        
$client = new Google_Client();
$client->setAuthConfigFile('/home/bmptltd/public_html/beta/application/controllers/googleoauth');
$client->setRedirectUri('http://' . $_SERVER['HTTP_HOST'] . '/beta/auth/google_oauth2');
//$client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);
$client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
$client->addScope(Google_Service_Oauth2::USERINFO_PROFILE);


if (isset($_GET['code']))
{
$client->authenticate($_GET['code']);
$_SESSION['access_token'] = $client->getAccessToken();
//$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
//header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}		
	
if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
$client->setAccessToken($_SESSION['access_token']);
}

// Get User Data from Google and store them in $data
if ($client->getAccessToken()) {
$objOAuthService = new Google_Service_Oauth2($client);	
$userData = $objOAuthService->userinfo->get();
  if(isset($userData))
  {
    if($this->session->has_userdata('logged_in'))  
    {
      $user = $this->session->userdata('logged_in');
      
      $sql = 'SELECT * from social_google where user_id = ? AND email = ?';
      $accs = $this->db->query($sql, array($user['id'], $userData->email))->result_array();

      if(count($accs))
      {
        redirect('/account/settings');
      }

      $data = array('user_id' => $user['id'], 'given_name' => $userData->givenName, 'name' => $userData->name, 'email' => $userData->email, 'gender' => $userData->gender, 'link' => $userData->link, 'picture' => $userData->picture, 'family_name' => $userData->familyName, 'created_at' => date('Y-m-d H:i:s'));
      $this->db->insert('social_google', $data);

      $this->db->where('id', $user['id']);
      $this->db->update('users', array('has_google_link'=>1));
      $user['has_google_link'] = 1;
      $this->session->set_userdata($user);
      redirect('/account/settings');
    }
    else
    {
      $sql = 'SELECT * from social_google where email = ?';
      $accs = $this->db->query($sql, array($userData->email))->result_array();
      if(count($accs))
      {
        foreach($accs as $acc)
        {
          if($acc['email'] == $userData->email)
          {
            $sql = 'SELECT * from users where id = ?';
            $users = $this->db->query($sql, array($acc['user_id']))->result_array();
            $user = $users[0];
            $this->session->set_userdata('logged_in', $user);
            redirect('/account/settings');
          }
        }
      }
      else
      {
          date_default_timezone_set('Europe/Berlin');
          $user = array(
           'firstname' => $userData->givenName,
           'lastname' => $userData->familyName,
           'displayname' => $userData->name,
           'email' => $userData->email,
           'has_google_link' => 1,
           'is_fa' => 0,
           'created_at' => date('Y-m-d H:i:s')
         );
         $this->db->insert('users', $user);
         $user['id'] = $this->db->insert_id();
         $data = array('user_id' => $user['id'], 'given_name' => $userData->givenName, 'name' => $userData->name, 'email' => $userData->email, 'gender' => $userData->gender, 'link' => $userData->link, 'picture' => $userData->picture, 'family_name' => $userData->familyName, 'created_at' => date('Y-m-d H:i:s'));
         $this->db->insert('social_google', $data);
    
         $this->session->set_userdata('logged_in',$user);
         redirect('/account/settings');            
      }
    }
  }
}
else {
$authUrl = $client->createAuthUrl();
//$data['authUrl'] = $authUrl;
header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
}

exit;

/*
//$data['userData'] = $userData;
//$_SESSION['access_token'] = $client->getAccessToken();
echo $userData->email;
echo $userData->name;
echo $userData->gender;
echo $userData->pictue;
echo $userData->email.' '.$userData->name.' '.$userData->gender.' '.$userData->link.' '.$userData->picture;
echo 'ended<br>';
print_r($userData); 
unset($_SESSION['access_token']);
} else {
$authUrl = $client->createAuthUrl();
//$data['authUrl'] = $authUrl;
header('Location: ' . filter_var($authUrl, FILTER_SANITIZE_URL));
print_r($authUrl);
}

exit;
if (! isset($_GET['code'])) {
  $auth_url = $client->createAuthUrl();   
  header('Location: ' . filter_var($auth_url, FILTER_SANITIZE_URL));
} else {
  $objOAuthService = new Google_Service_Oauth2($client);
  $client->authenticate($_GET['code']);
  $_SESSION['access_token'] = $client->getAccessToken();
  $client->setAccessToken($_SESSION['access_token']);
  $userData = $objOAuthService->userinfo->get();
$data['userData'] = $userData;
echo $userData->email.' '.$userData->name.' '.$userData->verifiedEmail.' '.$userData->picture;
exit;
//print_r($userData); exit;
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}
*/				
	}	
	public function facebook()
	{
		header('Location: https://www.facebook.com/v2.3/dialog/oauth?client_id=116597725343823&redirect_uri=http://local.quickr.com/auth/facebook_oauth&scope=public_profile,email');
	}
	public function facebook_oauth()
	{
  $code = $_GET['code'];
  //$state = $_GET['state'];
      
      $fields_str = Array();
    
      $fields_str[] = 'code='.$code;
      $fields_str[] = 'redirect_uri=http://local.quickr.com/auth/facebook_oauth';
      $fields_str[] = 'client_id=116597725343823';
      $fields_str[] = 'client_secret=fcc68d82fb49dbfca121ef6e40025f07';
      //$fields_str[] = 'grant_type=client_credentials';

      $field_str = implode('&', $fields_str);
      $handle = curl_init();
      curl_setopt($handle, CURLOPT_URL, 'https://graph.facebook.com/v2.3/oauth/access_token');
    
      curl_setopt($handle, CURLOPT_POSTFIELDS, $field_str);
      curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 2);
      curl_setopt($handle, CURLOPT_TIMEOUT, 2);
      curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
      
      $response = curl_exec($handle);      
      curl_close ($handle); 
      //var_dump($response); exit;
      $arr = json_decode($response);
      //curl_setopt($ch,CURLOPT_HTTPHEADER,array('HeaderName: HeaderValue'));
      $acc_token = $arr->access_token;
      $fields_str = Array();

      $handle = curl_init();
      curl_setopt($handle, CURLOPT_URL, 'https://graph.facebook.com/v2.3/me');
    
      //curl_setopt($handle, CURLOPT_GET);
      //curl_setopt($handle, CURLOPT_POSTFIELDS, $field_str);
      curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 2);
      curl_setopt($handle, CURLOPT_TIMEOUT, 2);
      curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($handle, CURLOPT_HTTPHEADER,array('Authorization: Bearer '.$acc_token));
      $response = curl_exec($handle);      
      curl_close ($handle); 
      var_dump($response); exit;      

	}
	
	public function google()
	{
unset($_SESSION['access_token']);
$client = new Google_Client();
$client->setAuthConfigFile('/home/bmptltd/public_html/beta/application/controllers/googleoauth');
//$client->addScope(Google_Service_Drive::DRIVE_METADATA_READONLY);
$client->addScope(Google_Service_Oauth2::USERINFO_EMAIL);
$client->addScope(Google_Service_Oauth2::USERINFO_PROFILE);

if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
  $client->setAccessToken($_SESSION['access_token']);
  $drive_service = new Google_Service_Drive($client);
  $files_list = $drive_service->files->listFiles(array())->getItems();
  echo json_encode($files_list);
} else {
  $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . '/beta/auth/google_oauth2';
  header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));
}		
	}	
	
public function twitter()
{
$this->load->library('session');
// The TwitterOAuth instance
//$twitteroauth = new TwitterOAuth('HAxM51E0y4xHlSMpfqxYDsoqt', 'L8OEr6fsvZAsTOEvOlKNKnNQWtqZCVJtPifSypd96rKtt8GzXF');
// Requesting authentication tokens, the parameter is the URL we will be redirected to
//$request_token = $twitteroauth->oauth('http://local.quickr.com/twitter_oauth');
 //$result = $twitteroauth->oauth('oauth/request_token', array('oauth_callback' => 'http://local.quickr.com/auth/twitter_oauth'));
 
 
 //$connection = new TwitterOAuth('HAxM51E0y4xHlSMpfqxYDsoqt', 'L8OEr6fsvZAsTOEvOlKNKnNQWtqZCVJtPifSypd96rKtt8GzXF','403917800-NJaTu5JxyfCvp5PmPBSnuGTddKSGR74gDlpBwX1a', 'kxsV7N8Yr6C9pW6y7H31SJluWKNGrpPCXPOls2qeRDTyV');
 $connection = new TwitterOAuth('HAxM51E0y4xHlSMpfqxYDsoqt', 'L8OEr6fsvZAsTOEvOlKNKnNQWtqZCVJtPifSypd96rKtt8GzXF');
 //$request_token = $connection->getRequestToken('http://local.quickr.com/auth/twitter_oauth');// Retrieve Temporary credentials.
 $request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => 'http://local.quickr.com/auth/twitter_oauth'));
 
$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
 
    $url = $connection->url('oauth/authorize', array('oauth_token'=>$token)); // Redirect to authorize page.
    header('Location: ' . $url);
exit;
        //$result = $twitter->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
// Saving them into the session
$_SESSION['oauth_token'] = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
 
// If everything goes well..
if($twitteroauth->http_code==200){
    // Let's generate the URL and redirect
    $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
    header('Location: '. $url);
} else {
    // It's a bad idea to kill the script, but we've got to know when there's an error.
    die('Something wrong happened.');
}
}

public function twitter_oauth()
{
$this->load->library('session');
if(!empty($_GET['oauth_verifier']) && !empty($_SESSION['oauth_token']) && !empty($_SESSION['oauth_token_secret'])){
     //We've got everything we need
     
} else {
     //Something's missing, go back to square 1
    return header('Location: /account/login');
}
// TwitterOAuth instance, with two new parameters we got in twitter_login.php
//$twitteroauth = new TwitterOAuth('HAxM51E0y4xHlSMpfqxYDsoqt', 'L8OEr6fsvZAsTOEvOlKNKnNQWtqZCVJtPifSypd96rKtt8GzXF', $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
$connection = new TwitterOAuth('HAxM51E0y4xHlSMpfqxYDsoqt', 'L8OEr6fsvZAsTOEvOlKNKnNQWtqZCVJtPifSypd96rKtt8GzXF',$_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
//$connection = new TwitterOAuth('HAxM51E0y4xHlSMpfqxYDsoqt', 'L8OEr6fsvZAsTOEvOlKNKnNQWtqZCVJtPifSypd96rKtt8GzXF','403917800-NJaTu5JxyfCvp5PmPBSnuGTddKSGR74gDlpBwX1a', 'kxsV7N8Yr6C9pW6y7H31SJluWKNGrpPCXPOls2qeRDTyV');
// Let's request the access token
//$access_token = $connection->getAccessToken($_GET['oauth_verifier']);

$access_token = $connection->oauth("oauth/access_token", array("oauth_verifier" => $_GET['oauth_verifier']));
// Save it in a session var
//print_r($access_token); exit;
$connection = new TwitterOAuth('HAxM51E0y4xHlSMpfqxYDsoqt', 'L8OEr6fsvZAsTOEvOlKNKnNQWtqZCVJtPifSypd96rKtt8GzXF','403917800-NJaTu5JxyfCvp5PmPBSnuGTddKSGR74gDlpBwX1a', 'kxsV7N8Yr6C9pW6y7H31SJluWKNGrpPCXPOls2qeRDTyV');
//$_SESSION['access_token'] = $access_token;
// Let's get the user's info
$user_info = $connection->get('users/show',array('screen_name'=>$access_token['screen_name']));
// Print user's info
print_r($user_info); exit;

}		
public function linkedin()
{
 header('Location: https://www.linkedin.com/uas/oauth2/authorization?response_type=code&client_id=757x8e28mf97xu&redirect_uri=http%3A%2F%2Flocal.quickr.com%2Fauth%2Flinkedin_oauth&state=987654321&scope=r_basicprofile%20r_emailaddress');
}
public function linkedin_oauth()
{
  //print_r($_GET); exit;
  $code = $_GET['code'];
  $state = $_GET['state'];
  
      $fields_str = Array();

      $fields_str[] = 'grant_type=authorization_code';
      $fields_str[] = 'code='.$code;
      $fields_str[] = 'redirect_uri=http://local.quickr.com/auth/linkedin_oauth';
      $fields_str[] = 'client_id=757x8e28mf97xu';
      $fields_str[] = 'client_secret=0477oTr2YCFyJhyh';

      $field_str = implode('&', $fields_str);
      $handle = curl_init();
      curl_setopt($handle, CURLOPT_URL, 'https://www.linkedin.com/uas/oauth2/accessToken');
    
      curl_setopt($handle, CURLOPT_POST, 5);
      curl_setopt($handle, CURLOPT_POSTFIELDS, $field_str);
      curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 2);
      curl_setopt($handle, CURLOPT_TIMEOUT, 2);
      curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
      
      $response = curl_exec($handle);      
      curl_close ($handle); 
      //var_dump($response); exit;
      $arr = json_decode($response);
      //curl_setopt($ch,CURLOPT_HTTPHEADER,array('HeaderName: HeaderValue'));
      
      $fields_str = Array();

      //$fields_str[] = 'grant_type=authorization_code';
      //$fields_str[] = 'code='.$code;
      //$fields_str[] = 'redirect_uri=http://local.quickr.com/auth/linkedin_oauth';
      //$fields_str[] = 'client_id=757x8e28mf97xu';
      //$fields_str[] = 'client_secret=0477oTr2YCFyJhyh';

      $field_str = implode('&', $fields_str);
      $handle = curl_init();
      curl_setopt($handle, CURLOPT_URL, 'https://api.linkedin.com/v1/people/~:(id,first-name,last-name,email-address)?format=json');
    
      //curl_setopt($handle, CURLOPT_GET);
      //curl_setopt($handle, CURLOPT_POSTFIELDS, $field_str);
      curl_setopt($handle, CURLOPT_CONNECTTIMEOUT, 2);
      curl_setopt($handle, CURLOPT_TIMEOUT, 2);
      curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($handle, CURLOPT_HTTPHEADER,array('Authorization: Bearer '.$arr->access_token));
      $response = curl_exec($handle);      
      curl_close ($handle); 

      var_dump($response); exit;
}
}
