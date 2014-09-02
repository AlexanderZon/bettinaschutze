<?php header("Content-type: text/css");
$wp_include = "../../../../wp-load.php";
$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {
    $wp_include = "../$wp_include";
}

require($wp_include);

global $themeconfig;
if ($themeconfig['custom_fonts'] == true) {
    if (is_array($themeconfig['custom_fonts_array'])) {
        foreach ($themeconfig['custom_fonts_array'] as $id => $font) {
            if ($font['font_file_name'] !== "default_font") {
                echo "
                @font-face {
                    font-family: '" . $font['font_family'] . "';
                    src: url('" . THEMEROOTURL . "/css/../fonts/" . $font['font_file_name'] . ".eot');
                    src: url('" . THEMEROOTURL . "/css/../fonts/" . $font['font_file_name'] . ".eot?#iefix') format('embedded-opentype'),
                         url('" . THEMEROOTURL . "/css/../fonts/" . $font['font_file_name'] . ".woff') format('woff'),
                         url('" . THEMEROOTURL . "/css/../fonts/" . $font['font_file_name'] . ".ttf') format('truetype'),
                         url('" . THEMEROOTURL . "/css/../fonts/" . $font['font_file_name'] . ".svg#" . $font['svg_id'] . "') format('svg');
                    font-weight: " . $font['font_weight'] . ";
                    font-style: " . $font['font_style'] . ";

                }
                ";
            }
        }
    }
}

$themecolor1 = get_theme_option("theme_color1");
$additional_font = get_theme_option("additional_font");

#Fonts & colors
$footer_background_color = get_theme_option("footer_background_color");
$footer_text_color = get_theme_option("footer_text_color");
$content_text_color = get_theme_option("content_text_color");
$text_headers_font = get_theme_option("text_headers_font");
$main_content_font = get_theme_option("main_content_font");

$h1_font_size = get_theme_option("h1_font_size");
$h1_line_height = substr(get_theme_option("h1_font_size"), 0, -2);
$h1_line_height = (int)$h1_line_height + 2;
$h1_line_height = $h1_line_height . "px";

$h2_font_size = get_theme_option("h2_font_size");
$h2_line_height = substr(get_theme_option("h2_font_size"), 0, -2);
$h2_line_height = (int)$h2_line_height + 2;
$h2_line_height = $h2_line_height . "px";

$h3_font_size = get_theme_option("h3_font_size");
$h3_line_height = substr(get_theme_option("h3_font_size"), 0, -2);
$h3_line_height = (int)$h3_line_height + 2;
$h3_line_height = $h3_line_height . "px";

$h4_font_size = get_theme_option("h4_font_size");
$h4_line_height = substr(get_theme_option("h4_font_size"), 0, -2);
$h4_line_height = (int)$h4_line_height + 2;
$h4_line_height = $h4_line_height . "px";

$h5_font_size = get_theme_option("h5_font_size");
$h5_line_height = substr(get_theme_option("h5_font_size"), 0, -2);
$h5_line_height = (int)$h5_line_height + 2;
$h5_line_height = $h5_line_height . "px";

$h6_font_size = get_theme_option("h6_font_size");
$h6_line_height = substr(get_theme_option("h6_font_size"), 0, -2);
$h6_line_height = (int)$h6_line_height + 2;
$h6_line_height = $h6_line_height . "px";

$main_content_font_size = get_theme_option("main_content_font_size");
$main_content_line_height = get_theme_option("main_content_line_height");
?>
/* *** F O N T   F A M I L I E S  *** */

@font-face {
font-family: 'CoreIconsRegular';
src: url('../fonts/coreicons-webfont.eot');
src: url('../fonts/coreicons-webfont.eot?#iefix') format('embedded-opentype'),
url('../fonts/coreicons-webfont.woff') format('woff'),
url('../fonts/coreicons-webfont.ttf') format('truetype'),
url('../fonts/coreicons-webfont.svg#coreiconsregular') format('svg');
font-weight: normal;
font-style: normal;

}
* {
font-family:'<?php echo $additional_font; ?>', Helvetica, sans-serif;
font-weight:400;
}

.call_us .ico,
.ico,
.shortcode_iconbox .ico span {
font-family: 'CoreIconsRegular';
}

/* ***  F O N T   S E T T I N G S  *** */

p, td, div,
blockquote p {
font-size:13px;
line-height:16px;
}

header .top_line .call_us,
header .top_line .slogan {
line-height:14px;
font-size:11px;
}

h1, h2, h3, h4, h5, h6,
h1 span, h2 span, h3 span, h4 span, h5 span, h6 span,
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
text-decoration:none!important;
padding:0;
color:#46434e;
}

header nav ul.menu > li > a,
.widget_nav_menu ul li a,
.widget_archive ul li a,
.widget_pages ul li a,
.widget_categories ul li a,
.widget_recent_entries ul li a,
.dropcap,
.widget_mailchimpsf_widget .mc_submit,
.shortcode_accordion_item_title,
.shortcode_toggles_item_title,
.feedback_form .feedback_go,
.feedback_form .feedback_reset,
#commentform #reset,
#commentform #submit,
.btn_login,
.shortcode_promoblock .promo_button_block a,
.shortcode_tab_item_title,
.price_item .price_item_btn a,
.shortcode_button,
.filter_navigation ul li ul li a {
font-family:'<?php echo $additional_font; ?>', sans-serif!important;
}

* {
font-family: '<?php echo $main_content_font; ?>', Helvetica, sans-serif;
color:#6e6c74;
}

input, button, select, textarea {
font-family:Arial, Helvetica, sans-serif!important;
}

h1, h2, h3, h4, h5, h6,
h1 span, h2 span, h3 span, h4 span, h5 span, h6 span,
h1 a, h2 a, h3 a, h4 a, h5 a, h6 a {
font-family:'<?php echo $additional_font; ?>', sans-serif!important;
}

h1, h1 span, h1 a {
font-size:<?php echo $h1_font_size; ?> !important;
line-height:<?php echo $h1_line_height; ?> !important;
}
h2, h2 span, h2 a {
font-size:<?php echo $h2_font_size; ?> !important;
line-height:<?php echo $h2_line_height; ?> !important;
}
h3, h3 span, h3 a {
font-size:<?php echo $h3_font_size; ?> !important;
line-height:<?php echo $h3_line_height; ?> !important;
}
h4, h4 span, h4 a {
font-size:<?php echo $h4_font_size; ?> !important;
line-height:<?php echo $h4_line_height; ?> !important;
}
h5, h5 span, h5 a {
font-size:<?php echo $h5_font_size; ?> !important;
line-height:<?php echo $h5_line_height; ?> !important;
}
h6, h6 span, h6 a {
font-size:<?php echo $h6_font_size; ?> !important;
line-height:<?php echo $h6_line_height; ?> !important;
}

/* ***  C O L O R   O P T I O N S  *** */

/* *** MAIN COLOR: #ff5474 *** */

::selection {background:#<?php echo $themecolor1; ?>;}
::-moz-selection {background:#<?php echo $themecolor1; ?>;}

.highlighted_colored,
.widget_nav_menu ul li a:hover,
.widget_archive ul li a:hover,
.widget_pages ul li a:hover,
.widget_categories ul li a:hover,
.widget_recent_entries ul li a:hover,
blockquote.type1:before,
.shortcode_accordion_item_title:hover,
.shortcode_toggles_item_title:hover,
.feedback_form .feedback_go:hover,
.feedback_form .feedback_reset:hover,
#commentform #reset:hover,
#commentform #submit:hover,
.btn_login:hover,
.module_iconboxes:hover,
.carousel_fadder,
.gallery_fadder,
.shortcode_promoblock .promo_button_block a,
.shortcode_tab_item_title:hover,
.skills_list li .skill_div,
.price_item.most_popular .price_item_title,
.price_item .price_item_btn a:hover,
.price_item.most_popular .price_item_btn a,
.shortcode_button.btn_type4,
.pagerblock li a:hover,
.widget_tag_cloud a:hover,
.fs_thmb_viewport .fs_thmb_list li .fs_thmb_fadder,
.fs_grid_module .grid_gallery-item .item_hover-img .item_hover-fadder {
background-color:#<?php echo $themecolor1; ?>;
}
.widget_mailchimpsf_widget .mc_submit:hover,
.flickr_fadder,
.shortcode_button.btn_type1:hover {
background-color:#<?php echo $themecolor1; ?>!important;
}
header nav ul.menu  li .sub-menu a {
background:#<?php echo $themecolor1; ?>;
background:rgba(<?php echo HexToRGB($themecolor1); ?>,0.9);
}
header nav ul.menu  li .sub-menu li {
border-top-color:rgba(<?php echo HexToRGB($themecolor1); ?>,0.7);
}
a,
.dropcap.colored,
#footer_bar .recent_posts_content .post_title,
.featured_slider ul li .carousel_meta a:hover,
.shortcode_promoblock h3,
.module_contact_info a:hover,
.columns1 .portfolio_meta span a:hover,
.blog_head .blogpost_meta span a:hover,
.fs_blog_module .fs_blog-meta a:hover,
.module_fs_meta a:hover,
.twitter_list li a {
color:#<?php echo $themecolor1; ?>;
}
header ul.menu > li > a:hover,
header ul.menu > li:hover > a,
header ul.menu > li.current-menu-item > a,
header ul.menu > li.current-menu-parent > a,
ol.commentlist li .thiscommentbody .comment_info span a:hover,
.fullscreen_block .filter_block li a:hover,
.fullscreen_block .filter_block li.selected a,
.mobile_menu li > a:hover,
.mobile_menu li.current-menu-item > a,
.mobile_menu li.current-menu-parent > a,
.fs_blog_module .blog_item h6 a:hover,
.fs_blog_pager a:hover,
.fs_blog_pager a.current,
.btn_load_more_fs:hover {
color:#<?php echo $themecolor1; ?>!important;
}

hr.colored,
.fullscreen_title h1 {
border-color:#<?php echo $themecolor1; ?>;
}
.fs_title_wrapper {
border-color:#<?php echo $themecolor1; ?>!important;
}

header nav ul.menu  li > .sub-menu > li:first-child:before {
border-left: 5px solid transparent;
border-right: 5px solid transparent;
border-bottom: 5px solid #<?php echo $themecolor1; ?>;
}
.fullscreen_layout header nav ul.menu  li > .sub-menu > li:last-child:before {
border-left: 5px solid transparent;
border-right: 5px solid transparent;
border-top: 5px solid #<?php echo $themecolor1; ?>;
}

.blog_sidebar_pager .fs_blog_pager .pagerblock li a:hover {background-color:#<?php echo $themecolor1; ?> !important;
}
.blog_sidebar_pager .fs_blog_pager .pagerblock li a.current {background: #46434E !important;
}





