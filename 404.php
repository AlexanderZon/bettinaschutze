<?php get_header(); ?>

    <div class="cont404">
        <div class="inside">
            <h1><?php echo ((get_theme_option("translator_status") == "enable") ? get_text("translator_404error") : __('404 Error','theme_localization')); ?></h1>

            <h2><?php echo ((get_theme_option("translator_status") == "enable") ? get_text("translator_oops") : __('Oops!','theme_localization')); ?> <?php echo ((get_theme_option("translator_status") == "enable") ? get_text("translator_header_404") : __('Not Found :(','theme_localization')); ?></h2>

            <h3><?php echo ((get_theme_option("translator_status") == "enable") ? get_text("translator_text_404") : __('Apologies, but we were unable to find what you were looking for.','theme_localization')); ?></h3>
        </div>

    </div>

<?php get_footer(); ?>