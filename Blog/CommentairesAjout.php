<?php

	$errorMessage = '';

	// chargeur de classe
	function chargerClasse($className) {
		require $className.'.class.php';
	}
	spl_autoload_register('chargerClasse');

	// verifie la presence de l'id du billet
	if(!isset($_GET['billet']) || !is_numeric($_GET['billet']) || ($_GET['billet'] < 1)) {
		//$errorMessage = 'Aucun billet associé a ce commentaire. Retournez au forum';
		require_once dirname(dirname(__FILE__)).'/Erreur.class.php';
		Erreur::afficher('Aucun billet associé a ce commentaire. Retournez au forum');
	} else {
		
		//Connection a la base de donnee
		include (dirname(dirname(__FILE__)).'/dbConnection.php');
	
		$billetManager = new BilletManager($db);
		$relevant = $billetManager->get((int)$_GET['billet']);
		if(($relevant->id()) == '') {
			header('Location: BlogCommentaires.php?billet=0');
		}
	
		//if(isset($_POST['lien']) && $_POST['lien'] == null) echo "lien is null";//////////////////////////////
	
		// Si aucun formulaire n'a ete envoye, il faut en replir un.
		if(isset($_POST['pseudo']) && isset($_POST['message'])) {
			if(trim($_POST['pseudo']) == '' || trim($_POST['message']) == '') {
				$errorMessage = 'Formulaire incomplet';
			} else if(strlen($_POST['pseudo']) > 50) {
				$errorMessage = 'Le pseudonyme doit comporter mois de 50 caracteres';
			}else if(trim($_POST['pseudo']) == 'Campus en Musique') {
				$errorMessage = 'Le pseudonyme \'Campus en Musique\' est reservé';
			} else if(strlen($_POST['message']) > 2048) {
				$errorMessage = 'Le commentaire doit comporter moins de 2048 caracteres';
			} else if(strlen($_POST['message']) > 512) {
				$errorMessage = 'Le lien doit comporter moins de 512 caracteres';
			} else if(isset($_POST['lien']) && strlen($_POST['lien']) > 512) {
				$errorMessage = 'Le lien doit comporter moins de 512 caracteres';
			} else if(isset($_POST['lien']) && $_POST['lien'] != null &&
			(strpos($_POST['lien'], 'http://www.youtube.com') === false || strpos($_POST['lien'], 'http://www.youtube.com') != 0) && 
			(strrpos($_POST['lien'], ".gif") === false || strrpos($_POST['lien'], ".gif") != strlen($_POST['lien'])-4) &&
			(strrpos($_POST['lien'], ".jpg") === false || strrpos($_POST['lien'], ".jpg") != strlen($_POST['lien'])-4) &&
			(strrpos($_POST['lien'], ".png") === false || strrpos($_POST['lien'], ".png") != strlen($_POST['lien'])-4)) {
				$errorMessage = 'Le lien doit etre l\'adresse d\'une image jpg, png ou gif, ou l\'adresse d\'une video youtube';
			} else {//donnees verifiees sauf reChapca
			
				require_once(dirname(dirname(__FILE__)).'/reChapca/recaptchalib.php');
				$privatekey = "6LeBwNUSAAAAAIj2wy_NTxjzjCWAfWW6SA0P43n-";
				$resp = recaptcha_check_answer ($privatekey,
											$_SERVER["REMOTE_ADDR"],
											$_POST["recaptcha_challenge_field"],
											$_POST["recaptcha_response_field"]);

				if (!$resp->is_valid) {
					// CAPTCHA entre incorrectement
					$errorMessage = "Test anti-spam echoue";
//						"(reCAPTCHA dit: " . $resp->error . ")";
					} else {
					// On ajoute le commentaire
					/*if(isset($_POST['lien']) && $_POST['lien'] != null &&
					!(strpos($_POST['lien'], 'http://www.youtube.com') === false) && strpos($_POST['lien'], 'http://www.youtube.com') == 0) {
						$lien = strstr($_POST['lien'], 'watch', true);// Recupere jusqu'avant le watch exclu
						$fin = strstr($_POST['lien'], '?', false);// Recupere apres le ?, ? inclu
						$fin = substr($fin, 1); // retire le ? de $fin => On obtient une chaine du genre chaine1&chaine2. Or seul l'option 'v' est lisible pour nous !
						
						$tok = strtok($fin, "&");
						while ($tok !== false) { // On cherche donc l'option v, et on la rajoute a notre chaine en remplacant 'v=' par 'embed/'
							if(!(strpos($tok, "v") === false) && strpos($tok, "v") == 0) {
								$lien = $lien.str_replace('v=', 'embed/', $tok);;
								break;
							}
							$tok = strtok("&");
						}
						
					} else */if(isset($_POST['lien'])) {
						$lien = (string)$_POST['lien'];
					} else {
						$lien = null;
					}
					
					$donnees = array(
						'id_billet' => (int)$_GET['billet'],
						'auteur' => (string)$_POST['pseudo'],
						'commentaire' => (string)$_POST['message'],
						'lien' => $lien
					);
					
					$commentaire = new Commentaire($donnees);
					
					$commentaireManager = new CommentaireManager($db);
					$commentaireManager->add($commentaire);
					
					header('Location: BlogCommentaires.php?billet='.((int)$_GET['billet']));
				}
			} // fin else donnees verifiees sauf Rechapca
		}// Le formulaire n'a pas encore ete remplit ou est incorrect
		CommentaireAjoutVue::afficher($errorMessage);
	}
	
	//echo 'Sortie de secours : '.$errorMessage;
	
?>

