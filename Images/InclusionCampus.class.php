<?php
if(!isset($_SESSION)) {
	session_start();
}
// Se charge des differentes inclusions dans le site (liens des menus, forums...)
class InclusionCampus {

	private $_nbDir;
	const VERSION = 37;

	public function __construct($nbDir) {
		if(!is_numeric($nbDir)) {
			trigger_error('nbDir doit etre un entier : '.$nbDir, E_USER_WARNING);
			$this->_nbDir = 0;
		} else {
			$this->_nbDir = (int)$nbDir;
		}
	}

	// Inclu la banniere avec ses liens
	// $nbDir : le nombre de dossier entre le repertoire courrant et le dossier racine du site
	public function inclusionBanniere() {
?>
<div id="banniere">
	<div id="menu_principal">
		<div id="menu_principal_gauche">
			<div id="mp_1">
				<div class="clef_sol"></div>
				<a href="<?php $this->remonteARacine(); ?>index.php">Accueil</a>
			</div>
			<div id="mp_2">
				<div class="diese"></div>
				<a href="<?php $this->remonteARacine(); ?>Ateliers/index.php">Ateliers</a>
			</div>
			<div id="mp_3">
				<div class="clef_fa"></div>
				<a href="<?php $this->remonteARacine(); ?>Groupes/index.php">Groupes</a>
			</div>
		</div>
		<div id="menu_principal_droit">
			<div id="mp_4">
				<div class="clef_ut"></div>
				<a href="<?php $this->remonteARacine(); ?>Salle.php">Salle</a>
			</div>
			<div id="mp_5">
				<div class="bemol"></div>
				<a href ="http://campusenmusique.forumactif.org/" target="_BLANK">Forums</a>
				<!--Blog/BlogBillet.php-->
			</div>
			<div id="mp_6">
				<div class="TAB"></div>
				<a href="<?php $this->remonteARacine(); ?>Presentation.php">Présentation</a>
			</div>
		</div>
	</div>
</div>
<header>
<?php 
		if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['type'])) {
			echo '<h3>Bonjour ' . htmlspecialchars($_SESSION['pseudo']).'</h3>';
		} else {
?>
	Association Musicale étudiante de l'universite d'Orsay
</header>

<?php
		}
	}

	// Inclut le pied de page
	public function inclusionFooter() {
?>
<footer>
<div id="motif_inferieur"></div>
<p>Contact : campusenmusic@gmail.com</p>
<p>
	<em>
		Copyright 2012 - tous droits reserves<br/>
		Toute reproduction, meme partielle, est formellement interdite
	</em>
</p>
</footer>
<?php
	}
	
	//inclut le menu droit
	public function inclusionMenuDroit() {
?>
<nav id="menu_droit">
	<div id="dragon_droit"></div>
	<div class="menu_clair">
		<?php
		if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['type'])) {// Si on est connecte
		?>
			<h3><a href="<?php $this->remonteARacine(); ?>Groupes/pagePerso.php?groupe=<?php echo $_SESSION['id']; ?>">Page perso</a></h3>
		<?php
		} else {
		?>
			<h3><a href="<?php $this->remonteARacine(); ?>Membres/index.php">Connexion</a></h3>
		<?php
		}
		?>
		
	</div>
	<div class="menu_clair">
		<h3><a href="<?php $this->remonteARacine(); ?>Postes/Postes.php">Je m'investis!</a></h3>
	</div>
	<!--
	<div class="menu_fonce">
		<h3>Ateliers</h3>
		<ul>
			<li><a href="<?php $this->remonteARacine(); ?>erreur404.php">Technical-Dreams</a></li>
			<li><a href="<?php $this->remonteARacine(); ?>erreur404.php">Atelier Celtique</a></li>
		</ul>
	</div>
	-->
</nav>
<?php
	}
	
	// inclu le menu gauche
	public function inclusionMenuGauche() {
?>
<nav id="menu_gauche">
	<div id="dragon_gauche"></div>
	<div class="menu_clair">
		<?php
		if (isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['type'])) {
		?>
			<h3><a href="<?php $this->remonteARacine(); ?>Membres/deconnection.php">Deconnection</a></h3>
		<?php
		} else {
		?>
			<h3><a href="<?php $this->remonteARacine(); ?>Membres/inscription.php">Inscription</a></h3>
		<?php
		}
		?>
		
	</div>
	
	<div class="menu_fonce">
		<h3><a href="<?php $this->remonteARacine(); ?>imagesCampus.php">Images</a></h3>
		<!--<ul>
			<li><a href="<?php $this->remonteARacine(); ?>erreur404.php">Troub</a></li>
		</ul>-->
	</div>
	
	
	<!--
	<div id="recherche" class="menu_clair">
		<h3>Recherche</h3>
		<input type="text" name="pseudo" id="pseudo" />
	</div>
	-->
</nav>
<?php
	}
	
	// inclu le motif central
	public function inclusionMotifCentral() {
?>
<div id="motif_central">
<div id="motif_supperieur"></div>
<div id="ligne_verticale"></div>
</div>
<?php
	}
	
	// inclu la feuille de style de la page
	public function inclusionStyle() {
?>
	<link href="<?php $this->remonteARacine(); ?>style2.css?v=<?php echo InclusionCampus::VERSION; ?>" rel="stylesheet" type="text/css"/>
<?php
	}
	
	// Ecrit autant de ../ qu'il le faut pour que les adresses partent de la racine
	// On suppose que $nbDir a ete verifie comme etant entier
	private function remonteARacine() {
		for($i = 0; $i < $this->_nbDir; $i++) {
			echo '../';
		}
		
	}

}
?>

