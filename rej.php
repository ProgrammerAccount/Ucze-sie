<?php
session_start();
session_regenerate_id( );
if((isset($_POST['login'])==false)&&(isset($_POST['pass'])==false))
{
header("Location: rejstracja.php");

}
$imie=$_POST['name'];
$login=$_POST['login'];
$email=$_POST['email'];
$pass1=$_POST['pass'];
$pass2=$_POST['pass2'];
$good=true;
$_SESSION['R_name']=$imie;
if(isset($_POST['reg'])==false)
{
$good=false;
$_SESSION['e_reg']="Zakceptuj regulamin!";
}
$imie=htmlentities($imie);
$login=htmlentities($login);
require("connect.php");

//Sprawdzam czy login jest używany + łacze sie z bazą

$connect= new mysqli($host,$user,$pass,$base);
$rezultat=$connect->query("SELECT * FROM user WHERE user='$login'");
$ile = $rezultat->num_rows;
if($ile > 0)
{
	$good=false;
	$_SESSION['e_nick']="Ten Nick jest już używany";
}
//E-mail sanityzacja
//{

function znak($str,$find)
{
$ile=strlen($str)-1;
$is_good=false;
for($i=0;$ile>=$i;$i++)
{
if($str[$i]==$find)
$is_good=true;
}
if($is_good==true)
{
	return true;
}
else
{
	return false;
}

}
//sprawdzam czy emial jest poprawny skaładniowo
if(znak($email,"@")==false)
{
$good=false;
$_SESSION['e_mail']="E-mail nie jest poprawny";	
}
if(znak($email,".")==false)
{
$good=false;
$_SESSION['e_mail']="E-mail nie jest poprawny";	
}

	$b_mail=filter_var($email,FILTER_SANITIZE_EMAIL);

if((filter_var($b_mail,FILTER_VALIDATE_EMAIL)==false)&&($b_mail!=$email))
{
	$good=false;
	$_SESSION['e_mail']="E-mail nie jest poprawny";
}
$rezultat=$connect->query("SELECT * FROM user WHERE email='$email'");
$ile = $rezultat->num_rows;
if($ile > 0)
{
	$good=false;
	$_SESSION['e_mail']="Ten E-mail jest już używany";
}
//}
//Password
//{
// sprawdzam czy chaslo ma 0d 8 do 20 znakow
if((strlen($pass1)<8)&&(strlen($pass1)>20))
{
	$good=false;
	$_SESSION['e_pass']="Hasło może mieć od 8 do 20 znaków";
}
//haszuje hslo
	$pass_H= password_hash($pass1,PASSWORD_DEFAULT);

if($pass1!=$pass2)
{
	$good=false;
	$_SESSION['e_pass']="Hasła nie są takie same!";
}

//}
//Sprawdzam czy recaptha waliduje
      	if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
   $_SESSION['recaptcha']='<div class="bad">Pokaż że nie jesteś robotem!</div>'; 
      $good=false;   
      

        }
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Ld-7hgTAAAAAFLWVd6wPiYAIGbGWPFNS-gOPD12&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
        if($response.success==false)
        {

            $_SESSION['recaptcha']='<div class="bad">Pokaż że nie jesteś robotem!</div>';  

      $good=false;   
        }  

        //Sprawdzam czy wszystko dobrze
if($good==true)
{
	// wkładam dane do sql
	$_SESSION['name']=$imie;


	$connect->query("INSERT INTO user VALUES('NULL','$login','$pass_H','$email','$imie')");
	$anwers=$connect->query("SELECT * FROM user WHERE user='$login'");
	$odp=$anwers->fetch_assoc();
	$id=$odp['id'];
	$_SESSION['name']=$imie;
	//tworze folder urzytowanika
mkdir("Upload/$id");
fopen("Upload/$id/index.php","w+");
fwrite
(fopen("Upload/$id/index.php","w+"), "No chyba nie XDD");
fclose(fopen("Upload/$id/index.php","w+"));
$rezultat->free();
	$connect->close();



header("Location: witaj.php");
exit();
}
else
{
	$connect->close();
	 session_regenerate_id( ); 
header("Location: rejstracja.php");

}
?>