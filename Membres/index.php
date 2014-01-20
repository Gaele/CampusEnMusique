<?php

	function chargerClasse($className) {
		file_exists (dirname(dirname(__FILE__)).'/Membres/'.$className.'.class.php') &&
		require dirname(dirname(__FILE__)).'/Membres/'.$className.'.class.php';
	}
	function chargerClasseConnection($className) {
		file_exists ($className.'.class.php') &&
		require $className.'.class.php';
	}
	spl_autoload_register('chargerClasse');
	spl_autoload_register('chargerClasseConnection');
	
$errorMessage = '';
if(isset($_POST['pseudo']) && isset($_POST['pass'])) {
	if (strlen($_POST['pseudo']) > 30) {
		$errorMessage = 'Le pseudo doit etre plus petit que 30 caracteres';
	} else if (strlen($_POST['pass']) > 30) {
		$errorMessage = 'Le mot de passe doit etre plus petit que 30 caracteres';
	} else { // les donnees sont la, on peut voir si l'utilisateur est bien enregistre ou non.
		require_once(dirname(dirname(__FILE__)).'/reChapca/recaptchalib.php');
			$privatekey = "6LeBwNUSAAAAAIj2wy_NTxjzjCWAfWW6SA0P43n-";
			$resp = recaptcha_check_answer ($privatekey,
				$_SERVER["REMOTE_ADDR"],
				$_POST["recaptcha_challenge_field"],
				$_POST["recaptcha_response_field"]);
				
		if (!$resp->is_valid) { // CAPTCHA entre incorrectement
		$errorMessage = "Test anti-spam echoue";
//				"(reCAPTCHA dit: " . $resp->error . ")";
		} else {
		
			//echo 'Connection a la BD';
			include (dirname(dirname(__FILE__)).'/dbConnection.php');
			
			//$pass_hash = sha1($_POST['pass']);
			$membreManager = new MembresManager($db);
			$membre = new Membres(array('pseudo' => (string)trim(htmlspecialchars($_POST['pseudo'])), 'pass' => (string)trim(htmlspecialchars($_POST['pass']))));
			$donnees = $membreManager->connect($membre);
			
			 if(!$donnees) {
				$errorMessage = 'Mauvais identifiant ou mauvais mot de passe !';
			 } else {
				session_start();
				$_SESSION['id'] = trim(htmlspecialchars($donnees['id']));
				$_SESSION['pseudo'] = trim(htmlspecialchars($_POST['pseudo']));
				$_SESSION['type'] = trim(htmlspecialchars($donnees['type']));
				
				header('Location: ../index.php');
			 }
		}
		 // FIN DE VALIDITE
	}
}
//echo $errorMessage;

IndexVue::afficher($errorMessage);

?>




