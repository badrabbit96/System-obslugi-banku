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
  <title>Universe Bank - Zarządzanie bankiem</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
  <link href="css/sb-admin.css" rel="stylesheet">
  <link href="css/logoFont.css" rel="stylesheet">
  <link rel="shortcut icon" href="favicon.ico">
  
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="bank-cp.php"><logoFont>Universe Bank - Zarządzanie bankiem</logoFont></a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
          <a class="nav-link" href="bank-cp.php">
            <i class="fa fa-fw fa-area-chart"></i>
            <span class="nav-link-text">Klienci</span>
          </a>
        </li>
		<li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="aktywacje-cp.php">
            <i class="fa fa-fw fa-link"></i>
            <span class="nav-link-text">Aktywacje</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Charts">
          <a class="nav-link" href="wplata-wyplata.php">
            <i class="fa fa-fw fa-sitemap"></i>
            <span class="nav-link-text">Wpłata / Wypłata</span>
          </a>
        </li>
        <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Tables">
          <a class="nav-link" href="logi.php">
            <i class="fa fa-fw fa-wrench"></i>
            <span class="nav-link-text">Logi</span>
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
          <a class="nav-link" href="">
            <i class="fa fa-fw"></i>
            <span class="nav-link-text">
			Numer dostępu, 
<?php
session_start();
if(isset($_SESSION['bank'])) {
	

    echo $_SESSION['login_dostepu'];
}
else
{
		header("Location:bank.php");
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
      
     

<?php
if (isset($_GET['wyloguj'])==1) 
{
	$_SESSION['zalogowany'] = false;
	session_destroy();
	header("Location:index.php");
}
?>
	
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
 <!-- WPŁATA-->
 <br><br>
	<div class="row">
		  <div class="col-xl-6 col-sm-6 mb-3">
         <div class="card text-white bg-success text-black mb-3" style="max-width: 40rem;">
  <div class="card-header">Wpłata na rachunek:</div>
  <div class="card-body">
   <div class="form-group">
   <form role="form" method="POST" action="wplata-wyplata.php">
    <label for="exampleInputPassword1">Numer rachunku:</label>
    <input type="text" class="form-control is-valid" name="numer_rachunku" onkeypress="return isNumberKey(event)" required title="Podaj numer !">
  </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Kwota:</label>
    <input type="text" class="form-control is-invalid" name="kwota" placeholder="0.00" onpaste="return false"
        onkeypress="return isNumberKey(event)" maxlength="7" required title="Podaj kwotę !">
  </div>
    <button class="btn btn-primary" name="wplata_dok" type="submit">Dokonaj wpłaty</button>
</form>
  </div>
</div>
<?php
if (isset($_POST['wplata_dok'])) 
{
	$numer_rachunku = $_POST['numer_rachunku'];
	$kwota = $_POST['kwota'];
	$data = date('d/m/Y');
		if (mysql_num_rows(mysql_query("SELECT login FROM konta_osobiste WHERE numer_konta = ".$numer_rachunku.";")) > 0) 
	{
		$query2 = sprintf("SELECT login FROM konta_osobiste WHERE numer_konta = '%s'",
		mysql_real_escape_string($numer_rachunku));
		$result2 = mysql_query($query2);	
		while ($row2 = mysql_fetch_assoc($result2)) {
				$login_odbiorcy = $row2['login'];
		}

		//dodaje pieniadze
		mysql_query("UPDATE `konta_osobiste` SET `saldo` = `saldo` + ".$kwota." WHERE numer_konta = '".$numer_rachunku."' ");
		
		//dodaję operację	
		mysql_query("INSERT INTO `przelewy` (`login`, `data`, `dane`, `numer_konta`, `tytul`, `kwota`)
				VALUES ('".$login_odbiorcy."', '".$data."', 'UNIVERSE BANK ul. Rejtana 14', '".$numer_rachunku."', 'Wpłata', '".$kwota."');");

		echo '<div class="form-group col-lg-12"><div class="alert alert-success" role="alert">Wpłata dokonana !</div></div>';

	}
	else
	{
	echo '<div class="form-group col-lg-12"><div class="alert alert-warning" role="alert">Numer rachunku nie pochodzi z naszego banku !</div></div>';
	}
 
}
?>
        </div>
		 <div class="col-xl-6 col-sm-6 mb-3">
         <div class="card text-white bg-danger  mb-3" style="max-width: 40rem;">
  <div class="card-header">Wypłata pieniędzy z rachunku:</div>
  <div class="card-body">
   <form role="form" method="POST" action="wplata-wyplata.php">
   <div class="form-group">
    <label for="exampleInputPassword1">Numer rachunku:</label>
    <input type="text" class="form-control is-valid" name="numer_rachunku_wyp" onkeypress="return isNumberKey(event)" required title="Podaj numer !">
  </div>
   <div class="form-group">
    <label for="exampleInputPassword1">Kwota:</label>
    <input type="text" class="form-control is-invalid" name="kwota_wyp" placeholder="0.00" onpaste="return false"
        onkeypress="return isNumberKey(event)" maxlength="7" required title="Podaj kwotę !">
  </div>
    <button class="btn btn-primary" type="submit" name="wyplata_dok">Dokonaj wypłaty</button>
	</form>
  </div>
</div>
<?php
if (isset($_POST['wyplata_dok'])) 
{
	$aria="true";
	
	$numer_rachunku_wyp = $_POST['numer_rachunku_wyp'];
	$kwota_wyp = $_POST['kwota_wyp'];
	$data = date('d/m/Y');
		if (mysql_num_rows(mysql_query("SELECT login FROM konta_osobiste WHERE numer_konta = ".$numer_rachunku_wyp.";")) > 0) 
	{
		$query2 = sprintf("SELECT login FROM konta_osobiste WHERE numer_konta = '%s'",
		mysql_real_escape_string($numer_rachunku_wyp));
		$result2 = mysql_query($query2);	
		while ($row2 = mysql_fetch_assoc($result2)) {
				$login_odbiorcy = $row2['login'];
		}

		//odejmuje pieniadze
		mysql_query("UPDATE `konta_osobiste` SET `saldo` = `saldo` - ".$kwota_wyp." WHERE numer_konta = '".$numer_rachunku_wyp."'");
		
		//odejmuje operację	
		mysql_query("INSERT INTO `przelewy` (`login`, `data`, `dane`, `numer_konta`, `tytul`, `kwota`)
				VALUES ('".$login_odbiorcy."', '".$data."', 'UNIVERSE BANK ul. Rejtana 14', '".$numer_rachunku_wyp."', 'Wypłata', '-".$kwota_wyp."');");

		echo '<div class="form-group col-lg-12"><div class="alert alert-success" role="alert">Wypłata dokonana !</div></div>';

	}
	else
	{
	echo '<div class="form-group col-lg-12"><div class="alert alert-warning" role="alert">Numer rachunku nie pochodzi z naszego banku !</div></div>';
	}
 
}
?>
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
