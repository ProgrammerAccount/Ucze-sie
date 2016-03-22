
<?php
session_start();
session_regenerate_id( );
if (isset($_SESSION['name'])==false)
{
	header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<title>Dziekujemy za rejstracje</title>
	<meta charset="utf-8"/>
	<>
</head>
<body>
<?php
echo "<h1>Witaj ".$_SESSION['name'].', dziekujemy za rejstracje.  <a href="index.php">Zaloguj się</a></h1> ';
?>

</body>
</html>
<?php session_regenerate_id( );  ?>