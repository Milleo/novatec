<?php
	# Archive de cursos

	get_header();
?>

<h2>Cursos</h2>

<?php

# Realizando uma query pelo loop principal da página
# fazendo uma sobrescrita nos posts que vem por padrão
# trazendo-os em ordem por data do curso

query_posts(array(
	'posts_per_page' => -1, 			# Todos os cursos publicados
	'post_type' => 'curso',			 	# Post type curso
	'orderby' => 'meta_value', 			# Ordenação pelo valor do metadado
	'meta_key' => 'data_inicio',		# Referenciando o metadado que deve ser ordenado
	'meta_query' => array(				# Aqui é feita uma query customizada para trazermos os
		array(							# cursos a partir da data de hoje
			'key' => 'data_inicio',		# Especificando o metadado a ser filtrado
			'value' => date('Y-m-d'),   # O campo a comparar
			'compare' => ' >= '			# O tipo de comparação, desta forma nossa comparação será
		)								# data_inicio >= date('Y-m-d')
	),
	'order' => 'ASC'					# A ordem do campo data_inicio deve ser ascendente
));

# Inicinaodo o loop de posts
if(have_posts()):
	echo "<ul class='cursos'>";
	while(have_posts()): the_post();

		# Pegando os meta dados de cada post
		$instrutor_id = get_post_meta(get_the_ID(), 'instrutor_id', true);
		$data_inicio  = get_post_meta(get_the_ID(), 'data_inicio' , true);
		$data_termino = get_post_meta(get_the_ID(), 'data_termino', true);
		$hora_inicio  = get_post_meta(get_the_ID(), 'hora_inicio' , true);
		$hora_termino = get_post_meta(get_the_ID(), 'hora_termino', true);

		# Imprimindo os cursos
		echo "<li><a href='".get_the_permalink()."'>";
		the_title('<h2>', '</h2>');
		echo "<p>De ".$data_inicio." a ".$data_termino."</p>";
		echo "<p>A partir das ".$hora_inicio." as ".$hora_termino."</p>";
		echo "</a></li>";
	endwhile;
	echo "</ul>";
endif;

get_footer();