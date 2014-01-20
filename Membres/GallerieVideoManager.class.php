<?php

	class gallerieVideoManager {
		private $_db;
		
		public function __construct($db) {
			$this->setDb($db);
		}
		
		// ajoute une image dans la base
		public function add(GallerieVideo $gallerie) {//ok
			
			$idProprietaire = $gallerie->idProprietaire();
			$url = $gallerie->urlVideo();
			
			$nbImage = $this->countUserVideos($idProprietaire);
			if($nbImage < 12) { // 12 image maximum par personnes
				$q = $this->_db->prepare('INSERT INTO gallerievideo (id, idProprietaire, urlVideo, date_parution) VALUES (\'\', :idProprietaire, :url, NOW())');
				$q->bindValue(':idProprietaire', $idProprietaire, PDO::PARAM_INT);
				$q->bindValue(':url', $url);
				$q->execute();
			}
		}
		
		// compte le nombre de photos dans la base de donnee
		public function count() {//ok
			return $this->_db->query('SELECT COUNT(*) FROM gallerievideo')->fetchColumn();
		}
		
		// compte le nombre de photos d'un membre dans la base de donnee
		public function countUserVideos($idProprietaire) {//ok
			if(!is_int($idProprietaire)) {
				trigger_error('idProprietaire n\'est pas un entier', E_USER_WARNING);
				return;
			}
			$donnee = $this->_db->prepare('SELECT COUNT(*) FROM gallerievideo WHERE idProprietaire = :idProprietaire');
			$donnee->bindValue(':idProprietaire', $idProprietaire);
			$donnee->execute();
			return $donnee->fetchColumn();
		}
		
		// supprime une image de la base
		public function delete($id) {//ok
			if(is_int($id)) {
				$q = $this->_db->prepare('DELETE FROM gallerievideo WHERE id = :id');
				$q->bindValue(':id', $id, PDO::PARAM_INT);
				$q->execute();
			} else {
				trigger_error('Erreur, l\identifiant d\'une image doit etre un entier', E_USER_WARNING);
			}
		}
		
		// supprime une image de la base a partir de son id et de l'id de son proprietaire
		public function deleteFromUser($id, $idProprietaire) {//ok
			echo 'Supprime image '.$id.'de utilisateur '.$idProprietaire;
			if(is_int($idProprietaire) && is_int($id)) {
				$q = $this->_db->prepare('DELETE FROM gallerievideo WHERE idProprietaire = :idProp AND id = :id');
				$q->bindValue(':idProp', $idProprietaire, PDO::PARAM_INT);
				$q->bindValue(':id', $id, PDO::PARAM_INT);
				$q->execute();
			} else {
				trigger_error('Erreur, l\identifiant d\'un groupe et celui d\'une image doivent etre entier', E_USER_WARNING);
			}
		}
		
		// supprime une image de la base a partir de son id et de l'id de son proprietaire
		public function deleteUser($idProprietaire) {//ok
			if(is_int($idProprietaire) && is_int($id)) {
				$q = $this->_db->prepare('DELETE FROM gallerievideo WHERE idProprietaire = :idProp');
				$q->bindValue(':idProp', $idProprietaire, PDO::PARAM_INT);
				$q->execute();
			} else {
				trigger_error('Erreur, l\identifiant d\'un groupe et celui d\'une image doivent etre entier', E_USER_WARNING);
			}
		}
		
		// retourne une image avec l'id $id
		public function get($id) {//ok
			if(!is_int($id)) {
				trigger_error('l\'id doit etre un entier', E_USER_WARNING);
				return;
			}
			$donnees = array();
			$q = $this->_db->prepare('SELECT id, idProprietaire, urlVideo, date_parution FROM gallerievideo WHERE id = :id');
			$q->bindValue(':id', $id, PDO::PARAM_INT);
			$q->execute();
			$donnees[] = $q->fetch(PDO::FETCH_ASSOC);
			
			if(empty($donnees[0])) {
				return new GallerieVideo(array('id' => 0));
			} else {
				return new GallerieVideo($donnees[0]);
			}
		}
		
		// Retourne la liste des images lie a un membre
		public function getAllFromUser($idProp) {//ok
			if(!is_int($idProp)) {
				trigger_error('L\'id du proprietaire d\'une photo doit etre un entier', E_USER_WARNING);
				return;
			}
			$images = array();
			$q = $this->_db->prepare('SELECT id, idProprietaire, urlVideo, date_parution FROM gallerievideo WHERE idProprietaire = :idProp ORDER BY date_parution');
			$q->bindValue(':idProp', $idProp, PDO::PARAM_INT);
			$q->execute();
			while($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$images[] = new GallerieVideo($donnees);
			}
			$q->closeCursor();
			return $images;
		}
		
		// Met a jour le membres membres
		public function update(GallerieVideo $image) {//ok
			
			// On stocke les valeurs dans des variables car on ne peut pas extraire des donnees aux objets dans les structures conditionnelles
			$urlVideo = $image->urlVideo();
			$insertionRequete = '';
			// On cree une chaine qui va nous servir a updater les champs qui sont defini dans l'objet
			if(!empty($urlVideo))
				$insertionRequete .= ' urlVideo = :urlVideo,';
			if(!empty($insertionRequete)) // Si la chaine n'est pas nulle, on retire la derniere virgule
				$insertionRequete = substr($insertionRequete, 0, -1);
			
			$q = $this->_db->prepare('UPDATE gallerievideo SET'.$insertionRequete.', date_parution = NOW() WHERE id = :id');
			// Enfin, on fait toutes les liaisons.
			$q->bindValue(':id', $image->id(), PDO::PARAM_INT);
			if(!empty($urlVideo))
				$q->bindValue(':urlVideo', $urlVideo);
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
	
	// $mm = new gallerieVideoManager($db);
	// require 'gallerievideo.class.php';
	// $image = new gallerieVideo(array('id' => 5, 'idProprietaire' => 1, 'urlVideo' => 'url3'));
	
	// $mm->add($image);
	// $mm->deleteFromUser(1, 1);
	// $mm->update($image);
	// $mm->delete(2);
	// $donnee = $mm->get(3);
	// echo $donnee->id().'<br>';
	// echo $donnee->idProprietaire().'<br>';
	// echo $donnee->urlVideo().'<br>';
	// echo $donnee->date_parution().'<br>';
	
	// $donnees = $mm->getAllFromUser(1);
	// foreach($donnees as $key => $images) {
		// echo $images->id().'<br>';
		// echo $images->idProprietaire().'<br>';
		// echo $images->urlVideo().'<br>';
		// echo $images->date_parution().'<br>';
		// echo '<br>';
	// }
	
	//echo $mm->countUserImage(1);
	
?>
