<?php
require_once('/../config/config.php');
require_once(ROOT_PATH . "includes/init.php");
//sessie starten
session_start();
// checken of gebruiker ingelogd is
if (!isset($_SESSION['gebruiker_id'])) {
	$_SESSION['message'] = 'Je bent niet ingelogd.';
	header('Location: ' . BASE_URL);
}
//checken of gebruiker misschien admin in 
if(checkRole($_SESSION['gebruiker_id']) != 3){
                    	header('Location: '  . BASE_URL . 'dashboard/');
                    	exit;
                    }
//checken of sessie verlopen is           
if (isset($_SESSION['timeout']) && $_SESSION['timeout'] + SESSION_TIME < time()) {
	// sessie destroyen als sessie verlopen is.
	session_destroy();
	session_start();
	$_SESSION['message'] = 'Sessie is verlopen.';
	header('Location: ' . BASE_URL);
} else {
	//als sessie niet verlopen is sessie verlengen
	$_SESSION['timeout'] = time();
}
//examen toevoegen
if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	//****************  EXAMEN TOEVOEGEN ******************//

	if(isset($_POST['submit_examen'])) {
		if (isset($_POST['vak'], $_POST['jaar'], $_POST['tijdvak'], $_POST['nterm'], $_POST['niveau'])) {
			//checken of er geen lege waarden zijn ingevoerd
			if ($_POST['vak'] == "" OR $_POST['jaar'] == "" OR $_POST['tijdvak'] == "" OR $_POST['nterm'] == "" OR $_POST['niveau'] == "") {
				$_SESSION['message'] = 'Je moet alle gegevens invullen!';
			} 
			else {
				// overbodige ingevoerde spaties weghalen met functie trim
				$vak = filter_var(trim($_POST['vak']), FILTER_SANITIZE_STRING);
				$jaar = filter_var(trim($_POST['jaar']), FILTER_SANITIZE_STRING);
				$tijdvak = filter_var(trim($_POST['tijdvak']), FILTER_SANITIZE_STRING);//tussenvoegsel mag spatie bevatten
				$nterm = filter_var(trim($_POST['nterm']), FILTER_SANITIZE_STRING);
				$niveau = filter_var(trim($_POST['niveau']), FILTER_SANITIZE_STRING);
				
				$gegevens = [ 
					$vak,
					$jaar,
					$tijdvak,
					$nterm,
					$niveau
				];

				//checken of email en afkorting uniek zijn
				if(checkIfExamExists($vak, $jaar, $tijdvak) === FALSE){
					//examen bestaat niet en kan dus worden toegevoegd
					// gegevens inserten
					addExam($gegevens);
					
				} else {
					//examen bestaat al.
					$_SESSION['message'] = 'Dit examen bestaat al.';
				}
			}
		}
	}
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Examen Analyse</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="theme-color" content="#1BBC9B">
		<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">-->
		<link rel="stylesheet" href="../assets/css/style.css" type="text/css" media="all">
		<link rel="stylesheet" href="../assets/css/dashboard.css" type="text/css" media="all">
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	</head>
	<body>
		<?php include(ROOT_PATH . "includes/partials/message.html.php"); ?>
		<div class="stickymenu">
			<div class="titlemenu">
				<div class="logoimg">
					<img src="../images/dashboard/logo_fruytier.png" alt="logo_fruytier">
					<img src="../images/dashboard/logo.png" alt="logo">
				</div>
				<div class="apptitle">
					<h1>EXAMENANALYSE</h1>
				</div>
			</div>
			<div class="usermenu">
				<div class="headicon">
					<img src="../images/dashboard/maleicon.png" alt="headicon">
				</div>
				<div class="username">
					<h3><?php $data = getUserData($_SESSION['gebruiker_id']);echo $data['voornaam']." ".$data['tussenvoegsel']." ".$data['achternaam'];?></h3>
				</div>
				<div class="settings">
					<img src="../images/dashboard/settings.png" alt="settings">
					<ul class="submenu">
						<li>
							<a href="#" class="submenuitem">Settings</a>
						</li>
						<li>
							<a href="../includes/logout.php" class="submenuitem">Uitloggen</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="sidemenu">
			<ul>
				<a href="/" class="menulink">
					<li class="menuheading">
						Dashboard
					</li>
				</a>
				<a href="#" class="menulink">
					<li class="menuitem">
						Examen
					</li>
				</a>
				<a href="#" class="menulink">
					<li class="menuitem">
						Resultaten
					</li>
				</a>
				<a href="#" class="menulink">
					<li class="menuitem">
						Score
					</li>
				</a>
			</ul>
		</div>
		<div class="contentblock">
			<div class="content">
				<h1>Voeg een examen toe</h1>
				<form action="" method="POST">
		  			Vak <input type="text" name="vak"><br>
		  			Jaar <input type="text" name="jaar"><br>
		  			Tijdvak <input type="text" name="tijdvak"><br>
		  			nTerm <input type="text" name="nterm"><br>
		  			Niveau <input type="text" name="niveau"><br>
		  			<input type="submit" name="submit_examen" value="Voeg toe">
				</form>
			</div>
		</div>
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
		<script src="<?php echo BASE_URL; ?>assets/js/alert_message.js"></script>
	</body>
</html>
