<?php get_header();
the_post();

/* LOAD PAGE BUILDER ARRAY */
$pagebuilder = get_theme_pagebuilder(get_the_ID());
$pf = get_post_format();
if (empty($pf)) $pf = "text";
$pfIcon = get_pf_icon($pf);
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
the_pb_custom_bg_and_color($pagebuilder);
$current_page_sidebar = $pagebuilder['settings']['layout-sidebars'];
?>

    <div class="fullscreen_block">
        <div class="fullscreen_title">
            <h1><?php the_title(); ?></h1>
            <a href="javascript:history.back()" class="btn_close"></a>
        </div>

        <?php

        $imgi = 1;
        foreach ($pagebuilder['sliders']['fullscreen']['slides'] as $slideid => $slide) {

            $caption = breaksToBR($slide['caption']['value'], "<br>");

            #if slide is the video
            if ($slide['slide_type'] == "video") {
                #YOUTUBE
                $is_youtube = substr_count($slide['src'], "youtu");
                if ($is_youtube > 0) {
                    $videoid = substr(strstr($slide['src'], "="), 1);
                    $compile_with_video .= '<li><iframe width="1100" height="900" src="http://www.youtube.com/embed/' . $videoid . '?controls=1&amp;showinfo=0&amp;modestbranding=1&amp;wmode=opaque&amp;autoplay=0" allowfullscreen></iframe></li>';
                }

                #VIMEO
                $is_vimeo = substr_count($slide['src'], "vimeo");
                if ($is_vimeo > 0) {
                    $videoid = substr(strstr($slide['src'], "m/"), 2);
                    $compile_with_video .= '<li><iframe width="1100" height="900" frameborder="0" allowfullscreen="" src="http://player.vimeo.com/video/' . $videoid . '?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=0&amp;loop=0"></iframe></li>';
                }

            }


            #if slide is the image
            if ($slide['slide_type'] == "image") {
                $compile_with_video .= "<li><img src='" . aq_resize($slide['src'], null, "900", true, true, true) . "' alt='image" . $imgi . "'/></li>";
            }

            $imgi++;
        }
        ?>

        <div class="fullscreen_content_wrapper">
            <div class="featured_slider_wrapper fullscreen_container">
                <a href="javascript:void(0)" class="featured_prev"></a><a href="javascript:void(0)"
                                                                          class="featured_next"></a>
                <ul class="featured_slider-list">
                    <?php echo $compile_with_video; ?>
                </ul>
            </div>
        </div>
        <!-- .fullscreen_content_wrapper -->

        <div class="fullscreen_content">
            <a href="javascript:void(0)" class="content_toggle"><span
                    class="collapse"><?php echo((get_theme_option("translator_status") == "enable") ? get_text("collapse") : __('Collapse', 'theme_localization')); ?></span> <span
                    class="show"><?php echo((get_theme_option("translator_status") == "enable") ? get_text("show_info") : __('Show info', 'theme_localization')); ?></span></a>

            <div class="fullscreen_content_padding">
                <div class="row-fluid">
                    <div class="span12 module_cont module_fs_meta module_none_padding">
                        <?php
                        $terms = get_the_terms( get_the_ID(), 'portcat' );
                        if ( $terms && ! is_wp_error( $terms ) ) {
                            $draught_links = array();
                            foreach ( $terms as $term ) {
                                $draught_links[] = $term->name;
                            }
                            $on_draught = join( ", ", $draught_links );
                            $show_cat = true;
                        }
                        ?>
                        <p><span><?php the_time("d M Y"); ?> in</span> <?php if ($terms !== false) {echo $on_draught;} ?></p>

                        <?php if (isset($pagebuilder['settings']['equipment']) && strlen($pagebuilder['settings']['equipment'])>0) { ?>
                        <p><span><?php echo ((get_theme_option("translator_status") == "enable") ? get_text("equipment") : __('Equipment:','theme_localization')) ?>:</span> <?php echo $pagebuilder['settings']['equipment']; ?></p>
                        <?php } ?>

                        <?php if (isset($pagebuilder['settings']['location']) && strlen($pagebuilder['settings']['location'])>0) { ?>
                        <p><span><?php echo ((get_theme_option("translator_status") == "enable") ? get_text("location") : __('Location:','theme_localization')) ?>:</span> <?php echo $pagebuilder['settings']['location']; ?></p>
                        <?php } ?>

                        <?php if (isset($pagebuilder['settings']['model']) && strlen($pagebuilder['settings']['model'])>0) { ?>
                        <p><span><?php echo ((get_theme_option("translator_status") == "enable") ? get_text("model") : __('Model:','theme_localization')) ?>:</span> <?php echo $pagebuilder['settings']['model']; ?></p>
                        <?php } ?>

                        <?php if (isset($pagebuilder['settings']['style']) && strlen($pagebuilder['settings']['style'])>0) { ?>
                        <p><span><?php echo ((get_theme_option("translator_status") == "enable") ? get_text("style") : __('Style:','theme_localization')) ?>:</span> <?php echo $pagebuilder['settings']['style']; ?></p>
                        <?php } ?>
                    </div>
                </div><!-- .row-fluid -->
                <div class="row-fluid">
                    <div class="span12 module_cont module_contact_icons module_small_padding1">
                        <a target="_blank" href="http://www.facebook.com/share.php?u=<?php echo get_permalink(); ?>"
                           class="ico_socialize_facebook1 ico_socialize type1"></a>
                        <a target="_blank"
                           href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&amp;url=<?php echo get_permalink(); ?>"
                           class="ico_socialize_twitter2 ico_socialize type1"></a>
                        <a target="_blank"
                           href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo (strlen($featured_image[0])>0) ? $featured_image[0] : get_theme_option("logo"); ?>"
                           class="ico_socialize_pinterest ico_socialize type1"></a>
                        <a target="_blank" href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>"
                           class="ico_socialize_google2 ico_socialize type1"></a>
                    </div>
                </div>
                <!-- .row-fluid -->

                <div class="row-fluid">
                    <div class="span12 module_cont module_text_area module_small_padding">
                        <?php the_content(); ?>
                    </div>
                </div>
                <!-- .row-fluid -->

            </div>
            <!-- .fullscreen_content_padding -->
        </div>
        <!-- .fullscreen_content -->

    </div>

<?php get_footer() ?>