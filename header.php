<!DOCTYPE html>
<!--[if IE 7 ]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html class="ie ie9" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta charset="<?php bloginfo('charset'); ?>">

    <!-- Mobile Specific Metas
   ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Favicon && Apple touch -->
    <link rel="shortcut icon" href="<?php echo get_theme_option('favicon'); ?>" type="image/x-icon">
    <link rel="apple-touch-icon" href="<?php echo get_theme_option('apple_touch_57'); ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_theme_option('apple_touch_72'); ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_theme_option('apple_touch_114'); ?>">

    <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <?php echo get_if_strlen(get_theme_option("custom_css"), "<style>", "</style>"); ?>
    <?php the_theme_option("code_before_head"); ?>
    <script>
        mixajaxurl = "<?php echo get_option("siteurl") ?>/wp-admin/admin-ajax.php";
        themerooturl = "<?php echo THEMEROOTURL; ?>";
    </script>

    <!--[if IE 8 ]>
    <link rel="stylesheet" type="text/css" href="<?php echo THEMEROOTURL; ?>/css/ie_css.css">
    <script>
        var e = ("article,aside,figcaption,figure,footer,header,hgroup,nav,section,time").split(',');
        for (var i = 0; i < e.length; i++) {
            document.createElement(e[i]);
        }
    </script>
    <![endif]-->
    <?php wp_head(); ?>

    <link rel='stylesheet' id='AllFonts-css'  href='<?php echo get_template_directory_uri(); ?>/core/gallery/slick/slick.css' type='text/css' media='all' />
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/core/gallery/slick/slick.js'></script>
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/js/nicescroll.js'></script>

</head>

<body <?php body_class("fullscreen_layout"); ?>>

<a href="#" class="logo"><img src="<?php the_theme_option("logo"); ?>" alt=""
                                                                  width="<?php the_theme_option("header_logo_standart_width"); ?>"
                                                                  height="<?php the_theme_option("header_logo_standart_height"); ?>"
                                                                  class="logo_def"><!--<img
                src="<?php //the_theme_option("logo_retina");º ?>" alt=""
                width="<?php //the_theme_option("header_logo_standart_width"); ?>"
                height="<?php //the_theme_option("header_logo_standart_height"); ?>" class="logo_retina">--></a>

<header class="">
    <div class="sharethis">
        
        <span class='st_facebook_large' displayText='Facebook'></span>
        <span class='st_twitter_large' displayText='Tweet'></span>
        <span class='st_googleplus_large' displayText='Google +'></span>

            


    </div>
    <!--<style type="text/css">
        
    </style>
    <div class="contact-info">
        <span>bettina@bettinaschutze.com</span>
        <span>| <b>Phone: </b> 0055 11 98114 2119 </span>
        <span>| <b>Agency: </b> 0055 11 30428684 </span>
        <span>| <b>Germany: </b> 0049 (0) 1725238027 </span>
    </div>-->
    <div class="header_wrapper container">
       
        <nav>
            <?php wp_nav_menu(array('theme_location' => 'main_menu', 'menu_class' => 'menu', 'depth' => '2')); ?>
            <!-- .menu -->
            <div class="clear"></div>
        </nav>
    </div>
</header>
<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
<script type="text/javascript">stLight.options({publisher: "ec632103-ab0a-470c-bebc-2e3f6c97dfea", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>