<?php

	// chargeur de classes
	function chargerClasseGroupeMembreManager($className) {
		file_exists((dirname(dirname(__FILE__))).'/Groupes/'.$className.'.class.php') &&
		require (dirname(dirname(__FILE__))).'/Groupes/'.$className.'.class.php';
	}
	function chargerClasseMembresManager($className) {
		file_exists($className.'.class.php') &&
		require $className.'.class.php';
	}
	spl_autoload_register('chargerClasseGroupeMembreManager');
	spl_autoload_register('chargerClasseMembresManager');

	class MembresManager {
		private $_db;
		
		public function __construct($db) {
			$this->setDb($db);
		}
		
		// ajoute un membres dans la base
		public function add(Membres $membres) {//ok
			
			// verifie que les donnees sont presentes.
			$pseudo = $membres->pseudo();
			$pass = $membres->pass();
			$mail = $membres->mail();
			$type = $membres->type();
			if(empty($pseudo)) {
				trigger_error('Pseudo manquant', E_USER_WARNING);
				return;
			} else if(empty($pass)) {
				trigger_error('Pass manquant', E_USER_WARNING);
				return;
			} else if (empty($mail)) {
				trigger_error('mail manquant', E_USER_WARNING);
				return;
			} else if (!is_numeric($type)) {
				trigger_error('type manquant', E_USER_WARNING);
				return;
			}
			
			$q = $this->_db->prepare('INSERT INTO membres (id, pseudo, pass, mail, type, date_inscription) VALUES (\'\', :pseudo, :pass, :mail, :type, CURDATE())');
			
			$q->bindValue(':pseudo', $membres->pseudo());
			$q->bindValue(':pass', $membres->pass());
			$q->bindValue(':mail', $membres->mail());
			$q->bindValue(':type', $membres->type());
			
			$q->execute();
			
			if($type == 1 || $type == 2) { // si il s'agit d'un groupe
				$pageGroupeManager = new PageGroupeManager($this->_db);
				// On donne une page perso aux membres
				$pageGroupeManager->add($this->_db->lastInsertId());
			}
			
		}
		
		// compte le nombre de membress dans la base de donnee
		public function count() {//ok
			return $this->_db->query('SELECT COUNT(*) FROM membres')->fetchColumn();
		}
		
		public function countFromType($type) {
			if(!is_int($type)) {
				trigger_error('Le type d\'un membre doit etre un entier', E_USER_WARNING);
			}
			return $this->_db->query('SELECT COUNT(*) FROM membres WHERE type = '.$type)->fetchColumn();
		}
		
		public function containPseudo($pseudo) {
			if(strlen($pseudo) > 50) {
				trigger_error('Le pseudonyme doit comporter mois de 50 caracteres', E_USER_WARNING);
				return;
			}
			
			$q = $this->_db->prepare('SELECT COUNT(*) FROM membres WHERE pseudo = :pseudo');
			$q->bindValue(':pseudo', $pseudo);
			$q->execute();
			$nombreLigne = $q->fetchColumn();
			if($nombreLigne > 0) {
				return true;
			} else {
				return false;
			}
			
		}
		
		// supprime un membres de la base
		public function delete($membres) {// ok
		
			if(is_int($membres)) {
				$id = $membres;
			} else if ($membres instanceof Membres){
				$id = $membres->id();
			} else {
				trigger_error('Erreur, l\identifiant d\'un membres doit etre un entier', E_USER_WARNING);
				return;
			}
			
			// Delete from table pagegroupe
			$this->_db->query('DELETE FROM pagegroupe WHERE idProprietaire = '.$id);
			
			// Delete from table gallerieimage
			$this->_db->query('DELETE FROM gallerieimage WHERE idProprietaire = '.$id);
			
			// Delete from table gallerievideo
			$this->_db->query('DELETE FROM gallerievideo WHERE idProprietaire = '.$id);
			
			// Delete from table membres
			$this->_db->query('DELETE FROM membres WHERE id = '.$id);
		}
		
		// retourne le membres avec l'id $id
		public function get($id) {// ok
			if(!is_int($id)) {
				trigger_error('Erreur de chargement du membres du forum, l\'id doit etre un entier', E_USER_WARNING);
				return;
			}
			$donnees = array();
			$q = $this->_db->prepare('SELECT id, pseudo, pass, mail, type, date_inscription FROM membres WHERE id = :id');
			$q->bindValue(':id', $id, PDO::PARAM_INT);
			$q->execute();
			$donnees[] = $q->fetch(PDO::FETCH_ASSOC);
			
			if(empty($donnees[0])) {
				return new Membres(array('id' => 0));
			} else {
				return new Membres($donnees[0]);
			}
			
		}
		
		public function connect(Membres $membre) {
			if(!$membre->pseudo() || !$membre->pass()) {
				trigger_error('Le pseudo ou le mot de pass son indefini', E_USER_WARNING);
				return;
			}
			$donnee = array();
			$q = $this->_db->prepare('SELECT id, type FROM membres WHERE pseudo = :pseudo AND pass = :pass'); //  WHERE pseudo = :pseudo AND pass = :pass
			$q->bindValue(':pseudo', $membre->pseudo());
			$q->bindValue(':pass', $membre->pass());
			$q->execute();
			$donnee[] = $q->fetch(PDO::FETCH_ASSOC);
			
			if(empty($donnee[0])) {
				return null;
			} else {
				return $donnee[0];
			}
		}
		
		// retourne la liste des membres, du numero $debut au numero $fin
		public function getList($debut, $fin) {// ok
			if(!is_int($debut) || !is_int($fin)) {
				trigger_error('Erreur de chargement des membress du forum. Veuillez reporter ce bug a campusenmusic@gmail.com', E_USER_WARNING);
				return;
			}
			
			$membres = array();
			$q = $this->_db->prepare('SELECT id, pseudo, pass, mail, type, date_inscription FROM membres ORDER BY id DESC LIMIT :debut, :fin');
			$q->bindValue(':debut', $debut, PDO::PARAM_INT);
			$q->bindValue(':fin', $fin, PDO::PARAM_INT);
			$q->execute();
			while($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$membres[] = new Membres($donnees);
			}
			$q->closeCursor();
			return $membres;
		}
		
		// retourne la liste des membres, du numero $debut au numero $fin
		public function getListFromType($debut, $fin, $type) {// ok
			if(!is_int($debut) || !is_int($fin) || !is_int($type)) {
				trigger_error('Erreur de chargement des membress du forum. Veuillez reporter ce bug a campusenmusic@gmail.com', E_USER_WARNING);
				return;
			}
			
			$membres = array();
			$q = $this->_db->prepare('SELECT id, pseudo, pass, mail, type, date_inscription FROM membres WHERE type = :type ORDER BY id DESC LIMIT :debut, :fin');
			$q->bindValue(':debut', $debut, PDO::PARAM_INT);
			$q->bindValue(':fin', $fin, PDO::PARAM_INT);
			$q->bindValue(':type', $type, PDO::PARAM_INT);
			$q->execute();
			while($donnees = $q->fetch(PDO::FETCH_ASSOC)) {
				$membres[] = new Membres($donnees);
			}
			$q->closeCursor();
			return $membres;
		}
		
		// Met a jour le membres membres
		public function update(membres $membre) {// ok
			
			// On stocke les valeurs dans des variables car on ne peut pas extraire des donnees aux objets dans les structures conditionnelles
			$pseudo = $membre->pseudo();
			$pass = $membre->pass();
			$mail = $membre->mail();
			$type = $membre->type();
			$insertionRequete = '';
			// On cree une chaine qui va nous servir a updater les champs qui sont defini dans l'objet
			if(!empty($pseudo))
				$insertionRequete .= ' pseudo = :pseudo,';
			if(!empty($pass))
				$insertionRequete .= ' pass = :pass,';
			if(!empty($mail))
				$insertionRequete .= ' mail = :mail,';
			if(!empty($type))
				$insertionRequete .= ' type = :type,';
			if(!empty($insertionRequete)) // Si la chaine n'est pas nulle, on retire la derniere virgule
				$insertionRequete = substr($insertionRequete, 0, -1);
			
			$q = $this->_db->prepare('UPDATE membres SET'.$insertionRequete.' WHERE id = :id');
			// Enfin, on fait toutes les liaisons.
			$q->bindValue(':id', $membre->id(), PDO::PARAM_INT);
			if(!empty($pseudo))
				$q->bindValue(':pseudo', $pseudo);
			if(!empty($pass))
				$q->bindValue(':pass', $pass);
			if(!empty($mail))
				$q->bindValue(':mail', $mail);
			if(!empty($type))
				$q->bindValue(':type', $type);
			$q->execute();
		}
		
		public function setDb(PDO $db) {
			$this->_db = $db;
		}
	
	}
	
//	try {
//		$db = new PDO('mysql:host=localhost;dbname=miniblog', 'root', '');
//	} catch(Exception $e) {
//		die('Erreur: '.$e->getMessage());
//	}
	
//	$mm = new MembresManager($db);
//	require 'Membres.class.php';
//	$membre = new Membres(array('id' => 1, 'pass' => 'p', 'type' => 1, 'pseudo' => 'pseud', 'mail' => 'vincent@internet.net'));
	
	// $mm->add($membre);
	// echo $mm->count();
	// $mm->delete(81);
	// $mm->update($membre);
	
	// $membre = $mm->get(78);
	// echo $membre->id().'<br/>';
	// echo $membre->pseudo().'<br/>';
	// echo $membre->pass().'<br/>';
	// echo $membre->mail().'<br/>';
	// echo $membre->type().'<br/>';
	
	// $membres = $mm->getList(0,10);
	// foreach($membres as $key => $membre) {
		// echo $membre->id().'<br/>';
		// echo $membre->pseudo().'<br/>';
		// echo $membre->pass().'<br/>';
		// echo $membre->mail().'<br/>';
		// echo $membre->type().'<br/>';
		// echo '<br/>';
	// }
	
?>
