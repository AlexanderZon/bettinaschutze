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

if (get_theme_option("blog_post_style") == "fullwidth") {
?>
    <div class="fullscreen_block fullwidth_blog">
    	<div class="fullscreen_title">
            <h1><?php the_title(); ?></h1>
            <a href="javascript:history.back()" class="btn_close"></a>
        </div>
        <div class="fullscreen_content fullscreen_content960">
            <div class="fullscreen_content_padding">
            	<div class="blog_sidebar_main">
                	<div class="blog_post">
                        <div class="blog_head">
                            <div class="blogpost_meta">
                                <span><?php the_time("d M Y"); ?></span>
                                <span class="italic"><?php the_author(); ?></span>
                                <span>In <?php the_category(', '); ?></span>
                                <span><?php the_tags("" . ((get_theme_option("translator_status") == "enable") ? get_text("tags_caption") : __('Tags', 'theme_localization')) . ": ", ', ', ''); ?></span>
                            </div>
                        </div><!-- .blog_head -->
                        
                        <?php
							$imgi = 0;
							if (isset($pagebuilder['sliders']['fullscreen']['slides'])) {
								foreach ($pagebuilder['sliders']['fullscreen']['slides'] as $slideid => $slide) {
					
									#if slide is the video
									if ($slide['slide_type'] == "video") {
										#YOUTUBE
										$is_youtube = substr_count($slide['src'], "youtu");
										if ($is_youtube > 0) {
											$videoid = substr(strstr($slide['src'], "="), 1);
											$compile_with_video .= '<div class="featured_image_full"><iframe width="100%" height="480" src="http://www.youtube.com/embed/' . $videoid . '?controls=1&amp;showinfo=0&amp;modestbranding=1&amp;wmode=opaque&amp;autoplay=0" allowfullscreen></iframe></div>';
										}
					
										#VIMEO
										$is_vimeo = substr_count($slide['src'], "vimeo");
										if ($is_vimeo > 0) {
											$videoid = substr(strstr($slide['src'], "m/"), 2);
											$compile_with_video .= '<div class="featured_image_full"><iframe width="100%" height="480" frameborder="0" allowfullscreen="" src="http://player.vimeo.com/video/' . $videoid . '?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=0&amp;loop=0"></iframe></div>';
										}
					
									}
					
									#if slide is the image
									if ($slide['slide_type'] == "image") {
										$compile_with_video .= "<img src='" . aq_resize($slide['src'], "960", "480", true, true, true) . "' alt='image" . $imgi . "'/>";
									}
					
									$imgi++;
								}
							} else {
								//$compile_with_video = "<div class=\"featured_image_full\"><img src='" . IMGURL . "/def_pat01.jpg' width='960' height='480' alt='image'/></div>";
								//$compile_with_video = $compile_with_video . $compile_with_video . $compile_with_video;
							}
						?>
                        
                        <?php 
							if (($slide['slide_type'] == "image") && $imgi==1) {$onlyOneImage = "oneImage";} else {$onlyOneImage = "morethanOne";}
							if ($slide['slide_type'] == "image") {
								echo '<div class="featured_image_full"><div class="slider-wrapper theme-default"><div class="nivoSlider '.$onlyOneImage.'">';
								echo $compile_with_video;
								echo '</div></div></div>';
							}
							else {
								echo $compile_with_video;
							}
						 ?>
                         
                        <article class="contentarea">
                            <?php the_content();
							wp_link_pages(array('before' => '<div class="page-link"><span>' . ((get_theme_option("translator_status") == "enable") ? get_text("translate_pages") : __('Pages', 'theme_localization')) . ': </span>', 'after' => '</div>'));?>
							<div class="prev_next_links">
								<div class="fleft"><?php previous_post_link('&laquo; %link') ?></div>
								<div class="fright"><?php next_post_link('%link &raquo;') ?></div>
								<div class="clear"></div>
							</div>
                        </article>
                        <div class="blogpost_share">
                        	 <a target="_blank" href="http://www.facebook.com/share.php?u=<?php echo get_permalink(); ?>" class="ico_socialize_facebook1 ico_socialize type1"></a>
                             <a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo get_the_title(); ?>&amp;url=<?php echo get_permalink(); ?>" class="ico_socialize_twitter2 ico_socialize type1"></a>
                             <a target="_blank" href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo (strlen($featured_image[0])>0) ? $featured_image[0] : get_theme_option("logo"); ?>" class="ico_socialize_pinterest ico_socialize type1"></a>
                             <a target="_blank" href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" class="ico_socialize_google2 ico_socialize type1"></a> 
                             <div class="clear"></div>
                        </div>                        
                    </div><!--//blog_post-->
                    
                    <?php comments_template(); ?>
                
                
                
                </div>
                <div class="clear"></div>
            </div><!-- .fullscreen_content_padding -->
    	</div><!-- .fullscreen_content -->           
    </div> <!-- .fullscreen_block -->
    <script>
        $(document).ready(function () {
            $('.blog_sidebar_main').animate({'opacity' : '1'}, 500);
        });        
    </script>

<?php
} else {
?>

    <div class="fullscreen_block">
        <div class="fullscreen_title">
            <h1><?php the_title(); ?></h1>
            <a href="javascript:history.back()" class="btn_close"></a>
        </div>

        <?php

        $imgi = 1;
        if (isset($pagebuilder['sliders']['fullscreen']['slides'])) {
            foreach ($pagebuilder['sliders']['fullscreen']['slides'] as $slideid => $slide) {

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
        } else {
            $compile_with_video = "<li><img src='" . IMGURL . "/def_pat01.jpg' alt='image'/></li>";
            $compile_with_video = $compile_with_video . $compile_with_video . $compile_with_video;
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
                        <p><span><?php the_time("d M Y"); ?></span> in <?php the_category(', '); ?></p>

                        <p>
                            <span><?php echo((get_theme_option("translator_status") == "enable") ? get_text("translator_author") : __('Author', 'theme_localization')); ?>
                                :</span> <?php the_author(); ?></p>

                        <?php the_tags("<p><span>" . ((get_theme_option("translator_status") == "enable") ? get_text("tags_caption") : __('Tags', 'theme_localization')) . ":</span> ", ', ', '</p>'); ?>
                    </div>
                </div>
                <!-- .row-fluid -->

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
                        <?php the_content();
                        wp_link_pages(array('before' => '<div class="page-link"><span>' . ((get_theme_option("translator_status") == "enable") ? get_text("translate_pages") : __('Pages', 'theme_localization')) . ': </span>', 'after' => '</div>'));?>
                        <div class="prev_next_links">
                            <div class="fleft"><?php previous_post_link('&laquo; %link') ?></div>
                            <div class="fright"><?php next_post_link('%link &raquo;') ?></div>
                            <div class="clear"></div>
                        </div>
                    </div>
                </div>
                <!-- .row-fluid -->

                <div class="row-fluid">
                    <div class="span12">
                        <?php comments_template(); ?>
                    </div>
                </div>

            </div>
            <!-- .fullscreen_content_padding -->
        </div>
        <!-- .fullscreen_content -->

    </div>

<?php
}

get_footer() ?>