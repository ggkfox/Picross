<?php
session_start();

if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
	header("Location: ../title.php");
  exit();
}
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
						<li class="nav"><a href ="title.php">Title</a></li>
						<li class="nav"><a class="active" href ="tutorial.php">Tutorial</a></li>
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
			<table id="tvideo">
			<tr>
			<td class="tdvideo">
				<div>
				<video id="video1" controls>
   					<source src="video/play_picross.mp4" type="video/mp4">

 				</video>
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