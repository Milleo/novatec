<?php

# Template de comentários

echo "<h3>Comentários</h3>";

if(have_comments()):
	echo "<ul class='comments'>";
	wp_list_comments();
	echo "</ul>";
endif;

comment_form();