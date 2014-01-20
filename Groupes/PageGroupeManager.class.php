<?php

	class pagegroupeManager {
		private $_db;
		
		public function __construct($db) {
			$this->setDb($db);
		}
		
		// ajoute une nouvelle page de groupe dans la base reliee a l'id du proprietaire
		public function add($id_proprietaire) { // ok
			
			// verifie que les donnees sont presentes.
			if (!is_numeric($id_proprietaire)) {
				trigger_error('type manquant', E_USER_WARNING);
				return;
			} else if ($id_proprietaire < 0) { // 0 -> seul le webmaster peut y toucher
				trigger_error('id proprietaire image < 0', E_USER_WARNING);
				return;
			}
			
			// a modifier pour inclure l'effectif, les images et videos.
			$q = $this->_db->prepare('INSERT INTO pagegroupe (idProprietaire, imagePresentation, historique, projets, mail, site, telephone) VALUES (:idProprietaire, \'\', \'\', \'\', \'\', \'\', \'\')');
			$q->bindValue('idProprietaire', $id_proprietaire, PDO::PARAM_INT);
			$q->execute();
		}
		
		// compte le nombre de page dans la base de donnee
		public function count() { // ok
			return $this->_db->query('SELECT COUNT(*) FROM pagegroupe')->fetchColumn();
		}
		
		// supprime une page de la base
		public function delete($page) { // ok
			if(is_int($page)) {
				$q = $this->_db->prepare('DELETE FROM pagegroupe WHERE idProprietaire = :id');
				$q->bindValue(':id', $page, PDO::PARAM_INT);
				$q->execute();
			} else if ($page instanceof GroupPage) {
				$q = $this->_db->prepare('DELETE FROM pagegroupe WHERE idProprietaire = :id');
				$q->bindValue(':id', $membres->id(), PDO::PARAM_INT);
				$q->execute();
			} else {
				trigger_error('Erreur, l\identifiant d\'un membres doit etre un entier', E_USER_WARNING);
			}
		}
		
		// retourne la page avec l'id $id
		public function get($id) {// ok
			if(!is_int($id)) {
				trigger_error('Erreur de chargement du membres du forum, l\'id doit etre un entier', E_USER_WARNING);
				return;
			}
			$donnees = array();
			$q = $this->_db->prepare('SELECT idProprietaire, imagePresentation, historique, projets, mail, site, telephone FROM pagegroupe WHERE idProprietaire = :id');
			$q->bindValue(':id', $id, PDO::PARAM_INT);
			$q->execute();
			$donnees[] = $q->fetch(PDO::FETCH_ASSOC);
			
			if(empty($donnees[0])) {
				return new PageGroupe(array('id' => 0));
			} else {
				return new PageGroupe($donnees[0]);
			}
		}
		
		// retourne la liste des membres, du numero $debut au numero $fin
		public function getList($debut, $fin) { // ok
			if(!is_int($debut) || !is_int($fin)) {
				trigger_error('Erreur de chargement des page des l\'espace perso.', E_USER_WARNING);
				return;
			}
			
			$pages = array();
			$q = $this->_db->prepare('SELECT idProprietaire, imagePresentation, historique, projets, mail, site, telephone FROM pagegroupe ORDER BY idProprietaire LIMIT :debut, :fin');
			$q->bindValue(':debut', $debut, PDO::PARAM_INT);
			$q->bindValue(':fin', $fin, PDO::PARAM_INT);
			$q->execute();
			
			while($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$pages[] = new PageGroupe($donnees);
			}
			$q->closeCursor();
			return $pages;
		}
		
		// Met a jour le membres membres
		public function update(PageGroupe $page) { // ok
			
			// On stocke les valeurs dans des variables car on ne peut pas extraire des donnees aux objets dans les structures conditionnelles
			$imagePresentation = $page->imagePresentation();
			$historique = $page->historique();
			$projets = $page->projets();
			$mail = $page->mail();
			$site = $page->site();
			$telephone = $page->telephone();
			
			$insertionRequete = '';
			// On cree une chaine qui va nous servir a updater les champs qui sont defini dans l'objet
			if(!empty($imagePresentation))
				$insertionRequete .= ' imagePresentation = :imagePresentation,';
			if(!empty($historique))
				$insertionRequete .= ' historique = :historique,';
			if(!empty($projets))
				$insertionRequete .= ' projets = :projets,';
			if(!empty($mail))
				$insertionRequete .= ' mail = :mail,';
			if(!empty($site))
				$insertionRequete .= ' site = :site,';
			if(!empty($telephone))
				$insertionRequete .= ' telephone = :telephone,';
			if(!empty($insertionRequete)) // Si la chaine n'est pas nulle, on retire la derniere virgule
				$insertionRequete = substr($insertionRequete, 0, -1);
			
			$q = $this->_db->prepare('UPDATE pagegroupe SET'.$insertionRequete.' WHERE idProprietaire = :id');
			// Enfin, on fait toutes les liaisons.
			$q->bindValue(':id', $page->idProprietaire(), PDO::PARAM_INT);
			if(!empty($imagePresentation))
				$q->bindValue(':imagePresentation', $imagePresentation);
			if(!empty($historique))
				$q->bindValue(':historique', $historique);
			if(!empty($projets))
				$q->bindValue(':projets', $projets);
			if(!empty($mail))
				$q->bindValue(':mail', $mail);
			if(!empty($site))
				$q->bindValue(':site', $site);
			if(!empty($telephone))
				$q->bindValue(':telephone', $telephone);
			$q->execute();
		}
		
		public function setDb(PDO $db) {
			$this->_db = $db;
		}
	}
	
	// try {
		// $db = new PDO('mysql:host=localhost;dbname=miniblog', 'root', '');
	// } catch(Exception $e) {
		// die('Erreur: '.$e->getMessage());
	// }
	
	// $mm = new pagegroupeManager($db);
	// require 'pagegroupe.class.php';
	// $page = new pagegroupe(array('idProprietaire' => 1, 'historique' => 'historique2', 'mail' => 'heloise@internet.net',
	// 'projets' => 'Mes projets 2', 'site' => 'ILovePop.com', 'telephone' => '01-69-31-45-84'));
	
	//$mm->update($page);
	
	// $donnees = $mm->getList(0, 10);
	// foreach($donnees as $key => $page) {
		// echo $key.' '.$page->mail().'<br/>';
	// }
	
?>
