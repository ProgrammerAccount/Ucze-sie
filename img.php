<!DOCTYPE html>
<html>
<head>
	<title>Zdjecie HostBook</title>
	
	<style type="text/css">
	body
	{
	background-color: blue;	
	}
	</style>
			<link href='https://fonts.googleapis.com/css?family=Lato:400,700italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div style="text-align: center;"><h1>Witaj Na Strone HostBook udostępnij swoje pliki i pokaż je znajomym</h1></div>
<div style="text-align: center; font-family: 'Lobster', cursive; font-size: 30px;" >"Don't say just show"</div> 
 <h3 style="text-align: center;">www.HostBook.com</h3>
<?php
session_start();
//sprawdzam czy zmienne są sutawione
if((isset($_GET['img']))&&(isset($_GET['id'])))
{
	//łączenie sie z bazą
	require('connect.php');
	$connect= new mysqli($host,$user,$pass,$base);
	$return=$connect->query("SELECT * FROM file WHERE  id_user='{$_GET['id']}' AND file_name='{$_GET['img']}'");

	//sprawdzanei czy zdjecie jest publiczne
$anwers=$return->fetch_assoc();
$share=$anwers['publiczne'];
if($share==1)
{
//jesli tak to wyswietlamy

echo '<div class="image" ><img src="Upload/'.$_GET['id']."/".$_GET['img'].'"  class="image_class"></div>';
}
else
echo "<h1>Przykro nam ale takiego zdjecia nie ma lub autor nie udostępnił go!</h1>";
//Jesli nie bedzie napis
}
?>
</body>
</html>
