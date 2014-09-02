<?php
if (get_theme_option("menu_position") == "top") {
    echo '<div class="header2top"></div>';
}

the_theme_option("code_before_body"); wp_footer(); ?>
</body>
</html>