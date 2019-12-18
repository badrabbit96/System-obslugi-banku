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
	
 <!-- KLIENCI-->
	<div class="card-header">
    Logi:
  </div>
  <div class="card card-body ">
  
  
  <table class="table table-bordered table-responsive-sm" id="dataTable" width="100%" cellspacing="0">
  <thead class="thead-dark">
    <tr>
	  <th scope="col">Kod dostępu</th>
      <th scope="col">User Agent</th>
      <th scope="col">Data</th>
	  <th scope="col">IP</th>
	  <th scope="col">Logowanie:</th> 
    </tr>
  </thead>
  <tbody>
    
	<?php 
	//,numer_konta,saldo
	$query = sprintf("SELECT login,user_agent,data,ip,udane_logowanie FROM logi_cp");
	
	$result = mysql_query($query);

	while ($row = mysql_fetch_assoc($result)) {
		echo "<tr>";
    echo "<th>".$row['login']. "</th>";  
	echo "<td>".$row['user_agent']. "</td>"; 
	echo "<td>".$row['data']. "</td>"; 
	echo "<td>".$row['ip']. "</td>"; 
	//echo "<td>".$row['udane_logowanie']. "</td>"; 
	if($row['udane_logowanie']==1)
	{
		echo '<td><p class="text-success">Logowanie poprawne</p></td>';
	}
	else
	{
		echo '<td><p class="text-danger">Logowanie niepoprawne</p></td>';
	}

		echo "</tr>";
	}
	
	?>
   
  </tbody>
</table>
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
