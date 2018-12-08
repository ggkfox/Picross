<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styles.css">
    <title>Picross</title>
</head>
<body id="body" background="Images/background.jpg">

	<div class="navbar">
		<div class="container">
			<table>
				<tr>
				<td id="tLinks">
					<ul id="links">
						<li class="nav"><a class="active" href ="title.php">Title</a></li>
						<li class="nav"><a href ="tutorial.php">Tutorial</a></li>
						<li class="nav"><a href ="index.php">Main</a></li>
						<li class="nav"><a href ="cv.php">CV</a></li>
					</ul>
				</td>
				<?php if(!isset($_SESSION['username']) || empty($_SESSION['username'])){ ?>
					<td id="tLogin">
						<form action="php/login.php" method="post" enctype="multipart/form-data">
							<ul id="login">
								<li class="nav" class="login"><input type="text" name="username" placeholder="Username"></li>
								<li class="nav" class="login"><input type="password" name="password" placeholder="Password"></li>
								<li class="nav" class="login"><input type="submit" name="login-submit" id="login-submit" value="Login"></li>
							</ul>
						</form>
					</td>
				<?php } else {?>
					<td id="tLogout">
						<form action="php/logout.php" method="post" enctype="multipart/form-data">
							<ul id="logout">
								<li class="logout" id="viewUser"><?php echo "Welcome, " . $_SESSION['username']; ?></li>
								<li class="logout"><input type="submit" name="logout-submit" id="logout-submit" value="Logout"></li>
								<li class="logout" id="viewAvatar"><img id="avatarImg" src="<?php echo $_SESSION['avatar'];?>"/></li>
							</ul>
						</form>
					</td>
				<?php }?>
			</tr>
		</div>
	</div>
	<div class="body">
		<div class="container">
			<table id="tregister">
			<tr>
			<td class="registerForm">
				<div>
					<form action="php/register.php" method="post" enctype="multipart/form-data">
						<ul class="form">
							<li class="form"><span id="picross-title">Picross</span></li>
							<li class="form"><span id="errorMsg"><?php if(isset($_GET['error'])) echo $_GET['error']; if(isset($_GET['signup'])) echo $_GET['signup']; ?></span></li>
							<li class="form"><label for="firstname"></label><input type="text" name="fname" id="fname" class="reg-input" placeholder="First Name"></li>
							<li class="form"><label for="lastname"></label><input type="text" name="lname" id="lname" class="reg-input" placeholder="Last Name"></li>
							<li class="form"><label for="age"></label><input type="text" name="age" id="age" class="reg-input" placeholder="Age"></li>
							<li class="form"><label for="gender"></label>
							<select class="form" name="gender" id="gender">
								<option value="" disabled selected hidden>Gender</option>
								<option value="m">Male</option>
								<option value="f">Female</option>
								<option value="o">Other</option>
							</select>
							</li>
							<li class="form"><label for="location"></label><input type="text" name="location" id="location" class="reg-input" placeholder="City"></li>
							<li class="form"><label for="username"></label><input type="text" name="username" id="username" class="reg-input" placeholder="Username"></li>
							<li class="form"><label for="password"></label><input type="password" name="password" id="password" class="reg-input" placeholder="Password"></li>
							<li class="form"><label for="password-verify"></label><input type="password" name="password-verify" id="password-verify" class="reg-input" placeholder="Verify Password"></li>
							<li class="form"><button type ="button" onclick="document.getElementById('avatar').click()" id="button" class="reg-input" >Upload Avatar</button></li>
							<li class="form"><input type="submit" name="register-submit" id="register-submit" value="Register"></li>
							<li class="form"><label for="avatar"></label><input type="file" name="avatar" id="avatar"></li>
						</ul>
					</form>
				</div>
			</td>
			</tr>
			</table>
		</div>
	</div>
	<div class="footer">
		<div class="container">
			<p>Jace Black - Beau Duinkerken - Joshua Holland</p>
		</div>
	</div>
	
</body>
</html>