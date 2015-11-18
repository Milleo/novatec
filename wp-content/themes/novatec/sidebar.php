<?php

# Página chamada pelo método get_sidebar, por padrão vamos chamar o sidebar do blog

	if ( is_active_sidebar( 'sidebar-blog' ) ){
		echo "<ul id='blog_sidebar'>";
		dynamic_sidebar('sidebar-blog');
		echo "</ul>";
	}