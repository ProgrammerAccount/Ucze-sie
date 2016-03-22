<?php
////Sprawdzam czy jest lalogowany
session_start();
session_regenerate_id( );

if(isset($_SESSION['login'])==false)
{
header("Location:index.php");

}
elseif(isset($_GET['user']))
?>
<!DOCTYPE html>
<html>
<head>
<link type="text/css" href="style.css" rel="stylesheet">
	<title>HostBook</title>
	<meta charset="utf-8"/>
		<link href='https://fonts.googleapis.com/css?family=Lato:400,700italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>

<style type="text/css">
	.image
	{
		background-image: none;
		width: 400px;
		margin-bottom: 50px; 
		height:200px;
	}
</style>
	
</head>
<body>
<div style="text-align: center;"><h1>Witaj Na Strone HostBook udostępnij swoje pliki i pokaż je znajomym</h1></div>
<div style="text-align: center; font-family: 'Lobster', cursive; font-size: 30px;" >"Don't say just show"</div> 

<div id="linki">
<a href="logout.php"><div class="linki" style="word-spacing: 2px; border-left: dotted #000088 2px;">Wyloguj  się</div> </a>
<a href="manager.php"><div class="linki" style="word-spacing: 2px;"> Manager Files</div></a>
<a href="przegladarka.php"><div class="linki">Przegladarka </div></a>
<a href="uploader.php"><div class="linki">uploader</div></a>
<a href="HostBook.php"><div class="linki"> Home</div></a>
<div style="clear: both;"></div>
	</div>
	<br/><br/>
	<div id="menu">

	</div>
<?php
require("connect.php");

$connect= new mysqli($host,$user,$pass,$base);

////Sprawdzam czy nie ma błedu z bazą sql
if($connect->connect_error)
{
	echo "Error".$connect->connect_errno();
}	
else
{
	//loncze sie z baza
$odp=$connect->query("SELECT * FROM file WHERE id_user='{$_SESSION['id_user']}'");
$ile=$odp->num_rows;
$ile2=$ile;
$id= $_SESSION['id_user'];

if($ile>0)
{
	$name="";
	// wyswietlam wszystkie img
	while($ile--)
	{
		$odp2=$odp->fetch_assoc();
		$nazwa=$odp2['file_name'];
		$info=pathinfo($nazwa);
		@$inf=$info['extension'];

		
		if($inf=="png"||$inf=="jpg"||$inf=="jpeg")
		{
			echo '<div  class="image">';
			// wysyłanie nazwy pliku do delete .php tam bedzie usuniety
echo '<img src="Upload/'.$id."/".$nazwa.'" height="200px" width="400px"></img>';
echo '<div style="margin-bottom: 7px;"> </div>';
echo 'Nazwa Pliku : '.$nazwa ;
echo '<form method="POST" action="delete.php" onsubmit="return confirm'."('Czy jestes pewien że chcesz usunąć zdjecie?')".'">';

echo '<input type="hidden" name="plik" value="'.$nazwa.'" >';
echo '<input type="hidden" name="id" value="'.$odp2['id'].'" >';
echo '<input type="submit" value="Usuń">';
echo '</form>';
echo "</div>";

$name=$name."<br/>".$nazwa;
	
		}

	


}
	$odp->free();
	$connect->close();
	echo '<div id="menu">';
echo $name;
echo '</div>';
}}



?>
<script src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var nav= $('#linki').offset().top;
	var stickyN = function()
	{
var scroll=$(window).scrollTop();
if(scroll>nav)
{
$('#linki').addClass('sticky');

}
else 
{
	$('#linki').removeClass('sticky');
}
};
stickyN();
$(window).scroll(function()
{
	stickyN();
});
});



</script>
</body>
</html>
<?php session_regenerate_id( );  ?>