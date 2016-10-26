<?php
// USER LOGIN AUTHENTICATION FUNCTIONALITY .... 
if(isset($_POST['submit']))
{
	$username = $_POST['user_name'];
	$password = $_POST['user_pwd'];
	
	if(!empty($username) && !empty($password))
	{
		login_check($username, $password);
	}	
}

// ERROR MESSAGE GENERATION .....
if(isset($_GET['error']))
{
	if((int)$_GET['error'] === 1)
		$error_msg = "Wrong Username / Password !";

}
else
{
	$error_msg = '';
}

include('includes/header.php'); 

?>
<body style="background:#F7F7F7;">

  <div class="">
    <a class="hiddenanchor" id="toregister"></a>
    <a class="hiddenanchor" id="tologin"></a>

    <div id="wrapper">
      <div id="login" class="animate form">
        <section class="login_content">
          <form name="loginFrm" action="" method="post">
            <h1>Login Form</h1>
            <div>
              <input type="text" class="form-control" placeholder="Username" name="user_name" id="username" required="" />
            </div>
            <div>
              <input type="password" class="form-control" placeholder="Password" name="user_pwd" id="password" required="" />
            </div>
            <div>
            <button type="submit" name="submit" class="btn btn-default submit">Login</button>
             
              <!--<a class="reset_pass" href="#"> Forget password?</a>-->
            </div>
            <div class="clearfix"></div>
            
              </form>
             
<?php include('includes/footer.php'); ?>