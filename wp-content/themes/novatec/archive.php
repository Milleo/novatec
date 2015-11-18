<?php
# Archive genérico de posts

get_header();


echo "<div id='blog_content'>";

# Detecta se o loop é de categorias ou tags
if(is_category()):
	echo "<h2>".single_cat_title('Categoria: ', false)."</h2>";
endif;

if(is_tag()):
	echo "<h2>Tag: ".single_tag_title('Tag: ', false)."</h2>";
endif;

get_template_part('loop');

echo "</div>";

get_sidebar();

get_footer();