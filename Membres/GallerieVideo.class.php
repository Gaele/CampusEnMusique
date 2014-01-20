<?php
	class GallerieVideo {
		
		private $_id;
		private $_idProprietaire;
		private $_urlVideo;
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
		
		public function urlVideo() {
			return $this->_urlVideo;
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
		
		public function setUrlVideo($url) {
			if(strlen($url) > 255) {
				trigger_error('url trop long', E_USER_WARNING);
				return;
			}
			//$url = htmlspecialchars($url); // securite inutile
			
			if(!(strstr($url, 'watch', true) === false)) { // si l'url contient le mot watch, elle n'est pas de la bonne forme
			
				$lien = strstr($url, 'watch', true);// Recupere jusqu'avant le watch exclu
				$fin = strstr($url, '?', false);// Recupere apres le ?, ? inclu
				$fin = substr($fin, 1); // retire le ? de $fin => On obtient une chaine du genre chaine1&chaine2. Or seul l'option 'v' est lisible pour nous !
				
				$tok = strtok($fin, "&");
				while ($tok !== false) { // On cherche donc l'option v, et on la rajoute a notre chaine en remplacant 'v=' par 'embed/'
					if(!(strpos($tok, "v") === false) && strpos($tok, "v") == 0) {
						$lien = $lien.str_replace('v=', 'embed/', $tok);
						break;
					}
					$tok = strtok("&");
				}
				$this->_urlVideo = $lien;
			} else {
				$this->_urlVideo = (string)$url;
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
	
	// tests
	// $image = new GallerieVideo(array('id' => 4, 'idProprietaire' => 1, 'urlVideo' => 'http://www.youtube.com/watch?v=9i-6HeQBbwU', 'date_parution' => '2012-12-16 05:03:58'));
	
	// $image->setId(12);
	// $image->setIdProprietaire(13);
	// $image->seturlVideo('nouveau mail');
	// $image->setDate_parution('2012-10-16 07:06:58');
	
	// echo $image->id().'<br/>';
	// echo $image->idProprietaire().'<br/>';
	// echo $image->urlVideo().'<br/>';
	// echo $image->date_parution().'<br/>';
	
?>

