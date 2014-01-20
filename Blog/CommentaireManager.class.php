<?php
	class commentaireManager {
		private $_db;

		public function __construct($db) {
			$this->setDb($db);
			//require 'Commentaire.class.php';
		}

		// ajoute un commentaire dans la base
		public function add(Commentaire $commentaire) {
			// verifie que les donnees sont presentes.
			$auteur = $commentaire->auteur();
			$id_billet = $commentaire->id_billet();
			$lien = $commentaire->lien();
			$commentaire = $commentaire->commentaire();
			
			if(empty($id_billet) || empty($commentaire) || empty($auteur) || !is_numeric($id_billet)) {
				if(empty($id_billet))
					trigger_error('id_billet doit etre precise', E_USER_WARNING);
				else if (empty($commentaire))
					trigger_error('commentaire manquant', E_USER_WARNING);
				else if (empty($auteur))
					trigger_error('auteur manquant', E_USER_WARNING);
				else if (empty($lien))
					trigger_error('lien manquant', E_USER_WARNING);
				else
					trigger_error('id_billet doit etre numerique', E_USER_WARNING);
				return;
			}
			$id_billet = (int)$id_billet;
		
			$q = $this->_db->prepare('INSERT INTO commentaires (id, id_billet, auteur, commentaire, date_commentaire, lien) VALUES (\'\', :id_billet, :auteur, :commentaire, NOW(), :lien)');
			
			$q->bindValue(':id_billet', $id_billet, PDO::PARAM_INT);
			$q->bindValue(':commentaire', htmlspecialchars($commentaire));
			$q->bindValue(':auteur', htmlspecialchars($auteur));
			$q->bindValue(':lien', htmlspecialchars($lien));
			
			$q->execute();
//			$perso->hydrate(array(
//				'id' => $this->db->lastInsertId(),
//			));
			
		}
		
		// compte le nombre de commentaires dans la base de donnee
		public function count($id_billet) {
			if(!is_int($id_billet)) {
				trigger_error('L\id du billet doit etre un entier', E_USER_WARNING);
			}
			
			return $this->_db->query('SELECT COUNT(*) FROM commentaires WHERE id_billet = '.$id_billet)->fetchColumn();
		}
		
		// supprime un commentaire de la base
		public function delete($commentaire) {
			if(is_int($commentaire)) {
				$q = $this->_db->prepare('DELETE FROM commentaires WHERE id = :id');
				$q->bindValue(':id', $commentaire, PDO::PARAM_INT);
				$q->execute();
			} else if ($commentaire instanceof Commentaire && is_int($commentaire->id())) {
				$q = $this->_db->prepare('DELETE FROM commentaires WHERE id = :id');
				$q->bindValue(':id', $commentaire->id(), PDO::PARAM_INT);
				$q->execute();
			} else {
				trigger_error('Erreur, l\identifiant d\'un commentaire doit etre un entier', E_USER_WARNING);
			}
		}
		
		// supprime un commentaire de la base
		public function deleteWithBillet($billet) {
			$q = $this->_db->prepare('DELETE FROM commentaires WHERE id_billet = :id_billet');
			if(is_int($billet)) {
				$q->bindValue(':id_billet', $billet, PDO::PARAM_INT);
				$q->execute();
			} else if ($billet instanceof Billet) {
				$q->bindValue(':id_billet', $commentaire->id(), PDO::PARAM_INT);
				$q->execute();
			} else {
				trigger_error('Erreur, l\identifiant d\'un commentaire doit etre un entier', E_USER_WARNING);
			}
		}
		
		// retourne le commentaire avec l'id $id
		public function get($id) {
			if(!is_int($id)) {
				trigger_error('Erreur de chargement du commentaire du forum.', E_USER_WARNING);
				return;
			}
			
			echo 'SELECT id, id_billet, commentaire, date_commentaire, auteur FROM commentaires WHERE id = '.$id.'<br/>';
			
			$donnees = array();
			$q = $this->_db->prepare('SELECT id, id_billet, commentaire, date_commentaire, auteur, lien FROM commentaires WHERE id = :id');
			$q->bindValue(':id', $id, PDO::PARAM_INT);
			$q->execute();
			$donnees[] = $q->fetch(PDO::FETCH_ASSOC);
			$q->closeCursor();
			
			if(empty($donnees[0])) {
				echo 'EMPTY';
				return new Commentaire(array('id' => 0));
			} else {
				return new Commentaire($donnees[0]);
			}
			
		}
		
		// retourne la liste des commentaires, du numero $debut au numero $fin
		public function getList($id_billet, $debut, $fin) {
			if(!is_int($debut) || !is_int($fin) || (!is_int($id_billet) && $id_billet = '') || $debut < 0 || $fin < 0 || $id_billet < 0){
				trigger_error('Parametres manquants ou incorrectes', E_USER_WARNING);
				return;
			}
			$condition = '';
			if($id_billet != '') {
				$condition = 'WHERE id_billet = :id_billet';
			}
			$commentaires = array();
			$q = $this->_db->prepare('SELECT id, id_billet, commentaire, auteur, date_commentaire, lien FROM commentaires '.$condition.' ORDER BY date_commentaire DESC LIMIT :debut, :fin');
			if($id_billet != '') {
				$q->bindValue(':id_billet', $id_billet, PDO::PARAM_INT);
			}
			$q->bindValue(':debut', $debut, PDO::PARAM_INT);
			$q->bindValue(':fin', $fin, PDO::PARAM_INT);
			$q->execute();
			
			while($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$commentaires[] = new Commentaire($donnees);
			}
			$q->closeCursor();
			return $commentaires;
		}
		
		// Met a jour le commentaire commentaire
		// On ne peut pas changer son lien
		public function update(commentaire $donnee) {
		
			if(!is_int($donnee->id())) {
				trigger_error('Erreur de mise a jour des commentaires du forum. Veuillez reporter ce bug a campusenmusic@gmail.com', E_USER_WARNING);
				return;
			}
			
			// On stocke les valeurs dans des variables car on ne peut pas extraire des donnees aux objets dans les structures conditionnelles
//			//$auteur = $donnee->auteur();
//			//$id_billet = $donnee->id_billet();
			$id = $donnee->id();
			$commentaire = $donnee->commentaire();
			
			$insertionRequete = '';
			// On cree une chaine qui va nous servir a updater les champs qui sont defini dans l'objet
//			//if(!empty($id_billet))
//			//	$insertionRequete .= ' id_billet = :id_billet,';
			if(!empty($commentaire))
				$insertionRequete .= ' commentaire = :commentaire,';
//			//if(!empty($auteur))
//			//	$insertionRequete .= ' auteur = :auteur,';
			if(!empty($insertionRequete)) // Si la chaine n'est pas nulle, on retire la derniere virgule
				$insertionRequete = substr($insertionRequete, 0, -1);
			
			$q = $this->_db->prepare('UPDATE commentaires SET'.$insertionRequete.' WHERE id = :id');
			
			// Enfin, on fait toutes les liaisons.
			$q->bindValue(':id', $donnee->id(), PDO::PARAM_INT);
//			//if(!empty($id_billet))
//			//	$q->bindValue(':id_billet', $id_billet, PDO::PARAM_INT);
			if(!empty($commentaire))
				$q->bindValue(':commentaire', $commentaire);
//			//if(!empty($auteur))
//			//	$q->bindValue(':auteur', $auteur);
			$q->execute();
		}
		
		public function setDb(PDO $db) {
			$this->_db = $db;
		}
	
	}
	
?>
