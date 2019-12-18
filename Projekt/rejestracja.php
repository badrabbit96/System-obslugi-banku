<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Universe Bank - Rejestracja konta</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	<link href="css/logoFont.css" rel="stylesheet">
    <link href="vendor/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">
    <link href="css/stylish-portfolio.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="favicon.ico">
  </head>

  <body id="page-top">
  
    <header class="masthead d-flex">
      <div class="container text-center my-auto">
       <h1 class="mb-1"><logoFontBig>Universe Bank</logoFontBig></h1>
		<br><br>
		<?php
mysql_connect("localhost","root","");
mysql_select_db("bank");


	 mysql_query("SET CHARSET utf8");
    mysql_query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
	
function filtruj($zmienna) 
{
    if(get_magic_quotes_gpc())
        $zmienna = stripslashes($zmienna); 

    return mysql_real_escape_string(htmlspecialchars(trim($zmienna))); 
}

if (isset($_POST['loguj']))  
{
	$logowanie_data = date('d/m/Y H:i:s');
	
	
	
	$haslo1 = filtruj($_POST['haslo1']);
	$email = filtruj($_POST['email']);
	
	$imie = filtruj($_POST['imie']);
	$nazwisko = filtruj($_POST['nazwisko']);
	$adres = $_POST['adres'];
	
	$ip = filtruj($_SERVER['REMOTE_ADDR']);
	
	$result = mysql_query("SELECT MAX(login) FROM uzytkownicy");
    $row = mysql_fetch_row($result);
    $highest_login = $row[0];
	
	$login = $highest_login + 1;
	
	$result = mysql_query("SELECT MAX(numer_konta) FROM konta_osobiste");
    $row = mysql_fetch_row($result);
    $highest_acc = $row[0];
	
	
	$acc_number =  bcadd($highest_acc, '1');
	
	
		if($haslo1 == NULL or $email == NULL or $imie == NULL or $nazwisko == NULL or $adres == NULL)
		{
			echo '<div class="alert alert-danger" role="alert">Błędne dane ! </div>';
		}
		else
		{
			mysql_query("INSERT INTO `uzytkownicy` (`login`, `haslo`, `email`, `rejestracja`, `logowanie`, `ip`, `aktywacja`)
				VALUES ('".$login."', '".md5($haslo1)."', '".$email."', '".$logowanie_data."', '".$logowanie_data."', '".$ip."','0');");
				
			mysql_query("INSERT INTO `dane` (`login`, `imie`, `nazwisko`, `adres`)
				VALUES ('".$login."', '".$imie."', '".$nazwisko."', '".$adres."');");

			mysql_query("INSERT INTO `konta_osobiste` (`login`, `numer_konta`, `saldo`)
				VALUES ('".$login."', '".$acc_number."', '0');");
				
			echo '<div class="alert alert-secondary" role="alert">Wniosek o utworzenie konta został przyjęty, czekaj na aktywacje konta ! <br>';
			echo "Twój login to: <b> ".$login. "</b> Zapisz go i czekaj na aktywację konta ! </div>";
			
		}
	
}
?>
        <a class="btn btn-light btn-xl js-scroll-trigger" href="#about">Załóż darmowe konto już teraz !</a>
      </div>
      <div class="overlay"></div>
    </header>

    <section class="content-section bg-light" id="about">
      <div class="container text-center">
        <div class="row">
          <div class="col-lg-10 mx-auto">
		  <div class="card mb-6">
  <div class="card-body">
    <h5 class="card-title">Wypełnij formularz:</h5>
    <h6 class="card-subtitle mb-2 text-muted">Wypełnij formularz:</h6>
    <p class="card-text">Po wypełnieniu formularza, obsługa banku potwierdzi twoje dane i aktywuje twoje konto.</p>
   
    <form method="POST" action="rejestracja.php">
		 <br><br>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Adres email</label>
      <input type="email" class="form-control" name="email" placeholder="przyklad@internet.pl" required title="Podaj adres email !">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Hasło do systemu</label>
      <input type="password" class="form-control" name="haslo1"  placeholder="Hasło" pattern=".{8,30}" required title="Minimum 8 znaków !">
    </div>
  </div>
  
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Imię</label>
      <input type="text" class="form-control"  name="imie" placeholder="Jan" required title="Podaj imię !">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Nazwisko</label>
      <input type="text" class="form-control" name="nazwisko" placeholder="Kowalski" required title="Podaj nazwisko !">
    </div>
  </div>
  
  <div class="form-group">
    <label for="inputAddress2">Adres</label>
    <input type="text" class="form-control" name="adres" placeholder="ul.Rejtana 1 35-315 Rzeszów" required title="Podaj adres !">
  </div>
 
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="gridCheck" required title="Musisz zaakceptować regulamin !">
      <label class="form-check-label" name="akceptuje" value="yes" for="gridCheck" >Akceptuje <a href="">regulamin</a> banku
      </label>
    </div>
  </div>
    <input type="button" class="btn btn-primary" value="Strona główna" onclick="location.href='index.php';" > &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

  <input type="submit" class="btn btn-primary" value="Dalej >" name="loguj">

</form>

  </div>
</div>
          </div>
        </div>
      </div>
    </section>
    <a class="scroll-to-top rounded js-scroll-trigger" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/stylish-portfolio.min.js"></script>
  </body>

</html>
<?php mysql_close(); ?>