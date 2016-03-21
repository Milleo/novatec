<?php

#Arquivo do Post Type de Cursos

# Função para desclaração do Post Type
function create_curso(){
	register_post_type(
		'curso', 									# Nome do post type
		array(
			'labels' => array( 						# Labels para o admin
				'name' => 'Cursos', 
				'singular_name' => 'Curso'
			),
			'public' => true, 						# Se o post type é visivel no admin
			'has_archive' => true, 					# Se o archive-cursos.php pode ser usado
			'rewrite' => array('slug', 'cursos'), 	# Adicionar /cursos na URL antes do nome do curso
			'supports' => array('title', 'editor')	# Adicionando campo de título e editor de texto no admin
		)
	);

	add_action( 'add_meta_boxes', 'detalhes_metabox' ); # Função para adicionar metabox a este post-type
	add_action( 'save_post', 'detalhes_save' );			# Função a ser executada quando clicarmos no botão publicar, vamos usar para guardar os metadados
}

function detalhes_save($post_id){
	# Ao salvar o post apenas serão gravados os postmetas (sem validação ou alteração dos dados)

	update_post_meta($post_id, 'instrutor_id', $_POST['instrutor_id']);
	update_post_meta($post_id, 'data_inicio',  $_POST['data_inicio']);
	update_post_meta($post_id, 'data_termino', $_POST['data_termino']);
	update_post_meta($post_id, 'hora_inicio',  $_POST['hora_inicio']);
	update_post_meta($post_id, 'hora_termino', $_POST['hora_termino']);
}

function detalhes_metabox(){
	# Cadastrando uma metabox
	add_meta_box(
		'detalhes', # Id da metabox
		'Detalhes', # Label do admin
		'cursos_callback', # A função responsável por mostrar o HTML de dentro da metabox
		'curso' # Post-type que está associado o metabox
	);
}

function cursos_callback( $post ){
	# Função responsável por printar o conteúdo da metabox

	# Resgatando dados para colocar no value dos campos
	$instrutor_id = get_post_meta($post->ID, 'instrutor_id', true);
	$data_inicio  = get_post_meta($post->ID, 'data_inicio' , true);
	$data_termino = get_post_meta($post->ID, 'data_termino', true);
	$hora_inicio  = get_post_meta($post->ID, 'hora_inicio' , true);
	$hora_termino = get_post_meta($post->ID, 'hora_termino', true);

	# Buscando todos os instrutores para colocar no campo select
	$instrutores = new WP_Query(
		array(
			'post_type' => 'instrutor',
			'status' => 'publish',
			'posts_per_page' => -1,
			'orderby' => 'name',
			'order' => 'ASC'
		)
	);
?>
	<label>Instrutor</label>
	<select name='instrutor_id'>
		<option>Selecione</option>
	<?php
		if($instrutores->have_posts()):
			while($instrutores->have_posts()):
				$instrutores->the_post();

				# Caso o instrutor do loop seja o mesmo que foi selecionado anteriormente,
				# vamos colocar o atributo selected no campo
				$selecionado = "";
				if($instrutor_id == get_the_ID()){
					$selecionado = 'selected="selected"';
				}
				echo "<option value='".get_the_ID()."' ".$selecionado.">".get_the_title()."</option>";
			endwhile;
		endif;

	?>
	</select>
	<br />
	<label>Data de início</label> <input type='date' name='data_inicio' value='<?php echo $data_inicio ?>' /> <br />
	<label>Data de término</label> <input type='date' name='data_termino' value='<?php echo $data_termino ?>' /><br />
	<label>Hora início</label> <input type='time' name='hora_inicio' value='<?php echo $hora_inicio ?>' /><br />
	<label>Hora término</label> <input type='time' name='hora_termino' value='<?php echo $hora_termino ?>' /><br />
<?php
}

# Atrelando a função para declarar o post type ao hook 'init' do Wordpress
add_action('init', 'create_curso');

# Classe do Widget do post type Cursos
class widget_cursos extends WP_Widget {

	# Construtor
	function __construct() {
		parent::__construct(
			'widget_de_cursos', # ID do widget
			'Próximos cursos',  # Label do Widget para o Admin
			array( 'description' => 'Descrição') # Uma breve descrição para aparecer no admin também
		);
	}

	# Método para exibir o widget no sidebar do site
	public function widget( $args, $instance ) {
		
	}

	# Formulário do admin
	public function form( $instance ) {
		
	}
	
	# Método executado quando salvamos o widget
	public function update( $new_instance, $old_instance ) {
		
	}
}

# Função para declarar o Widget
function load_cursos_widget() {
	register_widget( 'widget_cursos' );
}

# Atrelando a função ao wordpress

add_action( 'widgets_init', 'load_cursos_widget' );