<?php #Customização do formulário de buscas do wordpress ?>
<form action="<?php bloginfo('siteurl'); ?>" id="searchform" method="get">
     <input type="text" id="s" name="s" placeholder="Procurar" required />
     <input type="submit" id="searchsubmit" value='>' />
</form>