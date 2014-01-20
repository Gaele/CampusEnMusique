<?php
	// affiche les elements de base (billets et commentaire) necessaire a la creation d'un blog
	// Cette classe peut etre utilise dans diverses endroits
	class VueBlog {
		
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
				
				include (dirname(dirname(__FILE__)).'/dbConnection.php');
				$commentaireManager = new CommentaireManager($db);
				$nbCommentaires = $commentaireManager->count($billet->id());
				
				//echo '<br/>';//////////////////////////////
				echo '<a href="BlogCommentaires.php?billet=';//////////////
				echo $billet->id().'">';
				if($nbCommentaires > 1) {
					echo 'Voir les '.$nbCommentaires.' commentaires';////////////////
				} else if ($nbCommentaires == 1){
					echo 'Voir le commentaire';////////////////
				} else {
					echo 'Ajouter un premier commentaire !';
				}
				echo '</a>';
			}
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
			if($commentaire->lien() != null) {
				$lien = $commentaire->lien();
				echo "<br/>";
				if(!(strpos($lien, 'http://www.youtube.com') === false) && strpos($lien, 'http://www.youtube.com') == 0) {//video
					echo "<iframe src='".htmlspecialchars($lien)."' frameborder='0' style='width:500px;height:300px;' allowfullscreen></iframe>";
				} else if((!(strrpos($lien, ".gif") === false) && strrpos($lien, ".gif") == strlen($lien)-4) ||
				(!(strrpos($lien, ".jpg") === false) && strrpos($lien, ".jpg") == strlen($lien)-4) ||
				(!(strrpos($lien, ".png") === false) && strrpos($lien, ".png") == strlen($lien)-4)) {//image
					echo "<img src ='".$lien."' />";
				}
			}
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