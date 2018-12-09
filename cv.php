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
	<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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
						<li class="nav"><a href ="tutorial.php">Tutorial</a></li>
						<li class="nav"><a href ="index.php">Main</a></li>
						<li class="nav"><a class="active" href ="cv.php">CV</a></li>
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

	<div id="cvBox" class="container">

		<div class="dcvBox">
			<img src="Images/image2.jpg" class="cvPic" alt="Jace Black photo">
			<h2>Jace Black</h2>
			<h5>SCRUM Master</h5>
			<h5>HTML/CSS/JS/PHP/SQL</h5>
			<div class="github-icon" >
				<a href="https://github.com/JaceBlack" target="_blank"><i class="fa fa-github" aria-hidden="true"  alt="GitHubs main icon"></i></a>
			</div>
		</div>
		
		<div class="dcvBox">
			<img src="Images/image1.jpg" class="cvPic" alt="Beau Duinkerken photo">
			<h2>Beau Duinkerken</h2>
			<h5>Head Developer</h5>
			<h5>HTML/CSS/JS/PHP/SQL</h5>
			<div class="github-icon">
				<a href="https://github.com/bduinkerk" target="_blank"><i class="fa fa-github" aria-hidden="true"  alt="GitHubs main icon"></i></a>
			</div>
		</div>
		
		<div class="dcvBox">
			<img src="Images/image0.jpg" class="cvPic" alt="Joshua Holland">
			<h2>Joshua Holland</h2>
			<h5>Senior Developer</h5>
			<h5>HTML/CSS/JS/PHP/SQL</h5>
			<div class="github-icon">
				<a href="https://github.com/ggkfox" target="_blank"><i class="fa fa-github" aria-hidden="true"  alt="GitHubs main icon"></i></a>
			</div>
		</div>

	</div>

	<div class="footer">
		<div class="container">
			<p>Jace Black - Beau Duinkerken - Joshua Holland</p>
		</div>
	</div>
	

</body>
</html>