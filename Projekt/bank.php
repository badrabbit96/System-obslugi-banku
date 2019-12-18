 <?php
	session_start();
	mysql_connect("localhost","root","");
	mysql_select_db("bank");
	
	
	mysql_query("SET CHARSET utf8");
    mysql_query("SET NAMES `utf8` COLLATE `utf8_polish_ci`");

	?>
	
<?php

if (isset($_SESSION['bank'])==true)
{
	 header("Location:bank-cp.php");
	echo "Witaj <b>".$_SESSION['login']."</b><br><br>";
	
	echo '<a href="?wyloguj=1">[Wyloguj]</a>';
}
?>

<?php if (isset($_SESSION['bank'])==false): ?>
 <!DOCTYPE html>
<html>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Universe Bank - Bank</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link rel="shortcut icon" href="favicon.ico">
	<link href="css/logoFont.css" rel="stylesheet">
	<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
  </head>

  <body>
  <?php
  
$user_agent =$_SERVER['HTTP_USER_AGENT'];
$time = date('d/m/Y H:i:s');
$ip = $_SERVER['REMOTE_ADDR'];
?>
  <div class="container text-center">
  <br>
  	<logoFontBlack>Universe Bank </logoFontBlack>
        <div class="row">
          <div class="col-lg-6 mx-auto">
		  <br>
  <div class="card mb-6">
   <div class="card-header">
    System zarządzania bankiem
  </div>
  <div class="card-body">
 <?php
 function filtruj($zmienna) 
{
    if(get_magic_quotes_gpc())
        $zmienna = stripslashes($zmienna); // usuwamy slashe

	// usuwamy spacje, tagi html oraz niebezpieczne znaki
    return mysql_real_escape_string(htmlspecialchars(trim($zmienna))); 
}
if (isset($_POST['loguj'])) 
{
	$login = filtruj($_POST['login']);
	$haslo = filtruj($_POST['haslo']);
	
	if (mysql_num_rows(mysql_query("SELECT login, haslo FROM control_panel WHERE login = '".$login."' AND haslo = '".md5($haslo)."';")) > 0) 
	{
		$_SESSION['bank'] = true;
		$_SESSION['login_dostepu'] = $login;
		
		mysql_query("INSERT INTO `logi_cp` (`login`, `user_agent`, `data`, `ip`, `udane_logowanie`)
				VALUES ('".$login."', '".$user_agent."', '".$time."', '".$ip."', '1');");
		
		echo '<meta http-equiv="refresh" content="0">';
		
	}
	
	else 
	{
		mysql_query("INSERT INTO `logi_cp` (`login`, `user_agent`, `data`, `ip`, `udane_logowanie`)
				VALUES ('".$login."', '".$user_agent."', '".$time."', '".$ip."', '0');");
				
		echo '<div class="alert alert-danger" role="alert">Wpisano błędne dane !</div>';
	}
	
	
}

 ?>
 
	<form role="form" method="POST" action="bank.php">
  <div class="form-group">
    <label for="exampleInputEmail1">Numer dostępu:</label>
    <input type="text" name="login" class="form-control" >
    <small id="emailHelp" class="form-text text-muted">Każde logowanie jest monitorowanie i zapisywane.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Hasło:</label>
    <input type="password" name="haslo" class="form-control" >
  </div>
 
  <button type="submit" name="loguj" class="btn btn-primary">Dalej ></button>
</form>
	
	</div>
	</div>
	</div>
	</div>
	<br><br>
	<p>
  <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#info" aria-expanded="false" aria-controls="info">
    Informacje
  </button>
</p>
<div class="collapse" id="info">
  <div class="card card-body">
	<?php


function getOS() { 

    global $user_agent;

    $os_platform    =   "Unknown OS Platform";

    $os_array       =   array(
                            '/windows nt 10/i'     =>  'Windows 10',
                            '/windows nt 6.3/i'     =>  'Windows 8.1',
                            '/windows nt 6.2/i'     =>  'Windows 8',
                            '/windows nt 6.1/i'     =>  'Windows 7',
                            '/windows nt 6.0/i'     =>  'Windows Vista',
                            '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                            '/windows nt 5.1/i'     =>  'Windows XP',
                            '/windows xp/i'         =>  'Windows XP',
                            '/windows nt 5.0/i'     =>  'Windows 2000',
                            '/windows me/i'         =>  'Windows ME',
                            '/win98/i'              =>  'Windows 98',
                            '/win95/i'              =>  'Windows 95',
                            '/win16/i'              =>  'Windows 3.11',
                            '/macintosh|mac os x/i' =>  'Mac OS X',
                            '/mac_powerpc/i'        =>  'Mac OS 9',
                            '/linux/i'              =>  'Linux',
                            '/ubuntu/i'             =>  'Ubuntu',
                            '/iphone/i'             =>  'iPhone',
                            '/ipod/i'               =>  'iPod',
                            '/ipad/i'               =>  'iPad',
                            '/android/i'            =>  'Android',
                            '/blackberry/i'         =>  'BlackBerry',
                            '/webos/i'              =>  'Mobile'
                        );

    foreach ($os_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $os_platform    =   $value;
        }

    }   

    return $os_platform;

}

function getBrowser() {

    global $user_agent;

    $browser        =   "Unknown Browser";

    $browser_array  =   array(
                            '/msie/i'       =>  'Internet Explorer',
                            '/firefox/i'    =>  'Firefox',
                            '/safari/i'     =>  'Safari',
                            '/chrome/i'     =>  'Chrome',
                            '/edge/i'       =>  'Edge',
                            '/opera/i'      =>  'Opera',
                            '/netscape/i'   =>  'Netscape',
                            '/maxthon/i'    =>  'Maxthon',
                            '/konqueror/i'  =>  'Konqueror',
                            '/mobile/i'     =>  'Handheld Browser'
                        );

    foreach ($browser_array as $regex => $value) { 

        if (preg_match($regex, $user_agent)) {
            $browser    =   $value;
        }

    }

    return $browser;

}


$user_os        =   getOS();
$user_browser   =   getBrowser();

$device_details =   "<strong>Przeglądarka: </strong>".$user_browser."<br /> <strong>System operacyjny: </strong>".$user_os." <strong>Czas: </strong>".$time."<br /><strong>IP: </strong>".$ip."";

print_r($device_details);

echo("<br /><small>".$_SERVER['HTTP_USER_AGENT']."</small>");

?>
  </div>
</div>
	</div>
<?php endif; ?>
<?php mysql_close(); ?>
	
	</body>
	
	</html>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
	