<?php session_start();  ?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>

<?php
if(filter_input(INPUT_POST, 'submit')){
	$un = filter_input(INPUT_POST, 'un') 
		or die('Missing/illegal un parameter');
	$pw = filter_input(INPUT_POST, 'pw')
		or die('Missing/illegal pw parameter');
	require_once('db_login.php');
	$sql = 'SELECT id, pwhash FROM users WHERE username=?';
	$stmt = $con->prepare($sql);
	$stmt->bind_param('s', $un);
	$stmt->execute();
	$stmt->bind_result($uid, $pwhash);
	
	while($stmt->fetch()) { }
	
	if (password_verify($pw, $pwhash)){
		echo 'Logged in as '.$un;
		$_SESSION['uid'] = $uid;
		$_SESSION['username'] = $un;
		header("Location: content.php");
		die();
	}
	else{
		echo 'Illegal username/password combination';
	}
	echo '<hr>';
}
	
?>


<p>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend>Login</legend>
    	<input name="un" type="text"     placeholder="Brugernavn" required />
    	<input name="pw" type="password" placeholder="Password"   required />
    	<input name="submit" type="submit" value="Login" />
	</fieldset>
</form>
</p>
<a href="createuser.php">create user</a>
</body>
</html>