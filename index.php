<?php get_header();
wp_enqueue_script('js_masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js');
?>
    <div class="fullscreen_block">
        <div class="fs_blog_module">
            <?php
            while (have_posts()) : the_post();
                get_template_part("bloglisting");
            endwhile;
            wp_reset_query();
            ?>
            <div class="clear"></div>
        </div>
        <!-- .fs_blog_module -->
        <?php get_pagination("10");?>
    </div> <!-- .fullscreen_block -->
    <script>
        $(document).ready(function () {
            $('.fs_blog_module').masonry();
        });
        $(window).load(function () {
            $('.fs_blog_module').masonry();
        });
        $(window).resize(function () {
            $('.fs_blog_module').masonry();
        });
    </script>

<?php get_footer(); ?>