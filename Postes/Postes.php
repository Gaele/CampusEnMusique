<?php
	require_once(dirname(dirname(__FILE__)).'/InclusionCampus.class.php');
	$inclusionCampus = new InclusionCampus(1);
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Postes</title>
		<?php $inclusionCampus->inclusionStyle(); ?>
	</head>
	
	<body>
		<div id="block_page">
		
			<?php $inclusionCampus->inclusionBanniere(); ?>
			
			<div id="corpsDeLaPage">
				
			<?php $inclusionCampus->inclusionMenuGauche(); ?>
			
			<div id="panneau_central">
				<h1>Postes à pourvoir</h1>
				<br/><br/>
				<div class='galerieImage'>	
					<div class='cadrePetiteImage'>
						<!-- Président -->
						<div class = 'petiteImage'>
							<h3>Président</h3>
							<a href='posteDetailles.php#president'>
								<img src='http://image14.spreadshirt.net/image-server/v1/products/108593066/views/1,width=378,height=378,appearanceId=1/Music-avec-clef-de-sol-et-cle-de-fa.-Frequence-Casquettes-et-bonnets.png' alt=''>
							</a>
						</div>

						<!-- Trésorier -->
						<div class = 'petiteImage'>
							<h3>VP Finance</h3>
							<a href='posteDetailles.php#finance'><img src='https://sphotos-b-ams.xx.fbcdn.net/hphotos-ash4/p206x206/1238866_567225083340474_1992701755_n.jpg' alt=''></a>
						</div>
						
						<!-- Secrétaire -->
						<div class = 'petiteImage'>
							<h3>VP Informations</h3>
							<a href='posteDetailles.php#information'><img src='https://scontent-a-ams.xx.fbcdn.net/hphotos-prn2/1472880_10201636541808623_837324937_n.jpg' alt=''></a>
						</div>
						
					</div>
					<br/>
					
					
					<div class='cadrePetiteImage'>
						<!-- Communication -->
						<div class = 'petiteImage'>
							<h3>VP Communication</h3>
							<!--<a href=''><img src='http://cdn2.business2community.com/wp-content/uploads/2013/04/marketingconsultant1.jpg' alt=''></a>-->
							<a href='posteDetailles.php#communication'><img src='http://www.virtualsocialmedia.com/wp-content/uploads/2012/11/How-Twitter-and-Facebook-are-changing-internet-marketing.jpg' alt=''></a>
							
						</div>
						
						<!-- Matériel -->
						<div class = 'petiteImage'>
							<h3>VP Matériel</h3>
							<a href='posteDetailles.php#materiel'><img src='http://www.meccano.fr/media/images/web/actualite/carrousel/83d3b734278f51129a338869a7b44d88.jpg' alt=''></a>
						</div>
						
						<!-- Communauté -->
						<div class = 'petiteImage'>
							<h3>VP Communauté</h3>
							<a href='posteDetailles.php#communaute'><img src='http://blog.neocamino.com/wp-content/uploads/2013/08/tumblr_inline_mn96sltg8A1qz4rgp.png' alt=''></a>
						</div>
						
					</div>
					<br/>
					<div class='cadrePetiteImage'>
						<!-- Technologies web -->
						<div class = 'petiteImage'>
							<h3>VP Technologies web</h3>
							<!--<a href=''><img src='http://www.icozine.com/images/web_dev.jpg' alt=''></a>-->
							<!--<a href=''><img src='http://www.wedev-solutions.com/images/developpement-web.png' alt=''></a>-->
							<a href='posteDetailles.php#technologies'><img src='https://si0.twimg.com/profile_images/1452814241/webdev.jpg' alt=''></a>
							
							
						</div>
						
						<!-- Evenementiel -->
						<div class = 'petiteImage'>
							<h3>VP Evenementiel</h3>
							<!--<a href=''><img src='http://us.123rf.com/400wm/400/400/vectomart/vectomart1210/vectomart121000066/15803391-illustration-de-rock-star-execution-en-concert-de-musique.jpg' alt=''></a>-->
							<a href='posteDetailles.php#evenement'><img src='http://www.ot-vesoul.fr/evenement/images/musique-instru-5722.jpg' alt=''></a>
							
							
						</div>
					</div>
					<br/>
					
				</div>

			</div><!-- Panneau central -->
				<?php $inclusionCampus->inclusionMenuDroit(); ?>
				
			</div><!-- Corps de la page -->
			
			<?php $inclusionCampus->inclusionFooter(); ?>
			
		</div><!-- Block page -->
	</body>
</html>


