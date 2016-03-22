        <?php
            session_start(); 
            session_regenerate_id( ); 
    if(isset($_SESSION['login']))
    {
    header("Location: HostBook.php");
exit;
    }
    
        ?>
<!DOCTYPE html>
<html lang="pl">
    <head>
        <meta charset="utf-8"/>
        <title>HostBook</title>
    <link rel="stylesheet" href="style.css" type="text/css"/>
    <script src='https://www.google.com/recaptcha/api.js'></script>

    </head>

    <body>

    <div id="container">


        <form method="post" action="login.php">
         	<div id="kolo"></div>
            <br/>
        	<div class="string">Login:<br/></div>
        	<div class="elements" style="margin-bottom: 2px;" ><input type="text" name="login"/><br/></div>
        	<div  class="string">Hasło:</div>
            <div class="elements" style="margin-bottom: 2px"><input type="password" name="pass"/><br/></div>
            <div class="g-recaptcha" data-sitekey="6Ld-7hgTAAAAAJ_AO-HwAKDFwrznEHO_bt8sRp4x"></div>  
            <div class="string"> <input type="submit" value="Zaloguj się"/></div>
            <br/>
                <?php
                	if(isset($_SESSION['recaptcha']))
                	{
                    echo $_SESSION['recaptcha'];
                    unset($_SESSION['recaptcha']);
                	}  
                ?>
                <?php
                	if(isset($_SESSION['bad']))
                	{
                    echo $_SESSION['bad'];
                    unset($_SESSION['bad']);
                	}

           		?>

            <div class="elements"><div class="link"><a href="rejstracja.php" >Nie masz konta? Stwórz je juz TERAZ!</a></div>
            <br/>

            </br>
            <p style="font-size: 30px; text-align: center;">Co to HostBook i do czego to służy? </p>
            <p style=" font-size: 20px;text-align:center; ">HostBook to Serwist umożliwaijacy udostępnieanie zdjeć za darmo.</p>
             <p style=" font-size: 20px;text-align:center; ">Możesz je udostępnieć lub zatszymać tylko dla siebie.
             </p>
             
                    
</div>



           
        </form>

       
    </body>
</html>