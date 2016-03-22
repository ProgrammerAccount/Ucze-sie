<?php
session_start();
$id=$_SESSION['plik'];
require('connect.php');
$polonczenie = new mysqli($host,$user,$pass,$base);

//lonecznie
$rezultat=$polonczenie->query("UPDATE  file SET publiczne='0' WHERE id='".$id."' ");
$polonczenie->close();

  header("Location:przegladarka.php");
 


?>