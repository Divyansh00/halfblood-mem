<!doctype html>
<html>
<?php
session_start();
$errpass="";
$db=mysqli_connect("127.0.0.1:3307", "root", "", "toystory");
if($db)
{
if(isset($_POST['REGISTER']))
{
	echo"hihihi";
	if($_POST['password']==$_POST['password2'])
	{
	$name=mysqli_real_escape_string($db, $_POST['username']);
	$_SESSION["name"]=$name;
	$_SESSION['loggedIn']=True;
	$password=mysqli_real_escape_string($db, $_POST['password2']);
	$email=mysqli_real_escape_string($db, $_POST['email']);
	$phno=mysqli_real_escape_string($db, $_POST['phno']);
	$address=mysqli_real_escape_string($db, $_POST['address']);
	$registrationfees=500;
	$regperiod=30;
	
	
	$result= "INSERT INTO `customers`(`customername`, `subscriptionfees`, `customerphno`, `customeraddress`, `subscriptionperiod`, `customerpassword`) VALUES ('$name','$registrationfees','$phno','$address', '$regperiod', '$password')";
	$sql=mysqli_query($db, $result);
	header('Location: http://localhost/toystory/homepage');
	}
	else
	{
		$errpass="Re-type the passwords";
	}
	
}
}

else
{
	echo("cant connet to the database");
}
?>

<head>
  <title>TOYSTORY</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
      <link rel="stylesheet" href="css/style.css">
	  
</head>
<body>
<div class='log-form'>

<h2>REGISTER TO CREATE THE ACCOUNT</h2>
<form action="<?php $_SERVER[PHP_SELF];?>" method="post">
<input type="text" name="username" placeholder="USERNAME" autofocus>
<input type="email" name="mail" placeholder="E-mail">
<input type="number" name="phno" placeholder="phone-number">
<input type="text" name="address" placeholder="Pernamanent-Address">
<input type="password" name="password" placeholder="PASSWORD" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
<input type="password" name="password2" placeholder="RE-TYPE PASSWORD" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"><span class="error"> <?php echo $errpass ?> </span>
<input type="submit" name="REGISTER" value="REGISTER">
</form>

</div>


</body>
</html>