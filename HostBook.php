<?php
// Sesja Start
session_start();
session_regenerate_id( );
if(isset($_SESSION['login'])==false)
{
header("Location:index.php");

}
?>
<!DOCTYPE html>
<html>
<head>
<link href='https://fonts.googleapis.com/css?family=Lato:400,700italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<link href="css/fontello.css" rel="stylesheet" type="text/css">


<style>
#image
{
	float: left;
border: dashed 10px blue;
margin-left: auto;
margin-right: auto;

text-align: center;
height: 400px;
width:600px;

}

.image_class:hover
{
	opacity:initial;
}
@media(min-width: 300px)and (max-width: 400px)
{
	#image
	{
		width:280px;
		height:200px;
		border-width:8px;
	}
}
@media(min-width: 400px)and (max-width: 550px)
{
	#image
	{
		width:350px;
		height:250px;
		border-width:8px;
	}
	.image_class
{
	height: 250px;
	width: 350px;
	margin-left:auto;
	margin-right:auto;
}
}
@media(min-width: 550px)and (max-width: 1000px)
{
	.image_class
{
	height: 350px;
	width: 450px;

}
	#image
	{
		width:603px;
		height:403px;
		border-width:8px;
	}
}
</style>
<script>
function menu()
{
	if(document.getElementById("menuList").style.display=="none")

	document.getElementById("menuList").style.display="block";
	else
			document.getElementById("menuList").style.display="none";
}
</script>
	<title>HostBook</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" href="style.css">
	<link href='https://fonts.googleapis.com/css?family=Ubuntu+Condensed&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>
<body>

<div style="text-align: center;"><h1>Witaj Na Strone HostBook udostępnij swoje pliki i pokaż je znajomym</h1></div>
<div style="text-align: center; font-family: 'Lobster', cursive; font-size: 30px;" >"Don't say just show"</div>
<div id="links" onclick="menu()"> Rozwiń menu <i class="demo-icon icon-down-open"></i> </div>
</br></br>
<ul id="menuList">
		<li><a href="logout.php"> Wyloguj się </a></li>
		<li><a href="manager.php"> Menager</a></li>
		<li><a href="przegladarka.php">Przeglonadrka </a></li>
		<li><a href="uploader.php"> Uploader</a></li>
		<li style="border-bottom:  solid #5ff65c 2px;"><a href="HostBook.php">Home</a></li>
</ul>
<div id="linki">
<a href="logout.php"><div class="linki" style="word-spacing: 2px; border-left: dotted #000088 2px;">Wyloguj  się</div> </a>
<a href="manager.php"><div class="linki" style="word-spacing: 2px;"> Manager Files</div></a>
<a href="przegladarka.php"><div class="linki">Przegladarka </div></a>
<a href="uploader.php"><div class="linki">uploader</div></a>
<a href="HostBook.php"><div class="linki"> Home</div></a>
<div style="clear: both;"></div>
	</div>
  <div id="decoration">		<div  id="image"></div>		</div>

	<?php
	//łączenie
	require('connect.php');
	$sql= new mysqli($host,$user,$pass,$base);
	$rezultat = $sql->query("SELECT * FROM file WHERE id_user='{$_SESSION['id_user']}'");
	//podawanie nazyw i liczby zdjec do wyswietlenia
	$ile=$rezultat->num_rows;



	echo '<input type="hidden" id="HMI" value="'.$ile.'" >';
	echo '<input type="hidden" id="ID" value="'.$_SESSION['id_user'].'" >';
	for($i=0;$i<$ile;$i++)
	{
		//Pobieranie rekordów
		$anwers=$rezultat->fetch_assoc();
		$tab[$i]=$anwers['file_name'];
		echo '<input type="hidden" id="'.$i.'" value="'.$tab[$i].'" >';
	}

	?>
	<script src="jquery.js"></script>

	<script type="text/javascript">
	//Sleider
		 var HMI = document.getElementById('HMI').value;
		 var ID = document.getElementById('ID').value;
		 if(HMI<1)
		 {
		 document.getElementById('image').innerHTML='<img class="image_class" src="img/ImageStart.jpg" >'
		 }
		 else if(HMI<2)
		 {
		 	//Wyswietlanie gdy jest 1 zdjecie
		 	var Img1 = document.getElementById('0').value;
		 	document.getElementById('image').innerHTML='<img class="image_class" src="Upload/'+ID+'/'+Img1+'" >'

		 }

		 else
		 {
		 	//Wyswietlanie gdy są wiecej niż 1 zdjecie
		 var rand=Math.floor((Math.random())* HMI);

		 function schowaj()
		 {
		 $('#image').fadeOut(500);

		 }
		 function slider()
		 {

		var Img1 = document.getElementById(rand).value;

		document.getElementById('image').innerHTML='<img class="image_class" src="Upload/'+ID+'/'+Img1+'"">'
		$('#image').fadeIn(500);



		 rand++;
		 if(rand>=HMI)
		 	{
rand=0;
		 	}
setTimeout("slider()", 5000);
setTimeout("schowaj()", 4500);
		 }
	}
	</script>
	  <body onload="slider()">

</body>
</html>
