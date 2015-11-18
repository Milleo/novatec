<?php

# Index principal do site, sobrescrita pelo front-page.php

get_header();


echo "<div id='blog_content'>";

get_template_part('loop');

echo "</div>";



get_sidebar();

get_footer();