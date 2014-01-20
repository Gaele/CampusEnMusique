<?php
// Realise les calculs et affiche des liens numerote vers d'autres pages.
// Ceci est utile pour les forums, articles, tout type de contenu qui genere un grand nombre
// de pages au format similaires
class PageGenerator {
	
	// retourne le nombre de pages
	// $nbBillets = le nombre de billets/news/articles en tout dans la base de donnee
	// $nbBillets = le nombre de billets/news/articles a afficher par page
	public static function getNbPages($nbBillets, $nbBilletsParPage) {
		if(!is_int($nbBillets) || !is_int($nbBilletsParPage)) {
			if(!is_int($nbBillets)) {
				trigger_error('Le nombre de Billets doit etre un entier', E_USER_WARNING);
			}
			if(!is_int($nbBilletsParPage)) {
				trigger_error('Le nombre de Billets par pages doit etre un entier', E_USER_WARNING);
			}
			return;
		}
		$nbPages =  floor($nbBillets / $nbBilletsParPage);// les pages pleines
		if(($nbBillets % $nbBilletsParPage) != 0 ) // verifie si il reste une page non remplie a la fin
			$nbPages++;
		return $nbPages;
	}

	// Ecrit les liens vers les pages suivantes avec le format suivant : 1 ... k-2 k-1 k k+1 k+2 ... n
	// $nbPagesAffiche : le nombre de pages visible avant et apres la page courrante (ci-dessus, nbPageAffiche = 2)
	// $nbPages : le nombre total de pages dans la base de donnee
	// $page : la page courrante
	public static function echoLiensVersPagesSuivantes($nbPagesAffiche, $nbPages, $page, $url) {
			if($nbPages > 1) {
				echo '<div id=\'pageNumerotation\'>';
				echo 'Pages suivantes : ';
				echo '<a href="'.$url.'page=1">1</a>  ';
				if(($nbPagesAffiche * 2) >= ($nbPages - 3)) {
					//echo 'affiche tout';//////////////////////////////////
					for($i = 2; $i <= $nbPages; $i++) { // On peut tout afficher, on affiche tout
						echo '<a href="'.$url.$i.'">'.$i.'</a>  ';
					}
				} else if (($page <= $nbPagesAffiche + 2)) { // On peut afficher le debut
					//echo 'affiche debut';//////////////////////////////////
					for($i = 2; $i <= $page + $nbPagesAffiche; $i++) {
						echo '<a href="'.$url.$i.'">'.$i.'</a>  ';
					}
					echo ' ... <a href="'.$url.$nbPages.'">'.$nbPages.'</a>  ';
				} else if ($page >= $nbPages - ($nbPagesAffiche + 1)) { // On peut afficher la fin
					//echo 'affiche fin';//////////////////////////////////
					echo ' ... ';
					for($i = $page - $nbPagesAffiche; $i <= $nbPages; $i++) {
						echo '<a href="'.$url.$i.'">'.$i.'</a>  ';
					}
				} else { // On est au milieu
					//echo 'affiche milieu';//////////////////////////////////
					echo ' ... ';
					for($i = $page - $nbPagesAffiche; $i <= $page + $nbPagesAffiche; $i++) {
						echo '<a href="'.$url.$i.'">'.$i.'</a>  ';
					}
					echo ' ... <a href="'.$url.$nbPages.'">'.$nbPages.'</a>  ';
				}
				echo '</div>';
			}
	}

}
?>

