<?php
/*
Template Name: Gallery - Grid
*/
get_header();
the_post();

/* LOAD PAGE BUILDER ARRAY */
$pagebuilder = get_theme_pagebuilder(get_the_ID());

wp_enqueue_script('js_masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js');

$compile_result = '';

if (isset($pagebuilder['sliders']['fullscreen']['slides']) && is_array($pagebuilder['sliders']['fullscreen']['slides'])) {
    foreach ($pagebuilder['sliders']['fullscreen']['slides'] as $slideid => $slide) {
        $caption = breaksToBR($slide['caption']['value'], "<br>");
        $compile_result .= '
            <div class="grid_gallery-item '.((strlen($slide['title']['value']) > 0 || strlen($slide['caption']['value']) > 0) ? '' : 'no_title_no_caption').'">
                <div class="item_hover">
                    <div class="item_hover-img">
                        <img src="' . aq_resize($slide['src'], "384", "272", true, true, true) . '" alt=""/>
                        <div class="item_hover-fadder"></div>
                        <a href="' . $slide['src'] . '" rel="prettyPhoto[gallery1]" class="prettyPhoto"></a>
                    </div>
                    <div class="item_hover-body">
                        <div class="item_hover-title"><h3>'.$slide['title']['value'].'</h3></div>
                        <div class="item_hover-descr">
                            '.$caption.'
                        </div>
                    </div>
                </div>
            </div><!-- .grid_gallery-item -->
        ';
    }
} ?>
    <div class="fullscreen_block">
        <div class="fs_grid_module">
            <?php echo $compile_result; ?>
            <div class="clear"></div>
        </div>
        <!-- .fs_grid_module -->
    </div> <!-- .fullscreen_block -->

    <script>
        $(document).ready(function () {
        });
        $(window).load(function () {
            //$('.fs_grid_module').masonry();
            $('.fs_grid_module').masonry({
                itemSelector: '.grid_gallery-item',
                isAnimated: true
            });
            setTimeout("$('.fs_grid_module').masonry()", 500);
        });
        $(window).resize(function () {
            $('.fs_grid_module').masonry();
        });
    </script>


<?php get_footer(); ?>