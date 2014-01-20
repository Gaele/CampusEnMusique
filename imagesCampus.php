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
			
			<div id="panneau_central">
				<h1>Images</h1>
				
				<h3>
				Retour à la Page
				</h3>
				
				<p>
					Les images qui suivent ont été créées pour l'association Campus en Musique<br/>
					mais n'ont jamais été publiées.
				</p>
				
				<div class='galerieImage'>
						
					<div class='cadrePetiteImage'>
						<div class = 'petiteImage'>
						<em>Cadre bleu</em>
							<a href="http://sphotos-d.ak.fbcdn.net/hphotos-ak-ash4/269090_1992472084730_7058904_n.jpg">
								<img src='http://sphotos-d.ak.fbcdn.net/hphotos-ak-ash4/269090_1992472084730_7058904_n.jpg' alt='Une image de campus'/>
							</a>
						</div>
						
						<div class = 'petiteImage'>
						<em>Image multi-colore</em>
							<a href="http://sphotos-f.ak.fbcdn.net/hphotos-ak-snc6/260583_1992532486240_1878367_n.jpg">
								<img src='http://sphotos-f.ak.fbcdn.net/hphotos-ak-snc6/260583_1992532486240_1878367_n.jpg' alt='Une image de campus'/>
							</a>
						</div>
						
						<div class = 'petiteImage'>
						<em>Image sombre</em>
							<a href="http://sphotos-d.ak.fbcdn.net/hphotos-ak-ash4/267900_1992532926251_1710738_n.jpg">
								<img src='http://sphotos-d.ak.fbcdn.net/hphotos-ak-ash4/267900_1992532926251_1710738_n.jpg' alt='Une image de campus'/>
							</a>
						</div>
					</div>
					
					<div class='cadrePetiteImage'>
						<div class = 'petiteImage'>
						<em>Campus addictif</em>
							<a href="http://sphotos-a.ak.fbcdn.net/hphotos-ak-ash4/262086_1992829253659_4579374_n.jpg">
								<img src='http://sphotos-a.ak.fbcdn.net/hphotos-ak-ash4/262086_1992829253659_4579374_n.jpg' alt='Une image de campus'/>
							</a>
						</div>
						
						<div class = 'petiteImage'>
						<em>Campus debrouillard</em>
							<a href="http://sphotos-d.ak.fbcdn.net/hphotos-ak-ash4/268676_1992829333661_1075734_n.jpg">
								<img src='http://sphotos-d.ak.fbcdn.net/hphotos-ak-ash4/268676_1992829333661_1075734_n.jpg' alt='Une image de campus'/>
							</a>
						</div>
						
						<div class = 'petiteImage'>
						<em>Campus reflexe</em>
							<a href="http://sphotos-g.ak.fbcdn.net/hphotos-ak-snc6/260006_1992829133656_1124252_n.jpg">
								<img src='http://sphotos-g.ak.fbcdn.net/hphotos-ak-snc6/260006_1992829133656_1124252_n.jpg' alt='Une image de campus'/>
							</a>
						</div>
					</div>
					
					<div class='cadrePetiteImage'>
						<div class = 'petiteImage'>
						<em>Affiche mediator</em>
							<a href="http://sphotos-a.ak.fbcdn.net/hphotos-ak-snc6/270728_2006403513007_2160054_n.jpg">
								<img src='http://sphotos-a.ak.fbcdn.net/hphotos-ak-snc6/270728_2006403513007_2160054_n.jpg' alt='Une image de campus'/>
							</a>
						</div>
						
						<div class = 'petiteImage'>
						<em>Affiche barre</em>
							<a href="http://sphotos-e.ak.fbcdn.net/hphotos-ak-ash4/261624_2006403993019_5226637_n.jpg">
								<img src='http://sphotos-e.ak.fbcdn.net/hphotos-ak-ash4/261624_2006403993019_5226637_n.jpg' alt='Une image de campus'/>
							</a>
						</div>
						
						<div class = 'petiteImage'>
						<em>Petits monstres</em>
							<a href="http://sphotos-f.ak.fbcdn.net/hphotos-ak-ash4/264370_2006404753038_5757305_n.jpg">
								<img src='http://sphotos-f.ak.fbcdn.net/hphotos-ak-ash4/264370_2006404753038_5757305_n.jpg' alt='Une image de campus'/>
							</a>
						</div>
					</div>
					
					<div class='cadrePetiteImage'>
						<div class = 'petiteImage'>
						<em>Logo classique</em>
							<a href="http://sphotos-d.ak.fbcdn.net/hphotos-ak-snc6/264341_1922553416807_1618472_n.jpg">
								<img src='http://sphotos-d.ak.fbcdn.net/hphotos-ak-snc6/264341_1922553416807_1618472_n.jpg' alt='Une image de campus'/>
							</a>
						</div>
						
						<div class = 'petiteImage'>
						<em>Affiche alternative 2011</em>
							<a href="http://sphotos-d.ak.fbcdn.net/hphotos-ak-snc6/269504_2010499855413_7591240_n.jpg">
								<img src='http://sphotos-d.ak.fbcdn.net/hphotos-ak-snc6/269504_2010499855413_7591240_n.jpg' alt='Une image de campus'/>
							</a>
						</div>
					</div>
						
				</div><!-- galerieImage -->
			
			
			</div><!-- paneau central-->
			<?php $inclusionCampus->inclusionMenuDroit(); ?>
			
			</div><!-- corps page-->
			<?php $inclusionCampus->inclusionFooter(); ?>
		</div><!-- block page-->
	</body>
</html>

