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
  <link href="css/logoFont.css" rel="stylesheet">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
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
$dane_nadawcy;

$query = sprintf("SELECT imie, nazwisko,adres FROM dane WHERE login = '%s'",
    mysql_real_escape_string($_SESSION['login']));
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {
	echo "Witaj, ";
    echo $row['imie']. " ";
    echo $row['nazwisko'];
$dane_nadawcy = $row['imie']." ".$row['nazwisko']. " ".$row['adres'];
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
        <li class="breadcrumb-item active">Przelewy</li>
      </ol>
        <div class="row">
        <div class="col-lg-12">
          <div class="card mb-3 bg-light">
            <div class="card-header">
              <i class="fa"></i>Przelew jednorazowy:</div>
            <div class="card-body">
<!-- KWOTA ZAPISU 0.00-->			
<SCRIPT language=Javascript>
    function isNumberKey(evt)
       {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
       }
       $(document).ready(function ()
      {
         $('#Percentage1').keyup(function (event)
        {
            var currentValue = $(this).val();
            var length = currentValue.length;

            if (length == 2)
            {
                $(this).val(currentValue + ".");
            }
            else if (length == 3)
            {
                $(this).val(currentValue + "");
            }
        });
    });
    </SCRIPT>
			<form role="form" method="POST" action="przelewy.php">
			
			<div class="form-group col-lg-6">
			<label>Numer rachunku:</label>
			<input type="text" class="form-control" name="numer_konta_odb" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
			<small id="emailHelp" class="form-text text-muted">Sprawdź czy numer rachunku jest wpisany prawidłowo.</small>
			</div>
			<div class="form-group col-lg-6">
			<label>Dane odbiorcy:</label>
			<textarea class="form-control" name="dane_odbiorcy" rows="3"></textarea>
			</div>
			<div class="form-group col-lg-6">
			<label>Tytuł</label>
			<input type="text" class="form-control" name="tytul">
			</div>
			<div class="form-group col-lg-2">
			<label>Kwota <small>PLN</small></label>
			<input type="text" class="form-control" name="kwota" placeholder="0.00" onpaste="return false"
        onkeypress="return isNumberKey(event)" maxlength="7">
			</div>
			<div class="form-group col-lg-1">
			<button type="submit" class="btn btn-primary" name="wykonaj">Wykonaj</button>
			</div>
			</form>
	
<?php
if (isset($_GET['wyloguj'])==1) 
{
	$_SESSION['zalogowany'] = false;
	session_destroy();
//	header("Refresh:0");
	echo '<meta http-equiv="refresh" content="0">';
}
?>		
<?php
$saldo="0";
$numer_konta_nadawcy ="0";
$query = sprintf("SELECT numer_konta,saldo FROM konta_osobiste WHERE login = '%s'",
mysql_real_escape_string($_SESSION['login']));
$result = mysql_query($query);

while ($row = mysql_fetch_assoc($result)) {
	$saldo = $row['saldo'];
	$numer_konta_nadawcy = $row['numer_konta'];
}
?>		

<?php
function filtruj($zmienna) 
{
    if(get_magic_quotes_gpc())
        $zmienna = stripslashes($zmienna); // usuwamy slashe

	// usuwamy spacje, tagi html oraz niebezpieczne znaki
    return mysql_real_escape_string(htmlspecialchars(trim($zmienna))); 
}

if (isset($_POST['wykonaj'])) 
{

$jeden = "1";
$numer_konta_odbiorcy = filtruj($_POST['numer_konta_odb']);
$kwota_przelewu = round(filtruj($_POST['kwota']), 2);
$dane_odbiorcy = $_POST['dane_odbiorcy'];
$tytul = $_POST['tytul'];
$data = date('d/m/Y');
$login_odbiorcy = "null";

$query2 = sprintf("SELECT login FROM konta_osobiste WHERE numer_konta = '%s'",
mysql_real_escape_string($numer_konta_odbiorcy));
$result2 = mysql_query($query2);	
while ($row2 = mysql_fetch_assoc($result2)) {
	$login_odbiorcy = $row2['login'];
}

if($kwota_przelewu == NULL or $numer_konta_odbiorcy == NULL) echo '<div class="form-group col-lg-6"><div class="alert alert-warning" role="alert">Błędne dane !</div></div>';


else
{	//sprawdzam czy konto jest w naszym banku
	if (mysql_num_rows(mysql_query("SELECT login FROM konta_osobiste WHERE numer_konta = ".$numer_konta_odbiorcy.";")) > 0) 
	{
		if($saldo-$kwota_przelewu<0)
			echo '<div class="form-group col-lg-6"><div class="alert alert-danger" role="alert">Brak wymaganych środków na koncie !</div></div>';
		else
		{	
			//odejmuje pieniadze od nadawcy
			mysql_query("UPDATE `konta_osobiste` SET `saldo` = `saldo` - ".$kwota_przelewu." WHERE numer_konta = '".$numer_konta_nadawcy."'");
			//dodaje pieniądze do odbiorcy
			mysql_query("UPDATE `konta_osobiste` SET `saldo` = `saldo` + ".$kwota_przelewu." WHERE numer_konta = '".$numer_konta_odbiorcy."'");
			//dodaje wykonane przelewy
			mysql_query("UPDATE `uzytkownicy` SET `przelewy` = `przelewy` + ".$jeden."  WHERE login = '".($_SESSION['login'])."'");
					
			//dodaje operację do odbiorcy
			mysql_query("INSERT INTO `przelewy` (`login`, `data`, `dane`, `numer_konta`, `tytul`, `kwota`)
				VALUES ('".($_SESSION['login'])."', '".$data."', '".$dane_odbiorcy."', '".$numer_konta_odbiorcy."', '".$tytul."', '-".$kwota_przelewu."');");
				
				
			//dodaje operacje do nadawcy
			mysql_query("INSERT INTO `przelewy` (`login`, `data`, `dane`, `numer_konta`, `tytul`, `kwota`)
				VALUES ('".$login_odbiorcy."', '".$data."', '".$dane_nadawcy."', '".$numer_konta_nadawcy."', '".$tytul."', '".$kwota_przelewu."');");
				
			echo '<div class="form-group col-lg-6"><div class="alert alert-success" role="alert">Przelew został wykonany !</div></div>';

		}
	}
	else
		echo '<div class="form-group col-lg-6"><div class="alert alert-warning" role="alert">Numer rachunku nie pochodzi z naszego banku !</div></div>';
	
}

}


?>
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


