<?php
/*
	Template Name: Page - Fullwidth
*/
get_header();
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

    <div class="fullscreen_block fullwidth_blog">
        <div class="fullscreen_title">
            <h1><?php the_title(); ?></h1>
            <a href="javascript:history.back()" class="btn_close"></a>
        </div>
        <?php

        $imgi = 0;
        if (isset($pagebuilder['sliders']['fullscreen']['slides'])) {
            foreach ($pagebuilder['sliders']['fullscreen']['slides'] as $slideid => $slide) {

                $caption = breaksToBR($slide['caption']['value'], "<br>");

                #if slide is the video
                if ($slide['slide_type'] == "video") {
                    #YOUTUBE
                    $is_youtube = substr_count($slide['src'], "youtu");
                    if ($is_youtube > 0) {
                        $videoid = substr(strstr($slide['src'], "="), 1);
                        $compile_with_video .= '<iframe width="100%" height="480" src="http://www.youtube.com/embed/' . $videoid . '?controls=1&amp;showinfo=0&amp;modestbranding=1&amp;wmode=opaque&amp;autoplay=0" allowfullscreen></iframe>';
                    }

                    #VIMEO
                    $is_vimeo = substr_count($slide['src'], "vimeo");
                    if ($is_vimeo > 0) {
                        $videoid = substr(strstr($slide['src'], "m/"), 2);
                        $compile_with_video .= '<iframe width="100%" height="480" frameborder="0" allowfullscreen="" src="http://player.vimeo.com/video/' . $videoid . '?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=0&amp;loop=0"></iframe>';
                    }

                }


                #if slide is the image
                if ($slide['slide_type'] == "image") {
                    $compile_with_video .= "<img src='".aq_resize($slide['src'], "960", "480", true, true, true)."' alt='image".$imgi."'/>";
                }

                $imgi++;
            }
        } else {
            //$compile_with_video = "<li><img src='".IMGURL."/def_pat01.jpg' alt='image'/></li>";
            //$compile_with_video = $compile_with_video.$compile_with_video.$compile_with_video;
        }
        ?>
                
        <div class="fullscreen_content fullscreen_content960">
            <div class="fullscreen_content_padding">
            	<div class="blog_sidebar_main">
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
                		<?php the_content(); ?>
                    </article>
                </div>
                <div class="clear"></div>
            </div>
        </div>         

    </div>
	<script>
        $(document).ready(function () {
            $('.blog_sidebar_main').animate({'opacity' : '1'}, 500);
        });        
    </script>
<?php get_footer(); ?>