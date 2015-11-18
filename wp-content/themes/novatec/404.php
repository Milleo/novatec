<?php
# Página de 404

get_header(); ?>

<div id='error_page'>
	<h2>404</h2>
	<div class='right_side'>
		<p>Ops! Página não encontrada</p>
		<a href='<?php bloginfo('url')?>'>Ir para página principal</a>
	</div>
</div>

<?php get_footer();