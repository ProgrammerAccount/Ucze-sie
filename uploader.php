<?php

//Sprawdzam czy uzytkowanik jest zalogowany

session_start();
session_regenerate_id( );
if(isset($_SESSION['login'])==false)
{
header("Location:index.php");

}
?>
<?php

//Sprawdzam czy plik jest wysłany

if(isset($_FILES['file']))
{
	//Sprawdzam rozszezenie

		$name1=$_FILES['file']['name'];
		$tmp_name = $_FILES["file"]["tmp_name"];
		$uploads_dir = "Upload/".$_SESSION['id_user'];
		$info=pathinfo($name1);
		@$inf=$info['extension'];

		//zmieniam nazwe na Losowa

		$name="img";
	for($i=0;$i<10;$i++)
	{
	
	$XD=rand(1,9);
	$name=$name.(string)$XD;
	}
		$name= $_FILES["file"]["name"]=$name.'.'.$inf;

 //Sprawdzam czy to zdjecie

if(($inf=="png")||($inf=="jpg")||($inf=="jpeg")||($inf=="gif"))
	{
move_uploaded_file($tmp_name,"$uploads_dir/$name" );
$type=mime_content_type("$uploads_dir/$name");
	if(($type=="image/png")||($type=="image/jpg")||($type=="image/jpeg")||($type=="image/gif"))
		{
			
		
	
			require("connect.php");
			$connect=new mysqli($host,$user,$pass,$base);

		if($connect->connect_error)
		{
			echo "Error".$connect->connect_errno;
		}
		else
		{
		
			$connect->query("INSERT INTO file VALUES(NULL,'$name','{$_SESSION['id_user']}','0')");		
			$connect->close();
		}
 	}
 	else 
 	{
 		$_SESSION['bad']='<div class="bad">Ten serwis obsługuje tylko zdjecia z rozszeżeniem png , jpeg i jpg ten plik ma rozszeżeniem: ' . $inf.' </div>';
 		unlink("$uploads_dir/$name");
	}

	}

else
	$_SESSION['bad']='<div class="bad">Ten serwis obsługuje tylko zdjecia z rozszeżeniem png , jpeg i jpg ten plik ma rozszeżeniem: ' . $inf.' </div>';

}
?>
<!DOCTYPE html>

<html>

	<head>
<link href='https://fonts.googleapis.com/css?family=Lato:400,700italic' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
		<title>HostBook</title>
		<meta charset="utf-8"/>
			<style>

				.bad
				{
					color : red;
				}

			</style>
			<link rel="stylesheet" href="style.css" type="text/css" />

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

		<form enctype="multipart/form-data" method="POST" >

<div style=" marign:auto; text-align: center; margin-top: 100px;">		<input  type="file" name="file" accept="image/*" />
			<input type="submit" value="Wyslij plik">
			<input type="hidden" name="MAX_FILE_SIZE" value="30000" /></div>	
			<div style="font-size: 35px; font-family: 'Lato', sans-serif; text-align: center;" ><p> Wybierz "Browse..." i wyszukaj zdjęcia które chcesz udostępnić.</p> Następnie nacisnij Wyslij Plik </div> 
				<?php

				if(isset($_SESSION['bad']))
				{

				echo $_SESSION['bad'];	
				unset($_SESSION['bad']);

				}

		 		?>

		</form>
		<script src="jquery.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
var nav= $('#linki').offset().top;
var stickyN=function()
{
var scroll=$(window).scrollTop()
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
