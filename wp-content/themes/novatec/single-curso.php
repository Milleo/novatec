<?php

# Página interna de curso

get_header();

if(have_posts()):

	the_post();
	
	# Pegamos os metadados do post type de cursos

	$instrutor_id = get_post_meta(get_the_ID(), 'instrutor_id', true);
	$data_inicio  = get_post_meta(get_the_ID(), 'data_inicio' , true);
	$data_termino = get_post_meta(get_the_ID(), 'data_termino', true);
	$hora_inicio  = get_post_meta(get_the_ID(), 'hora_inicio' , true);
	$hora_termino = get_post_meta(get_the_ID(), 'hora_termino', true);
	
	# E apresentamos as informações na página

	the_title('<h2>', '</h2>');
	the_content();

	echo "<p>De ".$data_inicio." a ".$data_termino."</p>";
	echo "<p>A partir das ".$hora_inicio." as ".$hora_termino."</p>";

	$instrutor = get_post($instrutor_id);

	echo "<p>".$instrutor->post_title."</p>";
	echo "<p>".$instrutor->post_content."</p>";

endif;

get_footer();
