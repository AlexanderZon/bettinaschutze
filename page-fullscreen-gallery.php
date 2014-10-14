<?php
/*
Template Name: Fullscreen gallery
*/
get_header();
the_post();

/* LOAD PAGE BUILDER ARRAY */
$pagebuilder = get_theme_pagebuilder(get_the_ID());

$compile_result = '<script>gallery_set = [';
$issetvideo = false;
$oneimage = false;

if (isset($pagebuilder['sliders']['fullscreen']['slides']) && is_array($pagebuilder['sliders']['fullscreen']['slides'])) {
    if (count($pagebuilder['sliders']['fullscreen']['slides']) == 1) {
        $oneimage = true;
    }
    foreach ($pagebuilder['sliders']['fullscreen']['slides'] as $slideid => $slide) {
        if ($slide['slide_type'] == "image") {
            if ($oneimage == true) {
                foreach ($pagebuilder['sliders']['fullscreen']['slides'] as $slideid => $slide) {
                    echo '
            <div class="fullscreen_block">
                <div class="image_background fullscreen_container" style="background:url(' . $slide['src'] . ') no-repeat">
                </div>
            </div>
            ';
                }
            } else {
                $caption = breaksToBR($slide['caption']['value'], "<br>");
                $caption = str_replace('\'', '"', $caption);
                $thisthumb = aq_resize($slide['src'], "88", "88", true, true, true);
                $compile_result .= "{image: '" . $slide['src'] . "', thmb: '{$thisthumb}', alt: '" . $slide['title']['value'] . "', fit: 'cover', title: '" . $slide['title']['value'] . "', description: '" . $caption . "'},";
            }
        } else {
            $issetvideo = true;
            $slidesrc = $slide['src'];
        }
    }
    $compile_result = substr($compile_result, 0, -1) . "]";

    if ($issetvideo == false && $oneimage == false) {
        $thumbs_state = get_theme_option("fullscreen_gallery_thumbs", "show");
        $compile_result .= "
            $('body').fs_gallery({
                fx: 'fade', /*fade, zoom, slide_left, slide_right, slide_top, slide_bottom*/
				thmb_state: '" . $thumbs_state . "',
                slide_time: 20000, /*This time must be < then time in css*/
                slides: gallery_set
            });
            ";
        $compile_result .= "</script>";
        echo '<div class="fullscreen_block"></div>';
        echo $compile_result;
    }
}

if ($issetvideo == true) {
    echo '
        <div class="fullscreen_block">
            <div class="video_background fullscreen_container">';

    #YOUTUBE
    $is_youtube = substr_count($slide['src'], "youtu");
    if ($is_youtube > 0) {
        $videoid = substr(strstr($slide['src'], "="), 1);
        echo '<iframe width="870" height="490" src="http://www.youtube.com/embed/' . $videoid . '?controls=1&amp;showinfo=0&amp;modestbranding=1&amp;wmode=opaque&amp;autoplay=1" allowfullscreen></iframe>';
    }

    #VIMEO
    $is_vimeo = substr_count($slide['src'], "vimeo");
    if ($is_vimeo > 0) {
        $videoid = substr(strstr($slide['src'], "m/"), 2);
        echo '<iframe frameborder="0" allowfullscreen="" src="http://player.vimeo.com/video/' . $videoid . '?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;loop=0"></iframe>';
    }

    echo '      </div>
        </div>
    ';
}

get_footer(); ?>