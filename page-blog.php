<?php
/*
Template Name: Blog
*/
get_header();
the_post();

wp_enqueue_script('js_masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js');
?>

    <div class="fullscreen_block">
    <div class="fs_blog_module">


        <?php
        if (!isset($compile)) {$compile='';}
        $posts_per_page = get_option('posts_per_page');
        $category = "all";

        global $wp_query_blog, $paged;

        if(empty($paged)){
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        }

        $wp_query_blog = new WP_Query();
        $args = array(
            'post_type' => 'post',
            'paged' => $paged,
            'posts_per_page' => $posts_per_page,
        );

        if ($category!=="all" && $category!=="") {
            $args['tax_query']=array(
                array(
                    'taxonomy' => 'category',
                    'field' => 'slug',
                    'terms' => $category
                )
            );
        }

        $wp_query_blog->query($args);

        while ($wp_query_blog->have_posts()) : $wp_query_blog->the_post();

            get_template_part("bloglisting");

        endwhile;
        wp_reset_query();
        ?>

    <div class="clear"></div>
    </div>    
    <!-- .fs_blog_module -->
    <?php get_pagination("10", "show_in_shortcodes");?>
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