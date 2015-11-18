<?php

# Inclusão dos posts types de instrutores e cursos
include('post-types/instrutores.php');
include('post-types/cursos.php');

# Trazendo os scripts e arquivos CSS do tema
function scripts_novatec(){
	wp_enqueue_style( 'css-novatec', get_stylesheet_uri() );
}

# Cadastro do menu principal do site
# passando um indentificador para o menu e uma descrição para o admin
function registrar_menu_principal(){
	register_nav_menu('principal', 'Menu Principal do Site');
}

# Atrelando as funções ao tema do wordpress
add_action( 'after_setup_theme', 'registrar_menu_principal');
add_action( 'wp_enqueue_scripts', 'scripts_novatec' );

add_theme_support( 'post-thumbnails' ); # Adicionando suporte a imagens destacadas 

add_image_size('meu_thumbnail', 800, 250, true); # Adicionando thumbnail de tamanho customizado de id 'meu_thumbnail'

# Criando sidebars, passanod id, nome e descrição para mostrar no admin
register_sidebar(array(
	'id' => 'sidebar-blog',
	'name' => 'Sidebar do Blog',
	'description' => 'Barra lateral da seção de blog do site.'
));

register_sidebar(array(
	'id' => 'sidebar-footer',
	'name' => 'Boxes do rodapé',
	'description' => 'Itens de rodapé do site.'
));