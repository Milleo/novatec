<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<?php wp_head(); ?>
	<title><?php wp_title(' - ', true, 'right'); bloginfo(); ?></title>
</head>

<body <?php body_class(); ?>>
	<header>
		<img src='<?php echo get_template_directory_uri() ?>/images/logo.png' alt='Editora Novatec - Livros de informática, Marketing digital e Negócios' width='550' height='150' />
		<?php

			# Chamando o menu cadastrado no arquivo functions.php, passando o ID
			# Uma classe css para a div que envolve o menu, um id HTML,
			# uma classe do menu em si e por fim especificando que na falta deste menu
			# nenhum outro deve substitui-lo
			wp_nav_menu(array(
				'theme_location'  => 'principal',
				'container_class' => 'wrapper_menu',
				'menu_id'         => 'main_menu',
				'menu_class'      => 'wrapper',
				'fallback_cb'     => ''
			));
		?>
	</header>
	<div class='wrapper' id='content'>