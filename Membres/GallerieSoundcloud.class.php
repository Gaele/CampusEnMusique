<?php
	class GallerieSoundcloud {
		
		private $_id;
		private $_idProprietaire;
		private $_urlSoundcloud;
		private $_date_parution;
		// private $_commentaire
		
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
		
		public function idProprietaire() {
			return $this->_idProprietaire;
		}
		
		public function urlSoundcloud() {
			return $this->_urlSoundcloud;
		}
		
		public function date_parution() {
			return $this->_date_parution;
		}
		
		public function setId($id) {
			if(!is_numeric($id)) {
				trigger_error('l\'id n\'est pas un entier', E_USER_WARNING);
				return;
			}
			$this->_id = (int)$id;
		}
		
		public function setIdProprietaire($proprio) {
			if(!is_numeric($proprio)) {
				trigger_error('l\'id du proprietaire n\'est pas un entier', E_USER_WARNING);
				return;
			}
			$this->_idProprietaire = (int)$proprio;
		}
		
		public function setUrlSoundcloud($url) {		
			if(strpos($url, 'https://w.soundcloud.com/player/') != 0 && !(strpos($url,'https://w.soundcloud.com/player/',true) === false )) {	
					$x = strstr($url,'https://w.soundcloud.com/player/');
					$y = strstr($x,'"',true);
					$this->_urlSoundcloud = $y;	
			}
			else {
				$this->_urlSoundcloud = (string)$url;
			}
		}
		
		public function setDate_parution($date_parution) {
			if(date('Y-m-d H:i:s', strtotime($date_parution)) == $date_parution) {
				$this->_date_parution = $date_parution;
			} else {
				trigger_error('erreur : date incorrecte', E_USER_WARNING);
			}
		}
		
		// retourne la date formatee pour les humains (le ... a ...)
		public function formatedDate() {
			if(date('Y-m-d H:i:s', strtotime($this->_date_parution)) == $this->_date_parution) { // La date est dans le bon format
				$DateAFormater = explode(' ', $this->date_parution()); // contient {'AAAA-MM-JJ', 'HH:II:SS'}
				$calendar = explode('-', $DateAFormater[0]); // contient {'AAAA', 'MM', 'JJ'}
				$clock = explode(':', $DateAFormater[1]); // contient {'HH', 'II', 'SS'}
				
				return 'Le '.$calendar[0].'/'.$calendar[1].'/'.$calendar[2].' a '.$clock[0].'h'.$clock[1].'min'.$clock[2].'s';
			} else { // La date n'a pas le bon format
				trigger_error('erreur : date incorrecte', E_USER_WARNING);
				return null;
			}
		}
	}
	
	
	
?>
