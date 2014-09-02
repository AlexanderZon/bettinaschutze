<?php
/*
Template Name: Blog with Sidebar
*/
get_header();
the_post();

// wp_enqueue_script('js_masonry', get_template_directory_uri() . '/js/masonry.pkgd.min.js');
?>

    <div class="fullscreen_block fullwidth_blog">
    	<div class="fullscreen_title">
            <h1><?php the_title(); ?></h1>
            <a href="javascript:history.back()" class="btn_close"></a>
        </div>
        
    	<div class="fullscreen_content fullscreen_content960">
            <div class="fullscreen_content_padding">
            	<div class="blog_sidebar_main">
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
                    
                    ?>
            
					<?php
                        $pf = get_post_format();
                        if (empty($pf)) $pf = "text";
                        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
                        $pagebuilder = get_theme_pagebuilder(get_the_ID());
                    ?>
                            
                    <div <?php post_class("blog_post_preview"); ?>>
                        <div class="blog_head">
                            <span class="blogpost_type_ico post_type_<?php echo $pf; ?>"></span>
                            <div class="bg_title"><h3><a class="blogpost_title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3></div>
                            <div class="blogpost_meta">
                                <span><?php the_time("d M Y"); ?></span>
                                <span class="italic"><?php the_author(); ?></span>
                                <span>In <?php the_category(', '); ?></span>
                                <span><?php the_tags("" . ((get_theme_option("translator_status") == "enable") ? get_text("tags_caption") : __('Tags', 'theme_localization')) . ": ", ', ', ''); ?></span>
                            </div>
                        </div><!-- .blog_head -->
                                             
                        <?php
            
                        $issetvideo = false;
                        $oneimage = false;
                        $featuredline = "";
            
                        if (isset($pagebuilder['sliders']['fullscreen']['slides']) && is_array($pagebuilder['sliders']['fullscreen']['slides'])) {
                            if (count($pagebuilder['sliders']['fullscreen']['slides']) == 1) {
                                $oneimage = true;
                            }
                            foreach ($pagebuilder['sliders']['fullscreen']['slides'] as $slideid => $slide) {
                                if ($slide['slide_type'] == "video") {
                                    $issetvideo = true;
                                    $slidesrc = $slide['src'];
                                }
                            }
            
                            if ($issetvideo == true) {
                                #YOUTUBE
                                $is_youtube = substr_count($slide['src'], "youtu");
                                if ($is_youtube > 0) {
                                    $videoid = substr(strstr($slide['src'], "="), 1);
                                    $featuredline = '<iframe width="100%" height="480" src="http://www.youtube.com/embed/' . $videoid . '?controls=1&amp;showinfo=0&amp;modestbranding=1&amp;wmode=opaque&amp;autoplay=0" allowfullscreen></iframe>';
                                }
            
                                #VIMEO
                                $is_vimeo = substr_count($slide['src'], "vimeo");
                                if ($is_vimeo > 0) {
                                    $videoid = substr(strstr($slide['src'], "m/"), 2);
                                    $featuredline = '<iframe width="100%" height="480" allowfullscreen src="http://player.vimeo.com/video/' . $videoid . '?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=0&amp;loop=0"></iframe>';
                                }
                            } else {
                                $featuredline = '<img src="' . aq_resize($featured_image[0], "960", "410", true, true, true) . '" alt=""/>';
                            }
                        }
            
                        if ($issetvideo == true) {
                            ?>
                            <div class="featured_image_full">
                                <?php echo $featuredline; ?>                                
                            </div>
                        <?php
                        }
            
                        if (strlen($featured_image[0]) > 0 && $issetvideo == false) {
                            ?>
                            <a href="<?php echo get_permalink(get_the_ID()); ?>">
                                <div class="featured_image_full">
                                    <?php echo $featuredline; ?>
                                </div>
                            </a>
                        <?php
                        }
                        ?>          
                        <article class="contentarea">
                            <p><?php echo get_the_excerpt(); ?></p>
                        </article>
                    </div>
                    <!-- .blog_item -->    
    
                <?php
                    endwhile;
                    wp_reset_query();
                ?>
                <div class="clear"></div>
            
            </div>
            
            <?php get_sidebar(); ?>
            
            <div class="clear"></div>
            
            <div class="blog_sidebar_pager">
				<?php get_pagination("10", "show_in_shortcodes");?>
            </div>
            
    	</div>
        <!-- .fullscreen_content_padding -->
    </div>
    <!-- .fullscreen_content -->   
        
    </div> <!-- .fullscreen_block -->
    <script>
        $(document).ready(function () {
            if ($(".fullscreen_content_padding").find('div').hasClass("right-sidebar-block")) {
				$(this).find('.blog_sidebar_main').addClass('f_left');
				$('.blog_sidebar_main, .right-sidebar-block').animate({'opacity' : '1'}, 500);				
			}
			else {
				$('.blog_sidebar_main').animate({'opacity' : '1'}, 500);
			}			
        });        
    </script>
<?php get_footer(); ?>