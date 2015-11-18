<?php

/*
Plugin Name: Publicidade Novatec
Plugin URI: http://www.novatec.com.br/fabrica-de-software
Description: Plugin para busca de publicidades no site da novatec
Version: 1.0
Author: Meu Nome
Author URI: 
License: GPLv2
*/

class widget_banner extends WP_Widget{

}
function add_post_type_campanha(){

	register_post_type('campanha', 
		array(
			'labels' => array(
				'name' => 'Campanhas',
				'single_name' => 'Campanha'
			),
			'public' => true,
			'archive' => false,
			'supports' => ('title')
		)
	);

	add_action( 'add_meta_boxes', 'campanha_metaboxes' );
	add_action( 'save_post', 'detalhes_campanha_save' );
	
}

function campanha_metaboxes(){
	add_meta_box('imagens', 'Imagens', 'imagens_callback', 'campanha');
	add_meta_box('vigencia', 'Vigência da campanha', 'vigencia_callback', 'campanha');
	add_meta_box('link', 'Link', 'link_callback', 'campanha');
}

function imagens_callback($post){
	$campanha_700x150 = get_post_meta($post->ID, 'campanha_700x150', true);
	$campanha_300x300 = get_post_meta($post->ID, 'campanha_300x300', true);
	$campanha_100x80 = get_post_meta($post->ID, 'campanha_100x80', true);
	?>
	<p class="description">Imagem da campanha (700x150)</p>
	<input type="file" id="campanha_700x150" name="campanha_700x150" size="25"  /><br />
	<img src='<?php echo $campanha_700x150['url'] ?>' alt='' />
	<p class="description">Imagem da campanha (300x300)</p><input type="file" id="campanha_300x300" name="campanha_300x300" value="<?php echo $campanha_300x300 ?>" size="25" /><br />
	<img src='<?php echo $campanha_300x300['url'] ?>' alt='' />
	<p class="description">Imagem da campanha (100x80)</p><input type="file" id="campanha_100x80" name="campanha_100x80" value="<?php echo $campanha_100x80 ?>" size="25" /><br />
	<img src='<?php echo $campanha_100x80['url'] ?>' alt='' />
	<?php
}
function vigencia_callback($post){
	$inicio_vigencia = get_post_meta($post->ID, 'inicio_vigencia', true);
	$termino_vigencia = get_post_meta($post->ID, 'termino_vigencia', true);
	?>
	<p class="description">Início Vigência</p><input type="date" id="inicio_vigencia" name="inicio_vigencia" value="<?php echo $inicio_vigencia ?>" size="25" />
	<p class="description">Término Vigência</p><input type="date" id="termino_vigencia" name="termino_vigencia" value="<?php echo $termino_vigencia ?>" size="25" />
	<?php
}
function link_callback($post){
	$campanha_url = get_post_meta($post->ID, 'campanha_url', true);
	?>
	<p class="description">URL da campanha</p><input type="text" id="campanha_url" name="campanha_url" value="<?php echo $campanha_url ?>" size="25" />
	<?php
}

function detalhes_campanha_save($id){
	$tamanhos = array('campanha_700x150', 'campanha_300x300', 'campanha_100x80');
	foreach($tamanhos as $tamanho){
		if(!empty($_FILES[$tamanho]['name'])) {   
		    $arr_file_type = wp_check_filetype(basename($_FILES[$tamanho]['name']));
		    $uploaded_type = $arr_file_type['type'];

	        $upload = wp_upload_bits($_FILES[$tamanho]['name'], null, file_get_contents($_FILES[$tamanho]['tmp_name']));
	 
	        if(isset($upload['error']) && $upload['error'] != 0) {
	            wp_die('Ocorreu um erro ao tentar enviar sua imagem: ' . $upload['error']);
	        } else {
	            add_post_meta($id, $tamanho, $upload);
	            update_post_meta($id, $tamanho, $upload);     
	        }
		}
	}

	update_post_meta($id, 'inicio_vigencia', $_POST['inicio_vigencia']);
	update_post_meta($id, 'termino_vigencia', $_POST['termino_vigencia']);
	update_post_meta($id, 'campanha_url', $_POST['campanha_url']);
}

function mostra_banner($params){
	$campanha = get_campanha_vigente();
	if($campanha->have_posts()){
		$campanha->the_post();
		$url_imagem = get_post_meta(get_the_ID(), 'campanha_300x300', true);
		$campanha_url = get_post_meta(get_the_ID(), 'campanha_url', true);
		echo "<a href='".$campanha_url."' target='_blank'><img src='".$url_imagem['url']."' /></a>";
	}
	
}

function get_campanha_vigente(){
	$campanha = new WP_Query(array(
			'post_type' => 'campanha',
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key' => 'termino_vigencia',
					'value' => date('Y-m-d'),
					'compare' => ' >= '
				),
				array(
					'key' => 'inicio_vigencia',
					'value' => date('Y-m-d'),
					'compare' => ' <= '
				)
			)
		)
	);

	return $campanha;
}

function add_post_enctype() {
    echo ' enctype="multipart/form-data"';
}

add_action('post_edit_form_tag', 'add_post_enctype');
add_action('init', 'add_post_type_campanha');
add_action('widget_init', 'widget_banner');
add_shortcode('banner_novatec', 'mostra_banner');
