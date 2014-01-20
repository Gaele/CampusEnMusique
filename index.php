<?php
	require 'InclusionCampus.class.php';
	$inclusionCampus = new InclusionCampus(0);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Campus en musique</title>
		<?php $inclusionCampus->inclusionStyle(); ?>
	</head>
	
	<body>
		<div id="block_page">
		
			<?php $inclusionCampus->inclusionBanniere(); ?>
			
			<div id="corpsDeLaPage">
				
				<?php $inclusionCampus->inclusionMenuGauche(); ?>
				
				<section id="section_gauche">
					
					<h1>Evenements</h1>
					
					<!--<em>Aucun évènement de prévu pour l'instant</em>-->
					
					<!--
					<article>
						<h2>Prochain événement</h2>
						<p style="text-align: left">
							<strong>Mercredi 04/12 : </strong><br/><font size="2.5">19h, Bâtiment 334, Université Paris-Sud</font><br/>
							Assemblée générale de Campus en Musique ! Venez partager votre passion de la musique.  </br>
						</p>
						<img src="https://scontent-b-ams.xx.fbcdn.net/hphotos-prn2/p480x480/971560_458156697628816_436660784_n.jpg">
						<!--<img src="http://feuilletons.blogs.liberation.fr/.a/6a0133f278ab5d970b01901de34153970b-320wi"/>-->
						<!--<img src="http://imalbum.aufeminin.com/album/D20090123/514223_CQ7DCFG174MZ2N3RJ2F5JT7X1X2SCR_oeil-arc-en-ciel_H190834_L.jpg"/>-->
						<!-- <img src="https://scontent-a-cdg.xx.fbcdn.net/hphotos-prn1/996601_569749126421403_361902955_n.jpg"/> -->
						<!--<img src="https://scontent-a-ams.xx.fbcdn.net/hphotos-frc1/p480x480/601048_572721879457461_1268419898_n.jpg"/>-->
						<!--<img src="https://fbcdn-sphotos-e-a.akamaihd.net/hphotos-ak-prn2/1456141_596760040386978_1141399868_n.jpg"/>-->
						<!--<img src="http://decroissons.files.wordpress.com/2012/12/dessin.jpg"/>
					</article>
					-->
					
					
					<!--<article>
						<h2>Prochain événement</h2>
						<p style="text-align: left">
							<strong>Samedi 29/03/2014 : </strong><br/><font size="2.5"> MJC Bobby Lapointe, Université Paris-Sud</font><br/>
							Concert-bal-masqué  </br>
						</p>	
					</article>-->
					
			
			
			
					<article>
						<h2>Evénements Suivants</h2>
						<p style="text-align: left">
							<strong>Aucun événement planifié : </strong><br/>
							Des idées d'événement ? Contactez-nous sans plus attendre.
						</p>
						
					</article>
					
				</section>
				
				<?php $inclusionCampus->inclusionMotifCentral(); ?>
				
				<section id="section_droite">
				<h1>actu</h1>
					<?php /*
					function chargerClasse($className) {
						require 'Blog/'.$className.'.class.php';
					}
					spl_autoload_register('chargerClasse');
					
					include 'dbConnection.php';
					require 'Blog/CommentaireManager.class.php';
					require 'Blog/BilletManager.class.php';
					$commentaireManager = new CommentaireManager($db);
					$billetManager = new BilletManager($db);
					
					$commentaires = $commentaireManager->getList('', 0, 3);
					
					foreach($commentaires as $key => $commentaire) {
						echo '<article><div class="titre2">';
						echo '<em>'.htmlspecialchars($commentaire->auteur()).' : ';
						echo htmlspecialchars($commentaire->formatedDate()).'</em><br/>';
						echo ' dans <strong> '.htmlspecialchars($billetManager->get($commentaire->id_billet())->titre()).' </strong></div>';
						echo '<div class="commentaire"><p>'.nl2br(htmlspecialchars($commentaire->commentaire())).'</p></div>';
						
						if($commentaire->lien() != null) {
							$lien = $commentaire->lien();
							echo "<br/>";
							if(!(strpos($lien, 'http://www.youtube.com') === false) && strpos($lien, 'http://www.youtube.com') == 0) {//video
								echo "<iframe src='".htmlspecialchars($lien)."' frameborder='0' allowfullscreen></iframe>";
							} else if((!(strrpos($lien, ".gif") === false) && strrpos($lien, ".gif") == strlen($lien)-4) ||
							(!(strrpos($lien, ".jpg") === false) && strrpos($lien, ".jpg") == strlen($lien)-4) ||
							(!(strrpos($lien, ".png") === false) && strrpos($lien, ".png") == strlen($lien)-4)) {//image
								echo "<img src ='".$lien."' />";
							}
							echo "<br/>";
						}
						
						echo '<a href=\'Blog/BlogCommentaires.php?billet='.$commentaire->id_billet().'\'>Voir la discussion</a>';
						echo '</article>';
					}*/
					?>

					<article>
						<h2>Inscrivez-vous</h2>
						<!--<em>08/09/2013</em>-->
						<p style="text-align:left">
							Rejoignez Campus en Musique <strong>sans passer par le local</strong> grâce à la fiche d'inscription numérique téléchargeable<br/>
							<a href="https://docs.google.com/document/d/1WZyhuGXJGwKTTDeqRonlBbQdu6mZH0JYNcptIcp9Zyw/edit?usp=sharing" target="blank">/ici !!!/</a><br/>
							Renvoyez le document complété à <u>campusenmusic@gmail.com</u>
						</p>
						<img src='https://encrypted-tbn2.gstatic.com/images?q=tbn:ANd9GcQjOnoGZ0FbfHmiZs0Fhb6m5s7RcLfA10l98-2TqHp1maoXEfmt' alt=''>
					</article>
					
					<!--
					<article>
						<h2>Rentrée de Campus en Musique</h2>
						<p>
							White Fire, le 21 juin, monte sur une scène de Vagabond Vibes à Paris pour présenter quatre de ses musiques.
						</p>
						<iframe class="youtube-player" src="http://www.youtube.com/embed/IwfKWZXrXT0">
						</iframe>
						
					</article>
					-->
					
					<!--
					<article>
						<h2>Notre premier journal</h2>
						<em>01/06/2013</em>
						<a href="https://fbcdn-sphotos-e-a.akamaihd.net/hphotos-ak-frc3/969862_521791761217140_820634286_n.jpg" target="_BLANK">
							<img src="https://fbcdn-sphotos-e-a.akamaihd.net/hphotos-ak-frc3/969862_521791761217140_820634286_n.jpg"/>
						</a>
						<p>
							CeM se dote d'un journal trimestriel dont le 1er numéro est sorti le 29 Mai 2013.
							Il est actuellement en libre accès dans la salle de CeM et quelques exemplaires sont dans le bâtiment.
						</p>
						<a href="https://fbcdn-sphotos-g-a.akamaihd.net/hphotos-ak-frc3/969862_521791764550473_826795675_n.jpg" target="_BLANK">
							<img src="https://fbcdn-sphotos-g-a.akamaihd.net/hphotos-ak-frc3/969862_521791764550473_826795675_n.jpg"/>
							http://www.arbois.fr/medias/arbois/Actualites/emm/72002538.gif
						</a>
					</article>
					-->
					
				</section>
				
				<?php $inclusionCampus->inclusionMenuDroit(); ?>
				
			</div>
			
			<?php $inclusionCampus->inclusionFooter(); ?>
			
		</div>
	</body>
</html>