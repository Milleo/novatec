		</div>
		<footer>
			<div class='above'>
				<div class='wrapper'>
					<ul id='footer_sidebar'>
					<?php
						# Usando o sidebar do rodapé
						if ( is_active_sidebar( 'sidebar-footer' ) ){
							dynamic_sidebar('sidebar-footer');
						}
					?>
					</ul>
				</div>
			</div>
			<div class='bellow'>
				<div class='wrapper'>
					<p>&copy;2015 Centro de Treinamento Novatec</p>
					<small>Layout por <a href='http://laurabertazzi.com/' target='_blank'>Laura Bertazzi</a></small>
				</div>
			</div>
		</footer>
		<?php wp_footer() ?>
	</body>
</html>