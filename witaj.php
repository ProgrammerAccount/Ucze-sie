
<?php
session_start();
session_regenerate_id( );
/*if (isset($_SESSION['name'])==false)
{
	header("Location: index.php");
}*/
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<title>Dziekujemy za rejstracje</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="style.css"/>
	<style type="text/css">
a:link
{
	color: #333333;
}
a:visited
{
color: #333333;
}
	</style>


</head>
<body>
<?php
echo '<h1 style="text-align: center;">Witaj '.$_SESSION['name'].', dziekujemy za rejstracje. <br/> <a href="index.php">Zaloguj się</a></h1> ';
?>
<p style=" text-align:center; color:white; border-color: red;border-radius: 15px;  padding: 10px; margin: 6px; background-color: red;">Możesz sie zalogować i pamiętaj by zweryfikowac e-mail inaczej twoje konto zostanie usunietę w ciągu 24 godzin </p>
</body>
</html>
<?php session_regenerate_id( );  ?>