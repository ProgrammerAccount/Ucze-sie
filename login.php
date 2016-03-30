<?php

       ////Sprawdzam czy pola zostały wypelnione
session_start();
session_regenerate_id( );
if((isset($_POST['login'])==false)&&(isset($_POST['pass'])==false))
{
header("Location: index.php");

}
//Sprawdzam czy recaptha jest wypelniona

      	if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        //jesli nie jest wypelniona wysyłam kompunkat
        if(!$captcha){
   $_SESSION['recaptcha']='<div class="bad">Pokaż że nie jesteś robotem!</div>';

          header("Location: index.php");
           exit;
        }
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Ld-7hgTAAAAAFLWVd6wPiYAIGbGWPFNS-gOPD12&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false)
        {

            $_SESSION['recaptcha']='<div class="bad">Pokaż że nie jesteś robotem!</div>';
        }

	$login=$_POST['login'];
	$pass1=$_POST['pass'];
// Oczyszczam login z znakow i bronie sie przed wstrzykiwaniem sql
$login=htmlentities($login);
//Loncze sie z baza
	require("connect.php");
	$connect= new mysqli($host,$user,$pass,$base);
	$rezultat=$connect->query("SELECT * FROM user WHERE user='$login'");
	$ile = $rezultat->num_rows;
//sprawdzam czy jest taki login
if($ile > 0)
{
	$odp=$rezultat->fetch_assoc();
	//sprawdzam czy haslo sie zgadzaja
if(password_verify($pass1,$odp['pass'])==true)
{
	$_SESSION['id_user']=$odp['id'];
	$_SESSION['login']=true;
	header("Location: HostBook.php");
	exit;
}
	else $_SESSION['bad']='<div class="bad">Login lub hasło jest nie poprawne</div>'; header("Location: index.php");
}
	else $_SESSION['bad']='<div class="bad">Login lub hasło jest nie poprawne</div>'; header("Location: index.php");
$rezultat->free();
$connect->close();
?>
