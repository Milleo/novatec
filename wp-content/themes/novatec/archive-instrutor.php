<?php
# Archive de instrutores

get_header();

echo "<h2>Instrutores</h2>";

# Realizando a leitura dos posts que vem por padrão no loop principal

if(have_posts()):
	echo "<ul class='instrutores'>";
	while(have_posts()): the_post();
		echo "<li>";
		the_post_thumbnail('thumbnail');
		the_title('<h2>', '</h2>');
		the_content();
		echo "</li>";
	endwhile;
	echo "</ul>";
endif;

get_footer();