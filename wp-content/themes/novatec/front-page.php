<?php

# Página home

get_header();
?>
<div class='home_upper'>
<?php
# Vamos colocar o conteúdo da home, no caso cadastramos apenas
# o slider da home, um slideshow CycloneSlider 2
if(have_posts()):
	the_post();
	echo "<div id='home_content'>";
	the_content();
	echo "</div>";
endif;

# Vamos trazer os últimos 4 posts em uma classe WP_Query 
$ultimos_posts = new WP_Query(array(
	'post_type' => 'post',
	'posts_per_page' => 4,
	'status' => 'publish'
));

# Percorrendo os últimos posts
if($ultimos_posts->have_posts()):
	echo "<ul id='ultimos_posts'>";
	$contagem = 0;
	while($ultimos_posts->have_posts()):
		$ultimos_posts->the_post();
		$contagem++;
		$class = 'class="par"';
		if($contagem % 2 == 1)
			$class = 'class="impar"';

		echo "<li ".$class."><a href='".get_the_permalink()."'><h2>".get_the_title()."</h2>".get_the_excerpt()."</a></li>";
	endwhile;
	echo "</ul>";

endif;
?>
</div>
<?php
$proximos_cursos = new WP_Query(array(
	'posts_per_page' => 5,	 			# Apenas 5 cursos
	'post_type' => 'curso',			 	# Post type curso
	'orderby' => 'meta_value', 			# Ordenação pelo valor do metadado
	'meta_key' => 'data_inicio',		# Referenciando o metadado que deve ser ordenado
	'meta_query' => array(				# Aqui é feita uma query customizada para trazermos os
		array(							# cursos a partir da data de hoje
			'key' => 'data_inicio',		# Especificando o metadado a ser filtrado
			'value' => date('Y-m-d'),   # O campo a comparar
			'compare' => '>='			# O tipo de comparação, desta forma nossa comparação será
		)								# data_inicio >= date('Y-m-d')
	),
	'order' => 'ASC'					# A ordem do campo data_inicio deve ser ascendente
));

if($proximos_cursos->have_posts()):
	echo "<ul class='cursos'>";
	while($proximos_cursos->have_posts()):
		$proximos_cursos->the_post();

		# Pegando os meta dados de cada post
		$instrutor_id = get_post_meta(get_the_ID(), 'instrutor_id', true);
		$data_inicio = get_post_meta(get_the_ID(), 'data_inicio', true);
		$data_termino = get_post_meta(get_the_ID(), 'data_termino', true);
		$hora_inicio  = get_post_meta(get_the_ID(), 'hora_inicio' , true);
		$hora_termino = get_post_meta(get_the_ID(), 'hora_termino', true);

		$data_inicio_dm = date('d/m', strtotime($data_inicio)); # Recuperando as datas já no formato dd/mm
		$data_termino_dm = date('d/m', strtotime($data_termino));

		# Imprimindo os cursos
		echo "<li class='box_curso'><a href='".get_the_permalink()."'>";
		if($data_termino != ''){ # Verifica se o curso tem uma data de término, senão é um evento de um dia só
			if($data_termino == date('Y-m-d', strtotime('+1 day', strtotime($data_inicio)))){ # Verificando se o termino é um dia após o início do curso
				echo "<p class='data'>".$data_inicio_dm." e ".$data_termino_dm."</p>";
			}else{
				echo "<p class='data'>De ".$data_inicio_dm." a ".$data_termino_dm."</p>";	
			}
			
		}else{
			echo "<p class='data'>".$data_inicio_dm."</p>";
		}

		the_title('<h2>', '</h2>');
		echo "<p>A partir das ".$hora_inicio." as ".$hora_termino."</p>";
		echo "</a></li>";
	endwhile;
	echo "</ul>";
endif;

get_footer();