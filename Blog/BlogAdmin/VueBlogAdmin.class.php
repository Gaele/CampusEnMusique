<?php
	// affiche les elements de base (billets et commentaire) necessaire a la creation d'un blog
	// Cette classe peut etre utilise dans diverses endroits
	class VueBlogAdmin {
		
		public static function afficheBillet(Billet $billet, $commentaire) {
			if(!is_bool($commentaire)) {
				trigger_error('Le boolean commentaire n\'est pas un boolean', E_USER_WARNING);
				return;
			}
			
			echo '<div class="billet">';
			
			echo '<div class="auteur">';
			echo htmlspecialchars($billet->auteur());
			echo '</div>';
			
			echo '<div class="date">';
			echo htmlspecialchars($billet->formatedDate());
			echo '</div>';
			
			echo '<div class="titre">';
			//echo htmlspecialchars($billet->id()).' : ';///////////
			echo htmlspecialchars($billet->titre());
			echo '</div>';
			
			echo '<p>';
			echo nl2br(htmlspecialchars($billet->contenu()));
			echo '</p>';
			if($commentaire) {
				//echo '<br/>';//////////////////////////////
				echo '<a href="BlogCommentairesAdmin.php?billet=';//////////////
				echo $billet->id().'">Voir les commentaires</a>';////////////////
			}
			echo '<br/>';
			echo '<a href=\'BlogBilletSupprimerAdmin.php?billet=';
			echo $billet->id();
			echo '\'>Supprimer ce billet</a><br/>';
			echo '<a href=\'BlogBilletModifierAdmin.php?billet=';
			echo $billet->id();
			echo '\'>Modifier ce billet</a>';
			echo '</div>';
		}
		
		public static function afficheCommentaire(Commentaire $commentaire) {
			//echo 'Affiche un commentaire';
			echo '<div class="commentaire">';
			echo '<div class="titre"><strong>';
			echo htmlspecialchars($commentaire->auteur());
			echo '</strong> ';
			echo $commentaire->formatedDate();
			echo '</div>';
			echo '<p>';
			echo nl2br(htmlspecialchars($commentaire->commentaire()));
			echo '</p>';
			
			echo '<a href=\'BlogCommentairesSupprimerAdmin.php?billet=';
			echo $commentaire->id_billet();
			echo '&id=';
			echo $commentaire->id();
			echo '\'>Supprimer ce commentaire</a><br/>';
			
			echo '<a href=\'BlogCommentairesModifierAdmin.php?billet=';
			echo $commentaire->id_billet();
			echo '&id=';
			echo $commentaire->id();
			echo '\'>Modifier ce commentaire</a>';
			echo '</div>';
		}
		
		public static function afficheAucunCommentaire() {
			echo '<div class="commentaire">';
			//echo '<h2>';
			echo 'Aucun commentaire pour cette news';
			//echo '</h2>';
			echo '</div>';
		}
		
	}
	
?>