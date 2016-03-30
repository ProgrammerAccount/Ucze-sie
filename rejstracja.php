<?php
session_start();
session_regenerate_id( );
?>
<html lang="pl">
	<head>
		<meta charset="utf-8"/>
		<title>Stwórz darmowe konto</title>

        <script src='https://www.google.com/recaptcha/api.js'></script>
        <link rel="stylesheet" type="text/css" href="style.css">
	</head>
	<body>

<div id="container">
	<div id="kolo"></div>
		<form method="POST" action="rej.php">
			<div class="string">	Imie:<br/></div>
	 <div class="elements" >	<input type="text" name="name"><br/></div>
		<div style="margin-top: 10px;" class="string">Login:<br/></div>
		<?php
			if(isset($_SESSION['e_nick']))
		{
			echo '<div class="bad">'.$_SESSION['e_nick']."</div><br/>";
			unset($_SESSION['e_nick']);
		}
		?>
		<div class="elements"><input type="text" name="login"><br/>
				<div style="margin-top: 10px;" class="string">E-mail:<br/></div>
		<div class="elements"><input type="text" name="email"><br/></div>
		<?php
		if(isset($_SESSION['e_mail']))
		{
			echo '<div class="bad">'.$_SESSION['e_mail']."</div><br/>";
			unset($_SESSION['e_mail']);
		}
		?>
				<div class="string">Hasło:<br/></div>
		<div class="elements"><input type="password" name="pass"><br/></div>
		<div class="string">Powtórz Hasło:<br/></div>
		<div class="elements"><input type="password" name="pass2"><br/></div>
		<?php
		if(isset($_SESSION['e_pass']))
		{
			echo '<div class="bad">'.$_SESSION['e_pass']."</div><br/>";
			unset($_SESSION['e_pass']);
		}
		?>
				<div class="string">Akceptuj regulamin  <input type="checkbox" name="reg"></br></div>
	<br/>
			<?php
		if(isset($_SESSION['e_reg']))
		{
			echo '<div class="bad">'.$_SESSION['e_reg']."</div><br/>";
			unset($_SESSION['e_reg']);
		}
		?>
		<div class="g-recaptcha" data-sitekey="6Ld-7hgTAAAAAJ_AO-HwAKDFwrznEHO_bt8sRp4x"></div>
		     <?php
                if(isset($_SESSION['recaptcha']))
                {
                    echo $_SESSION['recaptcha'];
                    unset($_SESSION['recaptcha']);
                }  ?>
		<div class="elements"><input type="submit" value="Zarejstruj się"><br/></div></div>
		</form>

</div>

	</body>




</html>
