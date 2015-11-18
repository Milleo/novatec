<?php

# Página de comentários

	comment_form();

	if(have_comments()):
		wp_list_comments();
	endif;