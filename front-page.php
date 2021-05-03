<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package theme4w4
 */

get_header();
?>
	<main id="primary" class="site-main">
	


		<?php if ( have_posts() ) : ?>

			<header class="page-header">
			<h1 class="page-title">Accueil</h1>
				<?php
				//the_archive_title( '<h1 class="page-title">', '</h1>' );
				
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<section class="cours">
			
			<?php
			/* Start the Loop */
            $precedent = "XXXXXX";
			$chaine_bouton_radio = '';
			
			//global $tProprieté;
			while ( have_posts() ) :
				the_post();
                convertirTableau($tPropriété);
				//print_r($tPropriété);
				
				if ($tPropriété['typeCours'] != $precedent): 
					if ("XXXXXX" != $precedent)	: ?>
						</section>
						
						<?php if (in_array($precedent, ['Web', 'Jeu', 'Spécifique', 'Image 2d/3d', 'Conception'])) : ?>
							
							
							<section class="ctrl-carrousel">
								<?php echo $chaine_bouton_radio;
								$chaine_bouton_radio = '';
								 ?>	
								 	
							</section>
							<div id="separateur"></div>
						<?php endif; ?>
					<?php endif; ?>	
					<h2><?php echo $tPropriété['typeCours'] ?></h2>
					<section <?php echo class_composant($tPropriété['typeCours']) ?>>
				<?php endif ?>	

				<?php if (in_array($tPropriété['typeCours'], ['Web', 'Jeu', 'Spécifique', 'Image 2d/3d', 'Conception']) ) : 
						get_template_part( 'template-parts/content', 'cours-carrousel' ); 
						$chaine_bouton_radio .= '<input class="rad-carrousel"  type="radio" name="rad-'.$tPropriété['typeCours'].'">';
						elseif ($tPropriété ['typeCours'] == 'Projets' ):
							get_template_part( 'template-parts/content', 'galerie' ); 
						

				else :		
						get_template_part( 'template-parts/content', 'cours-article' ); 
				endif;	
				$precedent = $tPropriété['typeCours'];
			endwhile;?>
			</section> <!-- fin section cours -->
		<?php endif; ?>
		<?PHP if (current_user_can('administrator')) : ?>
<!-- ///////////////////////////////////////////////////////////////////////////// 
     Formulaire d'ajout d'un artcle de catégorie « Nouvelles »   -->
            <section class="admin-rapide">
				
                <h3>Ajouter un article de catégorie « Nouvelles »</h3>
                <input type="text" name="title" placeholder="Titre">
                <textarea name="content"></textarea>
                <button id='bout-rapide'>Créer une Nouvelle</button>
				
            </section>
<?php endif ?>

		</section>
			<section class="nouvelles">
			<!--<button id="bout_nouvelles">Afficher les 3 dernières nouvelles</button>-->
			<section></section>
			</section>

	

	</main><!-- #main -->

<?php
//get_sidebar();
get_footer();

function convertirTableau(&$tPropriété)
{
	/*
	$titre = get_the_title(); 
	// 582-1W1 Mise en page Web (75h)
	$sigle = substr($titre, 0, 7);
	$nbHeure = substr($titre,-4,3);
	$titrePartiel =substr($titre,8,-6);
	$session = substr($titre, 4,1);
	// $contenu = get_the_content();
	// $resume = substr($contenu, 0, 200);
	$typeCours = get_field('type_de_cours');
*/

	$tPropriété['titre'] = get_the_title(); 
	$tPropriété['sigle'] = substr($tPropriété['titre'], 0, 7);
	$tPropriété['nbHeure'] = substr($tPropriété['titre'],-4,3);
	$tPropriété['titrePartiel'] = substr($tPropriété['titre'],8,-6);
	$tPropriété['session'] = substr($tPropriété['titre'], 4,1);
	$tPropriété['typeCours'] = get_field('type_de_cours');
}

function class_composant ($typeCours){
	if(in_array($typeCours, ['Web', 'Jeu', 'Spécifique', 'Image 2d/3d', 'Conception'])){
	return 'class="carrousel-2"';
		}
	elseif($typeCours == 'Projets'){
		return 'class="galerie"';
		
		}
	else{
		return 'class="bloc"';
	}

}
