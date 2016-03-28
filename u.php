<?php
session_start();
if(isset($_SESSION['id_user'])==false)
header("Location:index.php");
?>
<!DOCTYPE html>

<html lan="pl">
<head>
<style>
	.button
	{
	padding: 30px;
	width: 45px;
		background-color: #0141B3; 
		color: white;
     text-align: center;
		display: inline-block;
		border-radius: 15px;
		border: solid 5px black ;

	}
	.text
	{
		width: 500px;
		text-align: center;
	}

</style>
	<title>Udostępnianie zdjecia</title>
	<link rel="stylesheet" href="style.css" type="text/css" />
		<link rel="stylesheet" href="css/fontello.css" type="text/css" />
</head>
<body>
<h1 style="text-align: center;">Czy chcesz udostępnić to zdjecie</h1>
<div style="text-align: center;"><i class="demo-icon icon-down-big"></i></div>
<?php 



require('connect.php');
$sql= new mysqli ($host,$user,$pass,$base);
$rezultat=$sql->query("SELECT * FROM file WHERE id='{$_POST['plik']}'");
$_SESSION['plik']=$_POST['plik'];
$odp = $rezultat->fetch_assoc();
$name =$odp['file_name'];
echo '<div style="margin: auto; width: 600px; height: 400px;"><img src="Upload/'.$_SESSION['id_user']."/".$name.'"  width="600px"
height= "400px"></div>';
echo '<div style="text-align:center ; margin:auto;"><input class="text" type="text" value="localhost/HostBook/img.php?id='.$_SESSION['id_user'].'&img='.$name.'"'.'>';
?>

<div style=" text-align: center; ">
<a href="udostepnij.php"><div class="button">TAK</div></a>
<a href="Nu.php"><div class="button">NIE</div></a>
</div>
</body>
</html>
