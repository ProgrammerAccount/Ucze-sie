<?php
	//Sprawdzam czy typ jest zalogowany
	session_start();
	session_regenerate_id( );
	if(isset($_GET['user']))
	{
require('connect.php');
$polonczenie= new mysqli($host,$user,$pass,$base);
if($polonczenie->connect_error== true)
{
echo "Error".$polonczenie->connect_errno;
}
else
{
	$odp=$polonczenie->query("SELECT * FROM user WHERE user='{$_GET['user']}'");
	@$how_mutch=$odp->num_rows;

    if($how_mutch>0)
    {
    	$odp2=$odp->fetch_assoc();
    	$_SESSION['id_user']=$odp2['id'];


    }
    else
    	$_SESSION['bad']="Nie ma usera o takiej nazwie";

}
	}
	elseif(isset($_SESSION['login'])==false)
	{
	header("Location:index.php");
	}

?>
<!DOCTYPE html>
<html>
<head>

	<title>HostBook</title>
	<meta charset="utf-8"/>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href='https://fonts.googleapis.com/css?family=Lato:400,700italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
	<style type="text/css"> 

.image_class:hover
{

	opacity: 0.4;
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
	<div style="text-align: center;">kliknij na zdjęcie by udostępnić</div>
	<br/><br/>
	<script src="jquery.js"></script>

<?php
		//loncze sie z baza

if(isset($_SESSION['bad']))
{
	echo $_SESSION['bad'];
	session_unset($_SESSION['bad']);
	exit;
}
		require_once("connect.php");
		$connect= new mysqli($host,$user,$pass,$base);
		if(isset($_GET['user'])==false)
		$rezultat=$connect->query("SELECT * FROM file WHERE id_user={$_SESSION['id_user']}");
	else
		$rezultat=$connect->query("SELECT * FROM file WHERE id_user={$_SESSION['id_user']} AND publiczne='1' ");
		@$ile=$rezultat->num_rows;

		//wyswiatlam wszystkie zdjecia

		while($ile--)
		{
			$odp=$rezultat->fetch_assoc();
			$id=$odp['id'];
			$name=$odp['file_name'];
			$ifo=pathinfo($name);
			@$info=$ifo['extension'];
			
			if(($info=="jpeg")||($info=="jpg")||($info=="png"))
			{
					if(isset($_GET['user'])==false)
					{
				echo'<form method="POST" action="u.php">';
				echo'<input type="hidden" name="plik" value="'.$id.'"/>';

				echo'</div>';
				echo'<div class="image">  <input type="image" class="image_class" src="Upload/'.$_SESSION['id_user']."/".$name.' "/></div>';
				echo'</form>';
					}
				else
				echo'<div class="image"><img src="Upload/'.$_SESSION['id_user']."/".$name.' " class="image_class"/></div>';
			}

		}
		$connect->close();

?>



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