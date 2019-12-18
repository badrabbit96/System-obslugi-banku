<?php
	mysql_connect("localhost","root","");
	mysql_select_db("bank");
	
	 mysql_query("SET CHARSET utf8");
    mysql_query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");
	?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Bankowość elektroniczna Universe Bank</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link href="css/sb-admin.css" rel="stylesheet">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
  <link href="css/logoFont.css" rel="stylesheet">
  <link rel="shortcut icon" href="favicon.ico">

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="index.php"><logoFont>Universe Bank</logoFont></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="index.php">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Podsumowanie</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="przelewy.php">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Przelewy</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="ustawienia.php">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Ustawienia</span>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
      
         <li class="nav-item d-none d-lg-block">
          <a class="nav-link" href="ustawienia.php">
            <i class="fa fa-fw"></i>
            <span class="nav-link-text">
			
<?php
session_start();
if(isset($_SESSION['zalogowany'])) {
$imie_nazwisko = "";
$adres = "";	

$query = sprintf("SELECT imie, nazwisko,adres FROM dane WHERE login = '%s'",
    mysql_real_escape_string($_SESSION['login']));
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {
	echo "Witaj, ";
    echo $row['imie']. " ";
    echo $row['nazwisko'];
    $imie_nazwisko = $row['imie']. " " .$row['nazwisko'];
	$adres = $row['adres'];
}

}
else
{
		header("Location:index.php");
}
?>	
			</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Wyloguj</a>
        </li>
      </ul>
    </div>
  </nav>
  <div class="content-wrapper">
    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="index.php">Strona główna</a>
        </li>
        <li class="breadcrumb-item active">Ustawienia</li>
      </ol>
  <div class="row">
        <div class="col-xl-6 col-sm-6 mb-3">
         <div class="card text-black bg-light mb-3" style="max-width: 40rem;">
  <div class="card-header">Dane osobowe:</div>
  <div class="card-body">
    <p class="card-text"><?php  echo $imie_nazwisko; echo '<br>'; echo $adres; ?></p>
	<small>Zmiana danych osobowych dostępna jest jedynie w placówce banku.</small>
  </div>
</div>
        </div>
		
		        <div class="col-lg-6">
          <div class="card mb-3 bg-light">
            <div class="card-header">
              <i class="fa"></i>Rachunek podstawowy:</div>
            <div class="card-body">
<?php
$saldo;

$query = sprintf("SELECT numer_konta,saldo FROM konta_osobiste WHERE login = '%s'",
mysql_real_escape_string($_SESSION['login']));
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {
	$saldo = $row['saldo'];
    echo "<h3>".$row['numer_konta']. "</h3>";  
}

//echo "<br>Numer klienta:<b> ".$_SESSION['login']."</b><br><br>";

?>
<?php
if (isset($_GET['wyloguj'])==1) 
{
	$_SESSION['zalogowany'] = false;
	session_destroy();
//	header("Refresh:0");
	echo '<meta http-equiv="refresh" content="0">';
}
?>		<br>
		<small>Rachunek podstawowy jest automatycznie przypisany do konta. </small>
            </div>

          </div>
         </div>
		</div>
	<div class="row">
	 <div class="col-xl-6 col-sm-6 mb-3">
         <div class="card text-black bg-light mb-3" style="max-width: 40rem;">
  <div class="card-header">Zmiana hasła:</div>
  <div class="card-body">
    <p class="card-text"></p>
</p>
  <div class="card card-body">
<?php 
	if (isset($_POST['zmien'])) 
	{
	$stare_haslo = $_POST['stare_haslo'];
	$nowe_haslo = $_POST['nowe_haslo'];
	$nowe_haslo_powtorz = $_POST['nowe_haslo_powtorz'];
	
	
	if($stare_haslo == NULL or $nowe_haslo == NULL or $nowe_haslo_powtorz == NULL)
	{
		echo '<div class="alert alert-danger" role="alert">Nie podano hasła !</div>';
	}
	else
	{
	$login = $_SESSION['login'];
	$password = "";
	$query = sprintf("SELECT haslo FROM uzytkownicy WHERE login = '%s'",
    mysql_real_escape_string($_SESSION['login']));
	$result = mysql_query($query);

	while ($row = mysql_fetch_assoc($result)) {
	$password = $row['haslo'];
	}
	
	if(md5($stare_haslo) == $password)
	{
		if($nowe_haslo == $nowe_haslo_powtorz)
		{	
			mysql_query("UPDATE `uzytkownicy` SET `haslo` = '".md5($nowe_haslo)."' WHERE login = '".$login."'; ");

			echo '<div class="alert alert-success" role="alert">Hasło zostało zmienione !</div>';
		}
		else
		{
			echo '<div class="alert alert-danger" role="alert">Nowe hasła nie zgadzają się !</div>';
		}
	}
	else
	{
		echo '<div class="alert alert-danger" role="alert">Podane stare hasło jest błędne !</div>';
	}
	}
	}
	
	?>
  	<form role="form" method="POST" action="ustawienia.php">
	<div class="input-group col-sm-12">
	<span class="input-group-addon" id="basic-addon1">Stare hasło&nbsp&nbsp&nbsp&nbsp&nbsp </span>
	<input type="password" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="stare_haslo" pattern=".{8,30}" required title="Minimum 8 znaków !">
	</div>
	<br>
	<div class="input-group col-sm-12">
	<span class="input-group-addon" id="basic-addon1">Nowe hasło&nbsp&nbsp&nbsp&nbsp</span>
	<input type="password" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="nowe_haslo" pattern=".{8,30}" required title="Minimum 8 znaków !">
	</div>
	<br>
	<div class="input-group col-sm-12">
	<span class="input-group-addon" id="basic-addon1">Powtórz nowe</span>
	<input type="password" class="form-control" aria-label="Username" aria-describedby="basic-addon1" name="nowe_haslo_powtorz" pattern=".{8,30}" required title="Minimum 8 znaków !">
	</div>
	<br>
	<div class="input-group col-sm-8">
	<button type="submit" class="btn btn-success" name="zmien">Zmieniam hasło</button>
	</div>
	</form>
</div>
  </div>
</div>
        </div>
		<div class="col-xl-6 col-sm-6 mb-3">
		<div class="card text-black bg-light mb-3" style="max-width: 40rem;">
  <div class="card-header">Statystyki:</div>
  <div class="card-body">
    <p class="card-text"></p>
  <div class="card card-body">
<?php
$przelewy = "przelewy";
$ostatnieLogowanie = "ostatnielogowanie";
$adresIP = "adresip";
$rejestracja = "rejestracja";

$query = sprintf("SELECT rejestracja, logowanie, przelewy, ip FROM uzytkownicy WHERE login = '%s'",
    mysql_real_escape_string($_SESSION['login']));
	$result = mysql_query($query);

	while ($row = mysql_fetch_assoc($result)) {
	$przelewy = $row['przelewy'];
	$ostatnieLogowanie = $row['logowanie'];
	$adresIP = $row['ip'];
	$rejestracja = $row['rejestracja'];
	}
?>
  <label class="sr-only" for="inlineFormInputGroupUsername2"></label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon">Wykonane przelewy: </div>
    <input type="text" class="form-control" id="inlineFormInputGroupUsername2" style="text-align:center;" disabled="disabled" placeholder="<?php echo $przelewy; ?>">
  </div>
	<br>
  <label class="sr-only" for="inlineFormInputGroupUsername2"></label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon">Ostatnie logowanie:&nbsp;</div>
    <input type="text" class="form-control" id="inlineFormInputGroupUsername2" style="text-align:center;" disabled="disabled" placeholder="<?php echo $ostatnieLogowanie; ?>">
  </div>
  <br>
  <label class="sr-only" for="inlineFormInputGroupUsername2"></label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon">Adres IP logowania:&nbsp;</div>
    <input type="text" class="form-control" id="inlineFormInputGroupUsername2" style="text-align:center;" disabled="disabled" placeholder="<?php echo $adresIP; ?>">
  </div>
  <br>
  <label class="sr-only" for="inlineFormInputGroupUsername2"></label>
  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
    <div class="input-group-addon">Rejestracja konta:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
    <input type="text" class="form-control" id="inlineFormInputGroupUsername2" style="text-align:center;" disabled="disabled" placeholder="<?php echo $rejestracja; ?>">
  </div>
  </div>
	
  </div>
</div>
        </div>
		</div>
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Universe Bank & Tomasz Niemczyk 2018</small>
        </div>
      </div>
    </footer>
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Czy na pewno chcesz się wylogować ?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Twoja aktualna sesja zostanie przerwana.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Anuluj</button>
            <a class="btn btn-primary" href="?wyloguj=1">Wyloguj</a>
          </div>
        </div>
      </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="js/sb-admin.min.js"></script>
    <script src="js/sb-admin-datatables.min.js"></script>
    <script src="js/sb-admin-charts.min.js"></script>
  </div>
</body>

</html>
