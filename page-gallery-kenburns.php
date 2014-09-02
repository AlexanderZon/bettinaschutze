<?php
/*
Template Name: Gallery - Kenburns
*/
get_header();
the_post();

wp_enqueue_script('js_kenburns', get_template_directory_uri() . '/js/kenburns.js');

/* LOAD PAGE BUILDER ARRAY */
$pagebuilder = get_theme_pagebuilder(get_the_ID());

$compile_result = '';

if (isset($pagebuilder['sliders']['fullscreen']['slides']) && is_array($pagebuilder['sliders']['fullscreen']['slides'])) {
    foreach ($pagebuilder['sliders']['fullscreen']['slides'] as $slideid => $slide) {
        $compile_result .= "'".$slide['src']."',";
    }
    $compile_result = substr($compile_result, 0, -1);
}
?>

    <div class="fullscreen_block">
        <div class="gallery_kenburns">
            <canvas id="kenburns">
                <p>Your browser doesn't support canvas!</p>
            </canvas>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#kenburns').attr('width', $(window).width());
            $('#kenburns').attr('height', $(window).height());
            $('#kenburns').kenburns({
                images: [<?php echo $compile_result; ?>],
                frames_per_second: 30,
                display_time: 5000,
                fade_time: 1000,
                zoom: 1.2,
                background_color: '#000000'
            });
        });

        $(window).resize(function () {
            $('#kenburns').remove();
            $('.fullscreen_block').append("<canvas id='kenburns'><p>Your browser doesn't support canvas!</p></canvas>");
            $('#kenburns').attr('width', $(window).width());
            $('#kenburns').attr('height', $(window).height());
            $('#kenburns').kenburns({
                images: [<?php echo $compile_result; ?>],
                frames_per_second: 30,
                display_time: 5000,
                fade_time: 1000,
                zoom: 1.2,
                background_color: '#000000'
            });
        });
    </script>






<?php get_footer(); ?>