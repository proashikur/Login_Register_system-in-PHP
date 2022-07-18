<?php 
session_start();
if(isset($_SESSION['mysession'])!="")
{
	header('location: home.php');
}

require_once 'dbconnect.php';

if(isset($_POST['btn-signup']))
{
	$uname=strip_tags($_POST['username']);
	$email=strip_tags($_POST['email']);
	$upass=strip_tags($_POST['password']);

	$uname=$DBcon->real_escape_string($uname);
	$email=$DBcon->real_escape_string($email);
	$upass=$DBcon->real_escape_string($upass);

	$hashed_password=password_hash($upass, PASSWORD_DEFAULT);

	$check_email=$DBcon->query("SELECT email FROM tbl_users WHERE email='$email'");
	$count=$check_email->num_rows;

	if($count==0)
	{
		$query="INSERT INTO tbl_users(username,email,password) VALUES ('$uname','$email','$hashed_password')";

		if($DBcon->query($query))
		{
			$msg="<div>
						Successfully Registered!
						</div>";
		}

		else
		{
			$msg="<div>
						Error while registering!
						</div>";
		}
	}
	else
	{
		$msg="<div>
						Sorry, this email already taken!
						</div>";
	}

	$DBcon->close();

}
?>




<!DOCTYPE html>
<html>
<head>
	<title>Sign Up Page</title>
</head>
<body>

	<div>
		<div>
			<form method="POST">
				<h2>Sign Up Here...</h2>

				<?php 

					if(isset($msg))
					{
						echo $msg;
					}
				?>
				<div>
					<input type="text" placeholder="User Name" name="username" required>
				</div>
				<div>
					<input type="email" placeholder="User Email" name="email" required>
				</div>
				<div>
					<input type="password" placeholder="User Password" name="password" required>
				</div>

				<hr>
				<div>
					<button type="submit" name="btn-signup">Create Account</button>
					<a href="index.php">Log In Here</a>
				</div>
			</form>
		</div>
	</div>

</body>
</html>