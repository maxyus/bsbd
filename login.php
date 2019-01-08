<?php
	require_once 'includes/sessions.php';
	if (mySession_start())
	{
		header("location: lk.php");
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
					</div>
				</div>
			</div>

			<!-- КОНТЕНТ -->
			<div class="content">
				<div class="wrapper">
					
					<div class="auth">
						<form action="" method="post">
 							Логин: <input type="text" name="login" />
 							Пароль: <input type="password" name="password" />
 							<input type="submit" value="Войти" name="log_in" />
						</form>
					</div>

					<?php
						if (isset($_POST['log_in'])) 
						{
							$login = htmlspecialchars( trim($_POST['login']) ); 
							$password = htmlspecialchars( trim($_POST['password']) );
					
							if (!empty($login) && !empty($password))
 							{
 								$sql = 'SELECT email, password FROM account WHERE email = :login';
 								$params = [':login' => $login];
 								$stmt = $db->prepare($sql);
 								$stmt->execute($params);

 								$user = $stmt->fetch(PDO::FETCH_OBJ);

 								if ($user) 
 								{
 									if ($user->password == $password)
 									{
 										mySession_write($user->email);
 										header('Location: lk.php');
 									}
 									else
 										echo "Неверный логин или пароль!"; 
 								}
 								else
 									echo "Пользователь не найден!";
 							}
 							else
 								echo "Неверно задан логин или пароль!"; 
						}
					?>

				</div>
			</div>

			<!-- ПОДВАЛ -->
			<div class="footer" style="position: absolute; display: table; height: 100%;">
				<div class="wrapper">

					<ul class="head">
						<li><div class="copyright">
					 		<b>(Не)много книг <span>&copy; 2018</span></b>
							<span>Продаем книги. На любой (почти) вкус..</span>
						</div></li>
						<li><div class="phone">
							<b>8 841 88-20-07</b>
							<span>Звонок бесплатный</span>
						</div></li>
					</ul>

					<div class="bottom">
						<ul>
							<li><a href="index.php">На главную</a><span></span></li>
						</ul>
					</div>

				</div>
			</div>

		</div>

	</body>
</html>