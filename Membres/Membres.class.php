<?php
	class Membres {
		
		private $_id;
		private $_pseudo;
		private $_pass;
		private $_mail;
		private $_type;
		private $_date_inscription;
		
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
		
		public function id() {
			return $this->_id;
		}
		
		public function pseudo() {
			return $this->_pseudo;
		}
		
		public function pass() {
			return $this->_pass;
		}
		
		public function mail() {
			return $this->_mail;
		}
		
		public function type() {
			return $this->_type;
		}
		
		public function date_inscription() {
			return $this->_date_inscription;
		}
		
		public function setId($id) {
			if(!is_numeric($id)) {
				trigger_error('l\'id n\'est pas un entier', E_USER_WARNING);
				return;
			}
			$this->_id = (int)$id;
		}
		
		public function setPseudo($pseudo) {
			if(strlen($pseudo) >= 255) { // On verifie que la taille de la chaine soit raisonnable
				trigger_error('Le pseudonyme est trop long', E_USER_WARNING);
				return;
			} else if (strlen(trim($pseudo)) == 0) {
				trigger_error('Le pseudonyme est null', E_USER_WARNING);
				return;
			}
			$this->_pseudo = (string)$pseudo;
		}
		
		public function setPass($pass) {
			if(strlen($pass) >= 255) { // On verifie que la taille de la chaine soit raisonnable
				trigger_error('Le pass est trop long', E_USER_WARNING);
				return;
			} else if (strlen(trim($pass)) == 0) {
				trigger_error('Le pass est null', E_USER_WARNING);
				return;
			}
			$this->_pass = (string)$pass;
		}
		
		public function setMail($mail) {
			if(strlen($mail) >= 255) { // On verifie que la taille de la chaine soit raisonnable
				trigger_error('Le mail est trop long', E_USER_WARNING);
				return;
			} else if (strlen(trim($mail)) == 0) {
				trigger_error('Le mail est null', E_USER_WARNING);
				return;
			}
			$this->_mail = (string)$mail;
		}
		
		public function setType($type) {
			if(!is_numeric($type)) {
				trigger_error('le type n\'est pas un entier', E_USER_WARNING);
				return;
			} else if (strlen(trim($type)) == 0) {
				trigger_error('Le type est null', E_USER_WARNING);
				return;
			}
			$this->_type = (int)$type;
		}
		
		public function setDate_inscription($date_inscription) {
			$this->_date_inscription = $date_inscription;
		}
		
		// retourne la date formatee pour les humains (le ... a ...)
		public function formatedDate() {
			$calendar = explode('-', $this->_date_inscription); // contient {'AAAA', 'MM', 'JJ'}
			return 'Le '.$calendar[0].'/'.$calendar[1].'/'.$calendar[2];
		}
		
	}
	
	// tests
	//$membre = new Membres(array('pass' => 'mon pass', 'type' => 0, 'pseudo' => 'mon pseudo', 'mail' => 'vincent@internet.net'));
	//$membre->setPseudo('nouveau pseudo');
	//$membre->setPass('nouveau pass');
	//$membre->setMail('nouveau mail');
	//$membre->setType(1);
	
	//echo $membre->pseudo().'<br/>';
	//echo $membre->pass().'<br/>';
	//echo $membre->mail().'<br/>';
	//echo $membre->type();
	
	
	
?>

