<?php
$pf = get_post_format();
if (empty($pf)) $pf = "text";
$featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
$pagebuilder = get_theme_pagebuilder(get_the_ID());
?>

<div <?php post_class("blog_item"); ?>>
    <div class="blog_item-padding">
        <div class="blog_item-wrapper">

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
                        $featuredline = '<iframe width="870" height="290" src="http://www.youtube.com/embed/' . $videoid . '?controls=1&amp;showinfo=0&amp;modestbranding=1&amp;wmode=opaque&amp;autoplay=0" allowfullscreen></iframe>';
                    }

                    #VIMEO
                    $is_vimeo = substr_count($slide['src'], "vimeo");
                    if ($is_vimeo > 0) {
                        $videoid = substr(strstr($slide['src'], "m/"), 2);
                        $featuredline = '<iframe width="870" height="230" allowfullscreen src="http://player.vimeo.com/video/' . $videoid . '?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=0&amp;loop=0"></iframe>';
                    }
                } else {
                    $featuredline = '<img src="' . aq_resize($featured_image[0], "744", "464", true, true, true) . '" alt=""/>';
                }
            }

            if ($issetvideo == true) {
                ?>
                <div class="featured_image_full">
                    <?php echo $featuredline; ?>
                    <div class="gallery_fadder"></div>
                    <div class="ico_gallery"></div>
                </div>
            <?php
            }

            if (strlen($featured_image[0]) > 0 && $issetvideo == false) {
                ?>
                <a href="<?php echo get_permalink(get_the_ID()); ?>">
                    <div class="featured_image_full">
                        <?php echo $featuredline; ?>
                        <div class="gallery_fadder"></div>
                        <div class="ico_gallery"></div>
                    </div>
                </a>
            <?php
            }
            ?>

            <div class="blogpost_type_wrapper">
                <div class="post_type_<?php echo $pf; ?> blogpost_type_ico"></div>
            </div>
            <h6><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
            <article class="contentarea">
                <?php
                echo get_the_excerpt();
                ?>
            </article>
            <div class="fs_blog-meta"><?php the_time("d M Y"); ?> in <?php the_category(', '); ?></div>
        </div>
    </div>
</div>
<!-- .blog_item -->