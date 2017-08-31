<?php 
	session_start();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Content</title>
</head>

<body>

dette kan alle se
<hr>

<?php 
	if(empty($_SESSION['uid'])) {
		echo 'not logged in!';
	}
	else {
		echo 'welcome to the content. '.$_SESSION['username']. '<br>';
		echo 'here be stuff for logged in users only';
	}
	?>

<a href="logout.php">log ud</a>
</body>
</html>