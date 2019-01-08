<?php
	require_once 'includes/sessions.php';

	if (!mySession_start())
	{
		header("location: login.php");
	}

?>

<!DOCTYPE HTML>

<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Книжный магазин "(Не)много книг"</title>
		<link rel="shortcut icon" href="img/favicon.ico">
		<link rel="stylesheet" href="css/style.css" >
		<script src="js/item.js" language="javascript"></script>
	</head>

	<body>
		
		<div class="cn">

			<!-- Навигация -->
			<div class="navigation">
				<div class="wrapper">
					<div class="menu">
						<a href="index.php">Главная</a>
						<a href="cart.php">Корзина</a>
						<a href="logout.php">Выйти</a>
					</div>
				</div>
			</div>

			<!-- КОНТЕНТ -->
			<div class="content">
				<div class="wrapper">

					<b>Добро пожаловать!</b>

					<?php 

						$sql = 'SELECT * FROM user 
								INNER JOIN account ON account.user_id = user.id 
								INNER JOIN session ON session.account_email = account.email 
								
								WHERE session.id = :sess_id';
						$stmt = $db->prepare($sql);
 						$stmt->execute([':sess_id' => $_COOKIE['SESSID']]);
 						$user = $stmt->fetch(PDO::FETCH_OBJ);
					?>

					
				</div>
			</div>

			<!-- ПОДВАЛ -->
			<div class="footer" style="position: absolute; display: table; height: 100%;">
				<div class="wrapper">

					<ul class="head">
						<li><div class="copyright">
					 		<b>(Не)много книг  <span>&copy; 2018</span></b>
							<span>Продаем книги. На любой (почти) вкус..</span>
						</div></li>
						<li><div class="phone">
							<b>8 841 88-20-07</b>
							<span>Звонок бесплатный</span>
						</div></li>
					</ul>


				</div>
			</div>
		</div>

	</body>
</html>