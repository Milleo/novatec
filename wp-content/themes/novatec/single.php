<?php

# Página interna padrão de posts

get_header();

echo "<div id='blog_content'>";

if(have_posts()):
	echo "<article>";

	the_post();
	
	the_title('<h2>', '</h2>');
	echo "<div class='post_date'>Postado em ".get_the_date()."</div>";
	the_content();
	
	comments_template();

	echo "</article>";
endif;

echo "</div>";

get_sidebar();

get_footer();