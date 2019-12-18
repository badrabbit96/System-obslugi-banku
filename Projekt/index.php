<?php
	session_start();
	mysql_connect("localhost","root","");
	mysql_select_db("bank");
	
	
	mysql_query("SET CHARSET utf8");
    mysql_query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");

	?>
	
<?php

if (isset($_SESSION['zalogowany'])==true)
{
	 header("Location:home.php");
	echo "Witaj <b>".$_SESSION['login']."</b><br><br>";
	
	echo '<a href="?wyloguj=1">[Wyloguj]</a>';
}
?>

<?php if (isset($_SESSION['zalogowany'])==false): ?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bankowość elektroniczna Universe Bank</title>
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="assets/css/form-elements.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="shortcut icon" href="favicon.ico">

    </head>

    <body>
	
        <div class="top-content">   	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<br>
								<center>
									<h1>Universe Bank</h1>
                        			<p>Bankowość elektroniczna</p>
									
								</center>                 	
                            </div>
                            <div class="form-bottom">
<?php
$wrong_data=false;
function filtruj($zmienna) 
{
    if(get_magic_quotes_gpc())
        $zmienna = stripslashes($zmienna); // usuwamy slashe

	// usuwamy spacje, tagi html oraz niebezpieczne znaki
    return mysql_real_escape_string(htmlspecialchars(trim($zmienna))); 
}

if (isset($_POST['loguj'])) 
{
	$logowanie_data = date('d/m/Y H:i:s');

	$login = filtruj($_POST['login']);
	$haslo = filtruj($_POST['haslo']);
	$ip = filtruj($_SERVER['REMOTE_ADDR']);
	
	// sprawdzamy czy login i hasło są dobre
	if (mysql_num_rows(mysql_query("SELECT login, haslo FROM uzytkownicy WHERE login = '".$login."' AND haslo = '".md5($haslo)."';")) > 0) 
	{	

	$result = mysql_query("SELECT aktywacja FROM uzytkownicy WHERE login = '".$login."' ");
    $row = mysql_fetch_row($result);
    $aktywacja = $row[0];
	
		if($aktywacja==1)
		{
		// uaktualniamy date logowania oraz ip
		mysql_query("UPDATE `uzytkownicy` SET `logowanie` = '".$logowanie_data."', `ip` = '".$ip."' WHERE login = '".$login."';");
	
		$_SESSION['zalogowany'] = true;
		$_SESSION['login'] = $login;
		
		echo '<meta http-equiv="refresh" content="0">';
		// zalogowany
		}
		else
		{
			echo '<div class="alert alert-warning" role="alert">Twoje konto nie zostało jeszcze aktywowane !</div>';

		}

	}
	else 
	{
		$wrong_data==true;
		echo '<div class="alert alert-danger" role="alert">Wpisano błędne dane !</div>';
	}
	

}


?>					
								<div class="form_right">
								<a href="" data-toggle="modal" data-target="#exampleModal">Nie masz konta ?</a>
								</div>
			                    <form role="form" method="POST" action="index.php" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Numer klienta</label>
			                        	<input type="text" name="login" placeholder="Numer klienta" class="form-username form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Hasło</label>
			                        	<input type="password" name="haslo" placeholder="Hasło" class="form-password form-control" id="form-password">
			                        </div>
			                        <button type="submit" class="btn" name="loguj">Dalej ></button>
			                    </form>
								
		                    </div>
							
                        </div>
                    </div>
                   
                </div>
				
		</div> 
		</div> 

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nie masz konta?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3>Załóż całkowicie darmowe konto osobiste już teraz !</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" onclick="location.href='rejestracja.php';">Załóż konto !</button>
      </div>
    </div>
  </div>
</div>			


     
        <script src="assets/js/jquery-1.11.1.min.js"></script>
        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.backstretch.min.js"></script>
        <script src="assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->
<?php endif; ?>
<?php mysql_close(); ?>
    </body>

</html>


	