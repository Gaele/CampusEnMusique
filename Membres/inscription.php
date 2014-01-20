<?php

	function chargerClasseConnection($className) {
		file_exists ($className.'.class.php') &&
		require $className.'.class.php';
	}
	spl_autoload_register('chargerClasseConnection');
	
$errorMessage = '';

if(isset($_POST['pseudo']) && isset($_POST['pass']) && isset($_POST['passVerif']) && isset($_POST['mail'])) {
	if (strlen($_POST['pseudo']) > 30) {
		$errorMessage = 'Erreur : Le pseudo doit etre plus petit que 30 caracteres';
	} else if (strlen($_POST['pass']) > 30) {
		$errorMessage = 'Erreur : Le mot de passe doit etre plus petit que 30 caracteres';
	} else if (strlen($_POST['mail']) > 45) {
		$errorMessage = 'Erreur : Le mail doit etre plus petit que 45 caracteres. Il en fait '.strlen($_POST['mail']);
	} else if(strlen(trim(htmlspecialchars($_POST['pseudo']))) == 0) {
		$errorMessage = 'Erreur : la taille du pseudo ne peut être nulle';
	} else if(strlen(trim(htmlspecialchars($_POST['pass']))) == 0) {
		$errorMessage = 'Erreur : la taille du mot de passe ne peut être nulle';
	} else if(trim(htmlspecialchars($_POST['pass'])) != trim(htmlspecialchars($_POST['passVerif']))) {
		$errorMessage = 'Erreur lors de la confirmation du mot de passe';
	} else { // les donnees sont la, on peut voir si l'utilisateur est bien enregistre ou non.
		
		require_once(dirname(dirname(__FILE__)).'/reChapca/recaptchalib.php');
			$privatekey = "6LeBwNUSAAAAAIj2wy_NTxjzjCWAfWW6SA0P43n-";
			$resp = recaptcha_check_answer ($privatekey,
				$_SERVER["REMOTE_ADDR"],
				$_POST["recaptcha_challenge_field"],
				$_POST["recaptcha_response_field"]);
				
				
		if (!$resp->is_valid) {
		// CAPTCHA entre incorrectement
		$errorMessage = "Test anti-spam echoue";
//				"(reCAPTCHA dit: " . $resp->error . ")";
		} else {
			//echo 'Connection a la BD';
			include (dirname(dirname(__FILE__)).'/dbConnection.php');
			
			//$pass_hash = sha1($_POST['pass']);
			$membreManager = new MembresManager($db);
			
			// Si le pseudo n'existe pas
			if(!$membreManager->containPseudo(trim(htmlspecialchars($_POST['pseudo'])))) {
				$membre = new Membres(array(
				'pseudo' => (string)trim(htmlspecialchars($_POST['pseudo'])), 
				'pass' => (string)trim(htmlspecialchars($_POST['pass'])),
				'mail' => (string)trim(htmlspecialchars($_POST['mail'])),
				'type' => 1));
				
				$membreManager->add($membre);
				
				$donnees = $membreManager->connect($membre);
				
				if(!$donnees) {
					$errorMessage = 'Erreur lors de l\'enregistrement';
				} else {
					session_start();
					$_SESSION['id'] = trim(htmlspecialchars($donnees['id']));
					$_SESSION['pseudo'] = trim(htmlspecialchars($_POST['pseudo']));
					$_SESSION['type'] = trim(htmlspecialchars($donnees['type']));
					
					header('Location: ../index.php');
				}
			} else {
				$errorMessage = 'Identifiant déjà réservé';
			}
		}
	}
}
//echo $errorMessage;

InscriptionVue::afficher($errorMessage);

?>

