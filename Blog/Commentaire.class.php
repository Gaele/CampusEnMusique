<?php
	class Commentaire {
		
		private $_id;
		private $_id_billet;
		private $_auteur;
		private $_commentaire;
		private $_date_commentaire;
		private $_lien;
		
		public function __construct(array $donnees) {
//			foreach($donnees as $key => $value) {
//				echo 'Key : '.$key.', valeur : '.$value;
//			}
		
			$this->hydrate($donnees);
		}
		
		public function hydrate(array $donnees) {
			foreach($donnees as $key => $value) {
				$method = 'set'.ucfirst($key);
				if(method_exists($this, $method)) {
					$this->$method($value);
				}
			}
		}
		
		public function id() {
			return $this->_id;
		}
		
		public function id_billet() {
			//echo 'setId_billet';
			return $this->_id_billet;
		}
		
		public function auteur() {
			//echo 'setAuteur';
			return $this->_auteur;
		}
		
		public function commentaire() {
			//echo 'setACommentaire';
			return $this->_commentaire;
		}
		
		
		public function date_commentaire() {
			return $this->_date_commentaire;
		}
		
		public function lien() {
			return $this->_lien;
		}
		
		public function setId($id) {
			if(!is_numeric($id)) {
				trigger_error('L\'identifiant doit etre un entier', E_USER_WARNING);
				return;
			}
			$this->_id = (int)$id;
		}
		
		public function setId_billet($id_billet) {
			if(!is_numeric($id_billet)) { // il faut que l'id du billet lie au commentaire soit un nombre
				trigger_error('L\'id du billet doit etre numerique', E_USER_WARNING);
				return;
			}
			$this->_id_billet = (int)$id_billet;
		}
		
		public function setAuteur($auteur) {
			if(strlen($auteur) >= 255) { // On verifie que la taille de la chaine soit raisonnable
				trigger_error('Le pseudonyme est trop long', E_USER_WARNING);
				return;
			}
			$this->_auteur = (string)$auteur;
		}
		
		public function setCommentaire($commentaire) {
			if(strlen($commentaire) >= 2048) { // On verifie que la taille de la chaine soit raisonnable
				trigger_error('Le commentaire est trop long', E_USER_WARNING);
				return;
			}
			$this->_commentaire = $commentaire;
		}
		
		public function setDate_commentaire($date_commentaire) {
			if(date('Y-m-d H:i:s', strtotime($date_commentaire)) == $date_commentaire) {
				$this->_date_commentaire = $date_commentaire;
			} else {
				echo 'erreur : date incorrecte';
				echo $date_commentaire;
				echo '<br/>';
			}
		}
		
		public function setLien($lien) {
		
			if($lien == null) { // Si le lien est null, on l'enregistre
				$this->_lien = $lien;
				return;
			}
		
			if(strlen($lien) >= 512) { // On verifie que la taille de la chaine soit raisonnable
				trigger_error('Le lien est trop long', E_USER_WARNING);
				return;
			} else if(!(strpos($lien, 'http://www.youtube.com') === false) && strpos($lien, 'http://www.youtube.com') == 0) { // video youtube
				if(!(strstr($lien, 'watch', true) === false)) { // si l'url contient le mot watch, elle n'est pas de la bonne forme
					$url = strstr($lien, 'watch', true);// Recupere jusqu'avant le watch exclu
					$fin = strstr($lien, '?', false);// Recupere apres le ?, ? inclu
					$fin = substr($fin, 1); // retire le ? de $fin => On obtient une chaine du genre chaine1&chaine2. Or seul l'option 'v' est lisible pour nous !
					
					$tok = strtok($fin, "&");
					while ($tok !== false) { // On cherche donc l'option v, et on la rajoute a notre chaine en remplacant 'v=' par 'embed/'
						if(!(strpos($tok, "v") === false) && strpos($tok, "v") == 0) {
							$url = $url.str_replace('v=', 'embed/', $tok);
							break;
						}
						$tok = strtok("&");
					}
					$this->_lien = $url;
				} else {
					$this->_lien = $lien;
				}
			}
			else if((!(strrpos($lien, ".gif") === false) && strrpos($lien, ".gif") == strlen($lien)-4)) {
				$this->_lien = $lien;
			} else if((!(strrpos($lien, ".jpg") === false) && strrpos($lien, ".jpg") == strlen($lien)-4)) {
				$this->_lien = $lien;
			} else if((!(strrpos($lien, ".png") === false) && strrpos($lien, ".png") == strlen($lien)-4)) {
				$this->_lien = $lien;
			} else {
				//trigger_error('Le lien n\'est ni une image, ni une video', E_USER_WARNING);
				$this->_lien = null;
			}
			
		}
		
		public function estImage() {
			if(strrpos($_lien, ".gif") == strlen($_lien)-4) {
				return true;
			} else if(strrpos($_lien, ".jpg") == strlen($_lien)-4) {
				return true;
			} else if(strrpos($_lien, ".png") == strlen($_lien)-4) {
				return true;
			} else {
				return false;
			}
		}
		
		public function estVideo() {
			if(strpos($_lien, 'http://www.youtube.com') == 0) { // video youtube
				return true;
			} else {
				return false;
			}
		}
		
		// retourne la date formatee pour les humains (le ... a ...)
		public function formatedDate() {
			if(date('Y-m-d H:i:s', strtotime($this->_date_commentaire)) == $this->_date_commentaire) { // La date est dans le bon format
				$DateAFormater = explode(' ', $this->date_commentaire()); // contient {'AAAA-MM-JJ', 'HH-II-SS'}
				$calendar = explode('-', $DateAFormater[0]); // contient {'AAAA', 'MM', 'JJ'}
				$clock = explode(':', $DateAFormater[1]); // contient {'HH', 'II', 'SS'}
				
				return 'Le '.$calendar[2].'/'.$calendar[1].'/'.$calendar[0];//.' a '.$clock[0].'h'.$clock[1].'min'.$clock[2].'s';
			} else { // La date n'a pas le bon format
				echo 'erreur : date incorrecte';
				echo $this->_date_commentaire;
				echo '<br/>';
				return null;
			}
			
		}
		
	}
	
	// tests
/*	$billet = new Billet(array('titre' => 'Titre', 'commentaire' => 'Le commentaire'));
	$billet->setTitre('titre');
	
	echo $billet->titre();
	*/
	
?>

