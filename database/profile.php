<?php
	require_once("includes/init.php");
	$session = Session::get_instance();
	$session->require_login();
	$user = $session->logged_in_user();
?>
<html>
	<body>
		<form method="post">
			<?php echo "Hi, ".$user->username;?><br/>
			<?php
				if(isset($_POST['url'])) {
					$user->url = $_POST['url'];
					$user->save();
					echo "<p>URL updated.</p><br/>";
				}
			?>
			<label>Encoded data </label><input type="text" name="url" placeholder="URL to encode" value="<?php echo $user->url;?>"/><br/>
			<input type="submit" value="Update"/><a href="logout.php">Logout</a>
		</form>
		<?php
			if($user->url!=""):?>
		<img src=" https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?php echo $user->url;?>"
		<?php endif;?>
	</body>
</html>
