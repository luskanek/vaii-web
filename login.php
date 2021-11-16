<?php
	include("php/config.php");

	if ($connection) 
	{
		session_start();

		if ($_SERVER["REQUEST_METHOD"] == "POST") 
		{
			$mail = mysqli_real_escape_string($connection, $_POST["login-input-mail"]);
			$pass = mysqli_real_escape_string($connection, $_POST["login-input-pass"]);

			$query = "SELECT * FROM users WHERE login = '$mail' AND password = '$pass'";
			$result = mysqli_query($connection, $query);

			if ($result)
			{
				if (mysqli_num_rows($result) == 1)
				{
					$_SESSION["active_user"] = $mail;
					
					echo "<script language='javascript'>alert('wohou');</script>";
				}
				else
					echo "<script language='javascript'>alert('chyba');</script>";
			}
		}
	}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Blog</title>

	<meta charset="UTF-8">
	<meta name="author" content="Lukáš Babečka">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
		integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<link rel="icon" href="resources/favicon.ico" type="image/ico">
</head>


<body onresize="showNavbar()">
	<script src="script.js"></script>

	<div id="header">
		<h1 id="web-title">blog</h1>

		<a href="javascript:void(0);" onclick="showHamburger()" id="hamburger-menu"><span
				class="fas fa-bars"></span></a>

		<div id="navbar">
			<ul>
				<li>
					<a href="index.php">
						<span class="fas fa-home"></span>
						Domov
					</a>
				</li>

				<li>
					<a href="about.php">
						<span class="fas fa-question"></span>
						O mne
					</a>
				</li>

				<li>
					<a href="login.php" id="current-page">
						<span class="fas fa-user"></span>
						Účet
					</a>
				</li>
			</ul>
		</div>
	</div>

	<div class="separator"></div>
	<div id="banner"></div>

	<div id="content">
		<div id="content-main">
			<div class="article">
				<h3 style="text-align: left; padding-left: 30px;">Prihlásenie</h3>
				<form method="post">
					<p>E-mail</p>
					<input name="login-input-mail" placeholder="Váš e-mail" type="email" required>
					<p>Heslo</p>
					<input name="login-input-pass" placeholder="Vaše prihlasovacie heslo" type="password" required>
					<input type="submit" value="Prihlásiť sa" name="submit-login">
				</form>
			</div>
		</div>

		<div id="content-side">
			<section>
				<h3 style="text-align: left;">Aké výhody prináša registrácia?</h3>
				<p>• získate prístup ku všetkým článkom, ktoré sa nachádzajú na stránke</p>
				<p>• odomknete možnosť vyjadriť svoj názor na článok zanechaním komentára</p>
				<p>• registrácia Vás nič nestojí a trvá to len pár minút, tak do toho!</p>
				<p><a href="#">Vytvoriť nový účet</a></p>
			</section>
		</div>
	</div>

	<div id="footer">
		<a href="http://www.facebook.com/"><span class="fab fa-facebook"></span></a>
		<a href="http://www.instagram.com/"><span class="fab fa-instagram"></span></a>
		<a href="http://www.youtube.com/"><span class="fab fa-youtube"></span></a>
	</div>
</body>

</html>