<?php

# Página de resultados de buscas

get_header();

echo "<div id='blog_content'>";
# Trazendo o termo buscado pelo usuário
echo "<h2>Resultado da busca por: ".get_search_query()."</h2>";

get_template_part('loop');

echo "</div>";
get_sidebar();

get_footer();