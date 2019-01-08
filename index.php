<?php
	require_once 'includes/db.php';
	require_once 'includes/sessions.php';
?>

<!DOCTYPE HTML>

<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title> Книжный магазин "(Не)много книг"</title>
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

						<?php
							if (mySession_start())
								echo '<a href="lk.php">Личный кабинет</a>';
							else
								echo '<a href="login.php">Войти</a>';
						?>
						
					</div>
				</div>
			</div>

			<!-- КОНТЕНТ -->
			<div class="content">
				<div class="wrapper">
					<table class="catalog-list">
						
						<?php 
							$result = $db->query("SELECT * FROM book");
							$title = '';
							$count = $result->rowCount();
							$price = '';
							$img = '';
							
							while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
								$title = $title.', '.$row['title'];
								$price = $price.' '.$row['price'];
								$ISBN = $ISBN.' '.$row['ISBN'];
							}

							echo '<script type="text/javascript"> 
								  	books_tbl("'.$ISBN.'", "'.$title.'", "'.$price.'"); 
								  </script>';  

							$result = null;
						?>

					</table>
				</div>
			</div>
			<div class="footer">
				<div class="wrapper">

					<ul class="head">
						<li><div class="copyright">
					 		<b>(Не)много книг <span>&copy; 2018</span></b>
							<span>Продаем книги. На любой (почти) вкус.</span>
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