<?php
	class PageGroupe {
		
		private $_idProprietaire;
		private $_imagePresentation;
		private $_historique;
		private $_projets;
		private $_mail;
		private $_site;
		private $_telephone;
		
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
		
		
		public function idProprietaire() {
			return $this->_idProprietaire;
		}
		
		public function imagePresentation() {
			return $this->_imagePresentation;
		}
		
		
		public function historique() {
			return $this->_historique;
		}
		
		public function projets() {
			return $this->_projets;
		}
		
		public function mail() {
			return $this->_mail;
		}
		
		public function site() {
			return $this->_site;
		}
		
		public function telephone() {
			return $this->_telephone;
		}
		
		
		public function setIdProprietaire($idProp) {
			if(!is_numeric($idProp)) {
				trigger_error('l\'id n\'est pas un entier', E_USER_WARNING);
				return;
			} else if ($idProp < 0) {
				trigger_error('l\'id est plus petit que 0', E_USER_WARNING);
				return;
			}
			$this->_idProprietaire = (int)$idProp;
		}
		
		public function setImagePresentation($imagePresentation) {
			if(strlen($imagePresentation) >= 255) { // On verifie que la taille de la chaine soit raisonnable
				trigger_error('Le pseudonyme est trop long', E_USER_WARNING);
				return;
			}
			$this->_imagePresentation = (string)$imagePresentation;
		}
		
		
		public function setHistorique($historique) {
			if(strlen($historique) >= 2048) { // On verifie que la taille de la chaine soit raisonnable
				trigger_error('Le l\'historique est trop long', E_USER_WARNING);
				return;
			}
			$this->_historique = (string)$historique;
		}
		
		public function setProjets($projets) {
			if(strlen($projets) >= 2048) { // On verifie que la taille de la chaine soit raisonnable
				trigger_error('Les projets sont trop long', E_USER_WARNING);
				return;
			}
			$this->_projets = (string)$projets;
		}
		
		public function setMail($mail) {
			if(strlen($mail) >= 255) { // On verifie que la taille de la chaine soit raisonnable
				trigger_error('Le mail est trop long', E_USER_WARNING);
				return;
			}
			$this->_mail = (string)$mail;
		}
		
		public function setSite($site) {
			if(strlen($site) >= 255) { // On verifie que la taille de la chaine soit raisonnable
				trigger_error('Le site est trop long', E_USER_WARNING);
				return;
			}
			$this->_site = (string)$site;
		}
		
		public function setTelephone($telephone) {
			if(strlen($telephone) >= 255) { // On verifie que la taille de la chaine soit raisonnable
				trigger_error('Le telephone est trop long', E_USER_WARNING);
				return;
			}
			$this->_telephone = $telephone;
		}
		
		
	}
	
	// tests
	//$page = new PageGroupe(array('id' => 33, 'imagePresentation' => 1, 'idEffectif' => 0, 'historique' => 'mon historique', 'mail' => 'vincent@internet.net',
	//	'projets' => 'Mes projets', 'idPhotos' => 11, 'idVideo' => 13, 'site' => 'ILoveRock.com', 'telephone' => '01-69-31-45-24'));
	//$membre->setPseudo('nouveau pseudo');
	//$membre->setPass('nouveau pass');
	//$membre->setMail('nouveau mail');
	//$membre->setType(1);
	
	//echo $page->idEffectif().'<br/>';
	//echo $page->telephone().'<br/>';
	//echo $membre->mail().'<br/>';
	//echo $membre->type();
	
?>

