<?php
// session start // 
session_start();
ob_start();
error_reporting(E_ALL);
date_default_timezone_set('Asia/kolkata');

// include file //
include('constant.php');

 function db_conect()
 {
	$con = mysql_connect(SERVER_NAME,USER_NAME,PASSWORD)or die(mysql_error());
	mysql_select_db(DATABASE,$con)or die(mysql_error());
 }
 
 db_conect(); // Connect to file and database server ...

function encryptIt( $q ) {
    $cryptKey  = CRYPTKEY;
    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
    return( $qEncoded );
}

function decryptIt( $q ) {
    $cryptKey  = CRYPTKEY;
    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
    return( $qDecoded );
}

 function login_check($user, $pass)
 {
    $sql = "SELECT user_id, user_name, user_pwd, role_id 
			FROM ".USER_MASTER." 
			WHERE user_name='".$user."' AND user_pwd='".$pass."' AND role_id= 1
		   ";

    $execute = mysql_query($sql) or mysql_error($sql);
    $result1 = mysql_fetch_object($execute);
	
	if($result1)
	{
	    if($result1->user_id > 0)
	    {
	        $_SESSION['login_status']='yes';
			
	        $_SESSION['login_id'] 	= $result1->user_id;
	        $_SESSION['login_data'] = $result1;
	        redirect('/?page=index');
	    }
		else
		{
			redirect('/?page=index&error=1');
		}		
	}
    else {
		redirect('/?page=index&error=1');
	}

 }
 
 
 function securityCheck($id)
{
	$request_url = $_SERVER['REQUEST_URI'];
	
	if(strpos($request_url, 'admin'))
	 	$role = 1;
	 
	 	
  $sql = "SELECT role_id FROM ".USER_MASTER." WHERE user_id = $id";
  $query = mysql_query($sql);
  
  if($query)
  {
  	$array = mysql_fetch_assoc($query);
	$user_role = $array['role_id'];
	
	if($role == $user_role)
		return true;
	else	
		return false;
  }
  else
  {
  	return false;
  }
  
} 
 

function logout()
{
    session_unset();
}

function redirect($path)
{
    ob_start();
    header('Location: '.SITE_URL.$path);
    ob_end_flush();
    die();
}

 function rest_pass($oldpass, $newpass)
 {
    $login_data = $_SESSION['login_data'];
	
    if($oldpass == $login_data->user_pwd )
    {
        $sql = "UPDATE ".USER_MASTER." SET user_pwd='".$newpass."' WHERE user_id='".$login_data->user_id."'" ;
        $execute = mysql_query($sql) or mysql_error($sql);
		$_SESSION['success'] 	= "Password reset successfully. Please <a href='".SITE_URL."?page=logout'>logout now</a>.....";
        
    }
    else
    {
		$_SESSION['error'] = "Given old password is wrong";
    }
    redirect('/?page=reset_password');
 }
 
 function getDetailsByUsername($username)
 {
    $sql = "select * from user where username='".$user."'" ;
    $execute = mysql_query($sql) or mysql_error($sql);
    $result1 = mysql_fetch_object($execute);
	echo decryptIt($result1->password); die();
 }




















//echo encryptIt('admin');















?>