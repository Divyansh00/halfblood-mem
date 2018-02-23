<?php
session_start();

$db=mysqli_connect("127.0.0.1:3307", "root", "", "toystory");

if(!$db)
{
	echo ("Couldnt connect to the database");
}
else
{
	if(isset($_POST['login_btn']))
	{
	$username=mysqli_real_escape_string($db, $_POST['username']);
	$password=mysqli_real_escape_string($db, $_POST['password']);
	//$password=md5($password);
	$query = "SELECT customername, customerpassword FROM customers WHERE customername='$username' AND customerpassword='$password'";	
	$result = mysqli_query($db,$query)or die(mysqli_error());
	$num_row = mysqli_num_rows($result);
	 if( $num_row >= 1 )
	{
     while( $row=mysqli_fetch_array($result) )
	 {
	     $_SESSION['loggedIn'] = true;  	
      $_SESSION['username'] = $row['customername'];
	  header("Location: http://localhost/toystory/homepage.php");
     }
	}
	else
	{
	echo ("enter credentials correctly");
	}
	}
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>TOYSTORY</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
      <link rel="stylesheet" href="css/style.css">

  
</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

  <div class="log-form">
  <h2>Login to your account</h2>
  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
  
    <input type="text" name="username" placeholder="username" />
    <input type="password" name="password" placeholder="password"/>
    <button type="submit" class="btn" name='login_btn'>Login</button>
    <a class="forgot">Forgot Username?</a>
  
  </form>
</div><!--end log form -->
<div class="fb-login-button" data-max-rows="1" data-size="large" data-button-type="continue_with" data-show-faces="false" data-auto-logout-link="false" data-use-continue-as="false">
hihi
</div>

</body>

</html>
