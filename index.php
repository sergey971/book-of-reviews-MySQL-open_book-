<?php 
error_reporting(E_ALL);
require_once "connect.php";



?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">  
		<title>Гостевая книга</title>
		<link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="css/styles.css">
	</head>
	<body>
		<div id="wrapper">
			<h1>Гостевая книга</h1>
			<div class="note">

				<?php

	if (!empty($_POST)) { 

		if (!empty($_POST['name'] AND ['commet'])) echo '<p class="info alert alert-info"">Запись успешно сохранена</p>';

		if (empty($_POST['name'])) echo '<p style="color: red; font-weight: bold;">Введите имя</p>';

		if (empty($_POST['commet'])) echo '<p style="color: red; font-weight: bold;">Введите текс сообщения </p>';

	 else {

		$name = $_GEt['name'];
		$date = date('Y.m.d H:i:s');
		$commet = $_GET['commet'];
		
		$query = "INSERT INTO workers SET name='$name', date='$date', commet='$commet'";
		mysqli_query($link, $query) or die(mysqli_error($link));
		
	
	} 
}

?>
			
			<div id="form">
				<form action="" method="POST">
					<p><input class="form-control" name="name" placeholder="Ваше имя" value="<?php if (isset($_POST['name'])) echo $_POST['name'];?>"></p>
					<p><textarea class="form-control" name="commet" placeholder="Ваш отзыв" value="<?php if (isset($_POST['commet'])) echo $_POST['commet'];?>"></textarea></p>
					<p><input type="submit" name="btn" class="btn btn-info btn-block" value="Сохранить"></p>
				</form>
			</div>
				<div>
				
		<?php
				$query = "SELECT * FROM workers ORDER BY id DESC";
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				for ($data = []; $row = mysqli_fetch_assoc($result); $data[] = $row);

				$result = '';
					foreach ($data as $elem) {
						$result .= '<tr><hr>';

							$result .= '<br>' . $elem['date'] . '</br>';
							$result .= '<br>' . $elem['name'] . '</br>';
							$result .= '<br>' . $elem['commet'] . '</br>';

						$result .= '</tr>';
			}
				echo $result;
		?>
		<?php
		$query = "SELECT COUNT(*) as count FROM `workers`";
				$result = mysqli_query($link, $query) or die(mysqli_error($link));
				$count = mysqli_fetch_assoc($result)['count'];
				$pagesCount = ceil($count / $notesOnPage);
				if ($page != 1){
					$prev = $page - 1;
					echo "<a href=\"?page=$prev\"><<</a> ";
				}
				
				for ($i = 1; $i <= $pagesCount; $i++){
					if ($page == $i){
						$class = ' class="active"';
					}else {
						$class = '';
				}
				echo "<a href=\"?page=$i\"$class>$i</a> ";
			}
			
		?>
				</div>
	</body>
</html>



