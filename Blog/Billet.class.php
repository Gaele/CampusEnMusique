<?php
	class Billet {
		
		private $_contenu;
		private $_titre;
		private $_auteur;
		private $_id;
		private $_date_creation;
		
		public function __construct(array $donnees) {
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
		
		public function titre() {
			return $this->_titre;
		}
		
		public function auteur() {
			return $this->_auteur;
		}
		
		public function contenu() {
			return $this->_contenu;
		}
		
		public function id() {
			return $this->_id;
		}
		
		public function date_creation() {
			return $this->_date_creation;
		}
		
		public function setTitre($titre) {
			if(strlen($titre) >= 255) { // On verifie que la taille de la chaine soit raisonnable
				trigger_error('Le titre est trop long', E_USER_WARNING);
				return;
			}
			$this->_titre = (string)$titre;
		}
		
		public function setAuteur($auteur) {
			if(strlen($auteur) >= 255) { // On verifie que la taille de la chaine soit raisonnable
				trigger_error('Le pseudonyme est trop long', E_USER_WARNING);
				return;
			}
			$this->_auteur = (string)$auteur;
		}
		
		public function setContenu($contenu) {
			if(strlen($contenu) >= 2048) { // On verifie que la taille de la chaine soit raisonnable
				trigger_error('Le message est trop long', E_USER_WARNING);
				return;
			}
			$this->_contenu = $contenu;
		}
		
		public function setId($id) {
			if(!is_numeric($id)) {
				trigger_error('id pas un nombre', E_USER_WARNING);
				return;
			}
			$this->_id = (int)$id;
		}
		
		public function setDate_creation($date_creation) {
			if(date('Y-m-d H:i:s', strtotime($date_creation)) == $date_creation) {
				$this->_date_creation = $date_creation;
			} else {
				echo 'erreur : date incorrecte';
				echo $date_creation;
				echo '<br/>';
			}
		}
		
		// retourne la date formatee pour les humains (le ... a ...)
		public function formatedDate() {
			if(date('Y-m-d H:i:s', strtotime($this->_date_creation)) == $this->_date_creation) { // La date est dans le bon format
				$DateAFormater = explode(' ', $this->date_creation()); // contient {'AAAA-MM-JJ', 'HH-II-SS'}
				$calendar = explode('-', $DateAFormater[0]); // contient {'AAAA', 'MM', 'JJ'}
				$clock = explode(':', $DateAFormater[1]); // contient {'HH', 'II', 'SS'}
				
				return 'Le '.$calendar[2].'/'.$calendar[1].'/'.$calendar[0];//.' a '.$clock[0].'h'.$clock[1].'min'.$clock[2].'s';
			} else { // La date n'a pas le bon format
				echo 'erreur : date incorrecte';
				echo $this->_date_creation;
				echo '<br/>';
				return null;
			}
		}
		
	}
	
	// tests
/*	$billet = new Billet(array('titre' => 'Titre', 'Contenu' => 'Le contenu'));
	$billet->setTitre('titre');
	
	echo $billet->titre();
	*/
	
?>

