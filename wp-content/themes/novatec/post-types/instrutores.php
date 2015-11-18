<?php

function create_instrutor(){
	#Declaração de post type para o wordpress
	register_post_type('instrutor',
		array(
			# Labels de admin
			'labels' => array(
				'name' => 'Instrutores',
				'singular_name' => 'Instrutor'
			),
			'public' => true, #Post é publico para o front-end
			'has_archive' => true, # Pode existir uma página de archive (archive-instrutor.php)
			'rewrite' => array('slug', 'instrutor'), # Vai inserir na url o slug instrutor: http://localhost/instrutor/nome-do-instrutor
			'supports' => array( 'title', 'editor', 'thumbnail') # Quais são os elementos inclusos na edição do post, caso: Titulo, editor e imagem de destaque
		)
	);

	add_action( 'add_meta_boxes', 'redes_sociais_metabox' ); # Chama o método de declaração de metabox
	add_action( 'save_post', 'redes_sociais_save' ); # Chama o método de save de post meta
}

# Declara a metabox
function redes_sociais_metabox(){
	add_meta_box(
		'redes_sociais', # Slug da metabox
		'Redes Sociais', # Titulo do metabox no admin
		'redes_sociais_callback', # Função contendo o código interno da metabox
		'instrutor' # Post Type que deve aparecer esta metabox
	);
}

# Função para criar o formulario da metabox
function redes_sociais_callback( $post ){
	# Valores dos campos
	$instrutor_twitter = get_post_meta($post->ID, 'instrutor_twtiter', true);
	$instrutor_linkedin = get_post_meta($post->ID, 'instrutor_linkedin', true);
	$instrutor_facebook = get_post_meta($post->ID, 'instrutor_facebook', true);

	?>


	<table class="form-table">
	<tbody>
		<tr>
			<th scope="row">
				<label for="instrutor_twtiter">Twitter</label>
			</th>
			<td>
				<input type="text" id="instrutor_twtiter" name="instrutor_twtiter" class="large-text code" size="70" value="<?php echo $instrutor_twitter ?>">
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="instrutor_linkedin">LinkedIn</label>
			</th>
			<td>
				<input type="text" id="instrutor_linkedin" name="instrutor_linkedin" class="large-text code" size="70" value="<?php echo $instrutor_linkedin ?>">
			</td>
		</tr>
		<tr>
			<th scope="row">
				<label for="instrutor_facebook">Facebook</label>
			</th>
			<td>
				<input type="text" id="instrutor_facebook" name="instrutor_facebook" class="large-text code" size="70" value="<?php echo $instrutor_facebook ?>">
			</td>
		</tr>
	</tbody>
</table>
<?php
}

# Função para gravar os dados após efetuado o save
function redes_sociais_save($post_id){
	# Atualiza o valor de post meta (caso não exista, ele cria) passando o ID do post
	# que já vem no método por padrão, o nome da variável e o valor dela.
	update_post_meta( $post_id, 'instrutor_twtiter', $_POST['instrutor_twtiter'] );	
	update_post_meta( $post_id, 'instrutor_linkedin', $_POST['instrutor_linkedin'] );	
	update_post_meta( $post_id, 'instrutor_facebook', $_POST['instrutor_facebook'] );	
}

#Executa a função de declaração do post type no hook "INIT" do wordpress
add_action('init', 'create_instrutor');