<?php
	class GallerieImage {
		
		private $_id;
		private $_idProprietaire;
		private $_urlImage;
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
		
		public function urlImage() {
			return $this->_urlImage;
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
		
		public function setUrlImage($url) {
			if(strlen($url) > 255) {
				trigger_error('url trop long', E_USER_WARNING);
				return;
			}
			$this->_urlImage = (string)$url;
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
				
				return $calendar[2].'/'.$calendar[1].'/'.$calendar[0];
			} else { // La date n'a pas le bon format
				trigger_error('erreur : date incorrecte', E_USER_WARNING);
				return null;
			}
		}
	}
	
	// tests
	//$image = new GallerieImage(array('id' => 4, 'idProprietaire' => 1, 'urlImage' => 'http://www.lory.fr', 'date_parution' => '2012-12-16 05:03:58'));
	
	//$image->setId(12);
	//$image->setIdProprietaire(13);
	//$image->setUrlImage('nouveau mail');
	//$image->setDate_parution('2012-10-16 07:06:58');
	
	//echo $image->id().'<br/>';
	//echo $image->idProprietaire().'<br/>';
	//echo $image->urlImage().'<br/>';
	//echo $image->date_parution().'<br/>';
	
?>

