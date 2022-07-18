<?php 
session_start();
require_once 'dbconnect.php';

if(isset($_SESSION['mysession'])!="")
{
	header('location: home.php');
	exit;
}

if(isset($_POST['btn-login']))
{
	$email=strip_tags($_POST['email']);
	$password=strip_tags($_POST['password']);

	$email=$DBcon->real_escape_string($email);
	$password=$DBcon->real_escape_string($password);

	$query = $DBcon->query("SELECT id, email, password FROM tbl_users WHERE email='$email'");
	$row = $query->fetch_array();
	$count = $query->num_rows;

	if(password_verify($password, $row['password']) && $count==1)
	{
		$_SESSION['mysession']=$row['id'];
		header("Location: home.php");
	}

	else
	{
		$msg="<div>

					Invalid Username or Password!
			</div>";
	}

	$DBcon->close();

}


?>




<!DOCTYPE html>
<html>
<head>
	<title>Login Here</title>
</head>
<body>

	<div>
		<div>
			
			<form method="POST">
				<h2>Sign In</h2>

				<?php 

				if(isset($msg))
				{
					echo $msg;
				}
				?>

				<div>
					<input type="email" name="email" placeholder="Email Address" required>
				</div>
				<div>
					<input type="password" name="password" placeholder="Password" required>
				</div>
				<hr>
				<div>
					<button type="submit" name="btn-login">Login</button>
					<a href="register.php">Sign Up Here</a>
				</div>
				
			</form>
		</div>
</div>

</body>
</html>