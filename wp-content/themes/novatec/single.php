<?php

# Página interna padrão de posts

get_header();

echo "<div id='blog_content'>";

if(have_posts()):

	the_post();
	
	the_title('<h2>', '</h2>');
	the_content();
	echo "<div class='post_date'>Postado em ".get_the_date()."</div>";

	comments_template();

endif;

echo "</div>";

get_sidebar();

get_footer();