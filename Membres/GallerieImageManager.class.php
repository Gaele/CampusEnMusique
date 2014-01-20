<?php

	class GallerieImageManager {
		private $_db;
		
		public function __construct($db) {
			$this->setDb($db);
		}
		
		// ajoute une image dans la base
		public function add(GallerieImage $gallerie) {//ok
			
			$idProprietaire = $gallerie->idProprietaire();
			$url = $gallerie->urlImage();
			
			$nbImage = $this->countUserImages($idProprietaire);
			if($nbImage < 12) { // 12 image maximum par personnes
				$q = $this->_db->prepare('INSERT INTO gallerieimage (id, idProprietaire, urlImage, date_parution) VALUES (\'\', :idProprietaire, :url, NOW())');
				$q->bindValue(':idProprietaire', $idProprietaire, PDO::PARAM_INT);
				$q->bindValue(':url', $url);
				$q->execute();
			}
		}
		
		// compte le nombre de photos dans la base de donnee
		public function count() {//ok
			return $this->_db->query('SELECT COUNT(*) FROM gallerieimage')->fetchColumn();
		}
		
		// compte le nombre de photos d'un membre dans la base de donnee
		public function countUserImages($idProprietaire) {//ok
			if(!is_int($idProprietaire)) {
				trigger_error('idProprietaire n\'est pas un entier', E_USER_WARNING);
				return;
			}
			$donnee = $this->_db->prepare('SELECT COUNT(*) FROM gallerieimage WHERE idProprietaire = :idProprietaire');
			$donnee->bindValue(':idProprietaire', $idProprietaire);
			$donnee->execute();
			return $donnee->fetchColumn();
		}
		
		// supprime une image de la base
		public function delete($id) {//ok
			if(is_int($id)) {
				$q = $this->_db->prepare('DELETE FROM gallerieimage WHERE id = :id');
				$q->bindValue(':id', $id, PDO::PARAM_INT);
				$q->execute();
			} else {
				trigger_error('Erreur, l\identifiant d\'une image doit etre un entier', E_USER_WARNING);
			}
		}
		
		// supprime une image de la base a partir de son id et de l'id de son proprietaire
		public function deleteFromUser($id, $idProprietaire) {//ok
			if(is_int($idProprietaire) && is_int($id)) {
				$q = $this->_db->prepare('DELETE FROM gallerieimage WHERE idProprietaire = :idProp AND id = :id');
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
				$q = $this->_db->prepare('DELETE FROM gallerieimage WHERE idProprietaire = :idProp');
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
			$q = $this->_db->prepare('SELECT id, idProprietaire, urlImage, date_parution FROM gallerieimage WHERE id = :id');
			$q->bindValue(':id', $id, PDO::PARAM_INT);
			$q->execute();
			$donnees[] = $q->fetch(PDO::FETCH_ASSOC);
			
			if(empty($donnees[0])) {
				return new GallerieImage(array('id' => 0));
			} else {
				return new GallerieImage($donnees[0]);
			}
		}
		
		// Retourne la liste des images lie a un membre
		public function getAllFromUser($idProp) {//ok
			if(!is_int($idProp)) {
				trigger_error('L\'id du proprietaire d\'une photo doit etre un entier', E_USER_WARNING);
				return;
			}
			$images = array();
			$q = $this->_db->prepare('SELECT id, idProprietaire, urlImage, date_parution FROM gallerieimage WHERE idProprietaire = :idProp ORDER BY date_parution');
			$q->bindValue(':idProp', $idProp, PDO::PARAM_INT);
			$q->execute();
			while($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$images[] = new GallerieImage($donnees);
			}
			$q->closeCursor();
			return $images;
		}
		
		// Met a jour le membres membres
		public function update(GallerieImage $image) {//ok
			
			// On stocke les valeurs dans des variables car on ne peut pas extraire des donnees aux objets dans les structures conditionnelles
			$urlImage = $image->urlImage();
			$insertionRequete = '';
			// On cree une chaine qui va nous servir a updater les champs qui sont defini dans l'objet
			if(!empty($urlImage))
				$insertionRequete .= ' urlImage = :urlImage,';
			if(!empty($insertionRequete)) // Si la chaine n'est pas nulle, on retire la derniere virgule
				$insertionRequete = substr($insertionRequete, 0, -1);
			
			$q = $this->_db->prepare('UPDATE gallerieimage SET'.$insertionRequete.', date_parution = NOW() WHERE id = :id');
			// Enfin, on fait toutes les liaisons.
			$q->bindValue(':id', $image->id(), PDO::PARAM_INT);
			if(!empty($urlImage))
				$q->bindValue(':urlImage', $urlImage);
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
	
	// $mm = new GallerieImageManager($db);
	// require 'GallerieImage.class.php';
	// $image = new GallerieImage(array('id' => 4, 'idProprietaire' => 1, 'urlImage' => 'Super bien'));
	
	// $mm->add($image);
	//$mm->deleteFromUser(3, 1);
	//$mm->update($image);
	//$mm->delete(4);
	// $donnee = $mm->get(5);
	// echo $donnee->id().'<br>';
	// echo $donnee->idProprietaire().'<br>';
	// echo $donnee->urlImage().'<br>';
	// echo $donnee->date_parution().'<br>';
	
	// $donnees = $mm->getAllFromUser(1);
	// echo count($donnees);
	// foreach($donnees as $key => $images) {
		// echo $images->id().'<br>';
		// echo $images->idProprietaire().'<br>';
		// echo $images->urlImage().'<br>';
		// echo $images->date_parution().'<br>';
		// echo '<br>';
	// }
	
	//echo $mm->countUserImage(1);
	
?>
