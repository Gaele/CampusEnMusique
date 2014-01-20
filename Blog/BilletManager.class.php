<?php

	class BilletManager {
		private $_db;
		public function __construct($db) {
			$this->setDb($db);
			//require 'billet.class.php';
		}

		// ajoute un billet dans la base
		public function add(Billet $billet) {
			
			// verifie que les donnees sont presentes.
			$titre = $billet->titre();
			$contenu = $billet->contenu();
			$auteur = $billet->auteur();
			if(empty($titre) || empty($contenu) || empty($auteur)) {
				trigger_error('Certaines donnees necessaire sont manquantes', E_USER_WARNING);
				return;
			}
			
			$q = $this->_db->prepare('INSERT INTO billets (id, titre, contenu, date_creation, auteur) VALUES (\'\', :titre, :contenu, NOW(), :auteur)');
			
			$q->bindValue(':titre', $billet->titre());
			$q->bindValue(':contenu', $billet->contenu());
			$q->bindValue(':auteur', $billet->auteur());
			
			$q->execute();
//			$perso->hydrate(array(
//				'id' => $this->db->lastInsertId(),
//			));
			
		}
		
		// compte le nombre de billets dans la base de donnee
		public function count() {
			return $this->_db->query('SELECT COUNT(*) FROM billets')->fetchColumn();
		}
		
		// supprime un billet de la base
		public function delete($billet) {
			if(is_int($billet)) {
				$q = $this->_db->prepare('DELETE FROM billets WHERE id = :id');
				$q->bindValue(':id', $billet, PDO::PARAM_INT);
				$q->execute();
			} else if ($billet instanceof Billet && is_int($billet->id())) {
				$q = $this->_db->prepare('DELETE FROM billets WHERE id = :id');
				$q->bindValue(':id', $billet->id(), PDO::PARAM_INT);
				$q->execute();
			} else {
				trigger_error('Erreur, l\identifiant d\'un billet doit etre un entier', E_USER_WARNING);
			}
		}
		
		// retourne le billet avec l'id $id
		public function get($id) {
			if(!is_int($id)) {
				trigger_error('Erreur de chargement du billet du forum, l\'id doit etre un entier', E_USER_WARNING);
				return;
			}
			$donnees = array();
			$q = $this->_db->prepare('SELECT id, titre, contenu, date_creation, auteur FROM billets WHERE id = :id');
			$q->bindValue(':id', $id, PDO::PARAM_INT);
			$q->execute();
			$donnees[] = $q->fetch(PDO::FETCH_ASSOC);
			$q->closeCursor();
			
			if(empty($donnees[0])) {
				return new Billet(array('id' => 0));
			} else {
				return new Billet($donnees[0]);
			}
			
		}
		
		// retourne la list des billets, du numero $debut au numero $fin
		public function getList($debut, $fin) {
			if(!is_int($debut) || !is_int($fin)) {
				trigger_error('Erreur de chargement des billets du forum. Veuillez reporter ce bug a campusenmusic@gmail.com', E_USER_WARNING);
				return;
			}
			
			$billets = array();
			$q = $this->_db->prepare('SELECT id, titre, contenu, auteur, date_creation FROM billets ORDER BY date_creation DESC LIMIT :debut, :fin');
			$q->bindValue(':debut', $debut, PDO::PARAM_INT);
			$q->bindValue(':fin', $fin, PDO::PARAM_INT);
			$q->execute();
			while($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$billets[] = new Billet($donnees);
			}
			$q->closeCursor();
			return $billets;
		}
		
		// Met a jour le billet Billet
		public function update(Billet $billet) {
			if(!is_int($billet->id())) {
				trigger_error('Erreur de mise a jour des billets du forum. Veuillez reporter ce bug a campusenmusic@gmail.com', E_USER_WARNING);
				return;
			}
			
			// On stocke les valeurs dans des variables car on ne peut pas extraire des donnees aux objets dans les structures conditionnelles
			$titre = $billet->titre();
			$contenu = $billet->contenu();
			$auteur = $billet->auteur();
			$insertionRequete = '';
			// On cree une chaine qui va nous servir a updater les champs qui sont defini dans l'objet
			if(!empty($titre))
				$insertionRequete .= ' titre = :titre,';
			if(!empty($contenu))
				$insertionRequete .= ' contenu = :contenu,';
			if(!empty($auteur))
				$insertionRequete .= ' auteur = :auteur,';
			if(!empty($insertionRequete)) // Si la chaine n'est pas nulle, on retire la derniere virgule
				$insertionRequete = substr($insertionRequete, 0, -1);
			
			$q = $this->_db->prepare('UPDATE billets SET'.$insertionRequete.' WHERE id = :id');
			// Enfin, on fait toutes les liaisons.
			$q->bindValue(':id', $billet->id(), PDO::PARAM_INT);
			if(!empty($titre))
				$q->bindValue(':titre', $titre);
			if(!empty($contenu))
				$q->bindValue(':contenu', $contenu);
			if(!empty($auteur))
				$q->bindValue(':auteur', $auteur);
			$q->execute();
		}
		
		public function setDb(PDO $db) {
			$this->_db = $db;
		}
	
	}
	
?>
