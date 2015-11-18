<?php

# Template padrão de páginas

get_header();

if(have_posts()):
	the_post();

	the_title('<h2>', '</h2>');
	the_content();
endif;

get_footer();