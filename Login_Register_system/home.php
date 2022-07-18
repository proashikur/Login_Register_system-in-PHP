<?php 
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['mysession']))
{
	header("Location: index.php");
}

$query=$DBcon->query("SELECT * FROM tbl_users WHERE id=".$_SESSION['mysession']);
$userRow=$query->fetch_array();
$DBcon->close();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home page</title>
</head>
<body>

	<div>
		<a href="#">W3Schools.com</a>
	</div>

	<div>
		<ul>
			<li>
				<a href="#">jQuery</a>
			</li>
			<li>
				<a href="#">PHP</a>
			</li>
			<li>
				<a href="#">Laravel</a>
			</li>
		</ul>
	</div>

	<div align="right">
		<ul>
			<li><?php echo "<b>Welcome</b>"."&nbsp;".$userRow['username']; ?></li>
			<li><a href="logout.php?logout">Log Out</a></li>
		</ul>
	</div>

</body>
</html>