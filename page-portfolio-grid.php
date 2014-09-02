<?php
/*
Template Name: Portfolio - Grid
*/
get_header();
the_post();

wp_enqueue_script('js_isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), false, false);
wp_enqueue_script('js_sorting', get_template_directory_uri() . '/js/sorting.js');
wp_enqueue_script('js_waypoint', get_template_directory_uri() . '/js/waypoint.js');

$view_type_class = "fs_grid_module";
$items_on_start = 30;
$items_per_click = 5;
$category = "all";

?>



    <div class="fullscreen_block">
        <?php
        #Filter
        echo '
            <div class="filter_block">
                <div class="filter_navigation" >
                    <ul class="splitter" id="options">
                        <li>';
        showPortCategoryWithAjax();
        echo '      </li>
                    </ul>
                </div>
            </div>
                ';
        #START PORTFOLIO
        echo '<div class="portfolio_block image-grid ' . $view_type_class . '" id="list">';

        echo '
    </div><!-- .portfolio_block -->
    <div class="clear"><!-- ClearFix --></div>
    <div class="load_more_cont">';
        echo '<a class="btn_load_more btn_load_more_fs get_portfolio_works_btn" href="#">' . ((get_theme_option("translator_status") == "enable") ? get_text("translator_load_more") : __('Load more works', 'theme_localization')) . '<span></span></a>';
        echo '
    </div>
    ';
        ?>
        <script>

            /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!CONFIG!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/
            var html_template = "<?php echo $view_type_class; ?>";
            var now_open_works = 0;
            var first_load = true;
            var tempWayI = 0;
            /*!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!CONFIG!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!*/

            function get_portfolio_works(this_obj) {
                if (typeof(this_obj) == "undefined") {
                    data_option_value = "*";
                }
                else {
                    var data_option_value = this_obj.attr("data-option-value");
                }

                if (first_load == true) {
                    works_per_load = <?php echo $items_on_start; ?>;
                    first_load = false;
                } else {
                    works_per_load = <?php echo $items_per_click; ?>;
                }

                $.ajax({
                    type: "POST",
                    url: mixajaxurl,
                    data: "html_template=" + html_template + "&now_open_works=" + now_open_works + "&action=get_portfolio_works" + "&works_per_load=" + works_per_load + "&category=<?php echo $category; ?>",
                    success: function (result) {

                        if (result.length < 1) {
                            jQuery(".load_more_cont").hide("fast");
                        }
                        now_open_works = now_open_works + works_per_load;
                        var $newItems = jQuery(result);
                        jQuery(".portfolio_block").isotope('insert', $newItems, function () {
                            jQuery(".portfolio_block").ready(function () {
                                jQuery(".image-grid").isotope('reLayout');
                            });
                        });
						setTimeout("portfolio_update()",1000);                    }
                });
                tempWayI++;
            }

            $(window).resize(function () {
                jQuery('.image-grid').isotope('reLayout');
            });

			function portfolio_update() {
				jQuery('.gallery_item').each(function(){
					jQuery(this).find('.gallery_descr').css('bottom' , -1*(jQuery(this).height()+60)+'px');
					place_icon = (jQuery(this).height()-jQuery(this).find('.gallery_descr').height()-43-jQuery(this).find('.ico_gallery').height())/2;
					jQuery(this).find('.ico_gallery').css('top', place_icon+'px');
				});
				setTimeout("jQuery('.image-grid').isotope('reLayout')",500);
			}

            jQuery(".get_portfolio_works_btn").click(function () {
                get_portfolio_works();
                return false;
            });
            jQuery(window).load(function () {
                get_portfolio_works();
                setTimeout("jQuery('.image-grid').isotope('reLayout')", 1000);
            });

            /*jQuery(document).ready(function(){
                jQuery('.btn_load_more_fs').waypoint(function(direction){
                    if (direction == 'down' && tempWayI > 0) {
                        get_portfolio_works();
                        setTimeout("$.waypoints('refresh')",500);
                    }
                },{offset: '90%'});
            });*/


        </script>
    </div><!-- .fullscreen_block -->
<?php get_footer(); ?>