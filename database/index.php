<?php
	require_once("includes/init.php");
	$session = Session::get_instance();
?>
<html>
	<body>
	<form method="post">
		<?php
			if(isset($_POST['login_username']) && isset($_POST['login_password']))
			{
				$user = Admin::find_by_username($_POST['login_username']);
				if(isset($user))
				{
					$user->password = $_POST['login_password'];
					if($user->authenticate())
					{
						$session->login($user);
						header("location:profile.php");
					}
					else
						echo "Invalid password";
				}
				else
					echo "User unregistered";
			}
		?>
		<input id="username" type="text" placeholder="Username" name="login_username" pattern="[A-Za-z0-9_]+" required autofocus="autofocus"/><br/>
		<input name="login_password" type="password" placeholder="Password" required/><br/>
		<input type="submit" value="Login"/>
	</form>
		<?php
	if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repPass']))
	{
		$user = Admin::find_by_username($_POST['username']);
		if(!isset($user))
		{
				if($_POST['password'] == $_POST['repPass'])
				{
					$user = new Admin();
					$user->get_values();
					$user->save();
					echo "Registered successfully. You may now login.";
				}
				else
					echo "Passwords mismatch.";
		}
		else
			echo "User already registered";
	}
?>
		  <form method="post">
			<input type="text" placeholder="New username" name="username" pattern="[A-Za-z0-9_]+" required><br/>
			<input type="password" placeholder="New password" name="password" pattern="[A-Za-z0-9]+" required><br/>
			<input type="password" placeholder="Repeat password" name="repPass" pattern="[A-Za-z0-9]+" required>
			<br/>
			<input type="submit" value="Register">
		  </form>

	</body>
</html>
