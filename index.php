<?php
// Initialize the session
session_start();
// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login_mysql.php");
  exit;
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
<body id="body">

	<div class="navbar">
		<div class="container">
			<table>
				<tr>
				<td id="tLinks">
					<ul id="links">
						<li class="nav"><a href ="title.php">Title</a></li>
						<li class="nav"><a href ="tutorial.php">Tutorial</a></li>
						<li class="nav"><a class="active" href ="index.php">Main</a></li>
						<li class="nav"><a href ="cv.php">CV</a></li>
					</ul>
				</td>
				<td id="tLogin">
					<ul id="login">
						<li class="nav" class="login"><input type="text" name="username" placeholder="Username"></li>
						<li class="nav" class="login"><input type="password" name="password" placeholder="Password"></li>
						<li class="nav" class="login"><button id="loginB">Login</button></li>
					</ul>
				</td>
			</tr>
		</div>
	</div>
	
	<div class="content">
		<div class="container">
			<table>
			<tr>
				<td class="controls">
					<div id="win">
						<h1>You Win!!!</h1>
					</div>
					<div>
						<h3 id="h3GridSize">Grid Size: 7</h3>
							<div>
								<p><input type="range" min="3" max="20" value="7" class="slider" id="gridSize"></p>
							</div>
						<h3 id="h3BackgroundColorT">Background Color:</h3>
						<h3 id="h3BackgroundColor">Snow</h3>
							<div>
								<p><input type="range" min="0" max="9" value="5" class="slider" id="gridColor"></p>
							</div>
						<h3 id="h3BlockColorT">Block Color:</h3>
						<h3 id="h3BlockColor">Teal</h3>
							<div>
								<p><input type="range" min="0" max="9" value="5" class="slider" id="blockColor"></p>
							</div>
							<p><button id="newGame">New Game</button></p>
						<h3 id="mode">Mode:</h3>
							<h3 class="class" id="mode"></h3>
						<div>
						<select id="gameMode">
							<option value = "arcade">Arcade</option>
							<option value = "time">Time Attack</option>
							<option value = "random"> Random</option>
						</select>
						</div>
					</div>
				</td>
				<td class="ccontainer">
					<div>
						<canvas id="layer1"></canvas>
						<canvas id="layer2"></canvas>
						<canvas id="ballLayer"></canvas>
					</div>
				</td>
				<td class="statistics">
					<div>
						<h3 id="timer"> Time: 0 00</h3>
						<h3 id="mistakes">Mistakes: 0</h3>
						<h3 id="leaderboard">Leaderboard</h3>
						<h3 id="scores"></h3>
						<select id="scoreOrder">
							<option value ="scoreAsc">By Score Ascending</option>
							<option value ="scoreDesc">By Score Descending</option>
							<option value ="durationAsc">By Duration Ascending</option>
							<option value ="durationDesc">By Duration Descending</option>
						</select>
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
	<h1 id="demo"></h1>
	
	
    <script src="js/circle.js"></script>
    <script src="js/util.js"></script>
    <script src="js/square.js"></script>
    <script src="js/main.js"></script>
	
</body>
</html>