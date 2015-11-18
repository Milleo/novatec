<?php

# Template part de loop, desta forma temos um loop
# padronizado para todas as páginas que possuem postagens

if(have_posts()):
	while(have_posts()): the_post();
		echo "<div class='post_entry'>";
		echo "<h2><a href='".get_the_permalink()."'>".get_the_title()."</a></h2>";
		
		if(has_post_thumbnail()):
			the_post_thumbnail('meu_thumbnail');
		endif;

		the_content();

		echo "<div class='post_date'>Postado em ".get_the_date()."</div>";
		echo "</div>";
	endwhile;

	# Paginação das postagens, especificando quantos links devem aparecer antes
	# e depois do link selecionado, o texto de anterior e próximo e por fim 
	# o texto para leitores de tela (para deficientes visuais)
	the_posts_pagination( array(
	    'mid_size' => 2,
	    'prev_text' => 'Anterior',
	    'next_text' => 'Próximo',
	    'screen_reader_text ' => ' '
	) );

endif;