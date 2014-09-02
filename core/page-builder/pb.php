<?php

#LOAD FILES
require_once ("pb-config.php");
require_once ("pb-functions.php");
require_once ("pb-ajax-handlers.php");
require_once ("pb-modules.php");
require_once ("pb-parser.php");

#REGISTER SOME CSS/JS
add_action('admin_init', 'pb_init');
function pb_init()
{
    #CSS
    wp_enqueue_style('admin', get_template_directory_uri() . '/core/page-builder/css/pb.css');
    wp_enqueue_style('jscrollpane', get_template_directory_uri() . '/core/page-builder/css/jquery.jscrollpane.css');
    #JS
    wp_enqueue_script('admin', get_template_directory_uri() . '/core/page-builder/js/pb.js');
    wp_enqueue_script('mousewheel', get_template_directory_uri() . '/core/page-builder/js/jquery.mousewheel.js');
    wp_enqueue_script('jscrollpane', get_template_directory_uri() . '/core/page-builder/js/jquery.jscrollpane.min.js');
}

#SAVE
add_action('save_post', 'save_postdata');

#REGISTER PAGE BUILDER
add_action('add_meta_boxes', 'add_custom_box');
function add_custom_box()
{
    global $pbconfig;
    if (is_array($pbconfig['page_builder_enable_for_posts'])) {
        foreach ($pbconfig['page_builder_enable_for_posts'] as $post_type) {
            add_meta_box(
                'pb_section',
                'Work with page',
                'pagebuilder_inner_custom_box',
                $post_type
            );
        }
    }
}


function pagebuilder_inner_custom_box($post)
{
    $now_post_type = get_post_type();

    wp_nonce_field(plugin_basename(__FILE__), 'pagebuilder_noncename');
    $pagebuilder = get_post_meta($post->ID, "pagebuilder", true);
    if (!is_array($pagebuilder)) {
        $pagebuilder = array();
    }
    array_walk_recursive($pagebuilder, 'replace_br_to_rn_in_multiarray');

    global $pbconfig, $modules;

#get all sidebars
    $all_sidebars = get_theme_sidebars_for_admin();
    array_push($all_sidebars, "Default");
    $media_for_this_post = get_media_for_this_post(get_the_ID());
    $js_for_pb = "
    <script>
        var post_id = " . get_the_ID() . ";
        var show_img_media_library_page = 1;
    </script>";

    echo $js_for_pb;
    echo "
<!-- popup background -->
<div class='popup-bg'></div>
<div class='waiting-bg'><div class='waiting-bg-img'></div></div>
";
#START BUILDER AREA
    if (in_array($now_post_type, $pbconfig['pb_modules_enabled_for'])) {
        echo "
<div class='pb-cont page-builder-container'>
    <div class='heading-cont bg_type1'>
        <div class='head-text'>Page Builder</div>
        <div class='show-hide-container'></div>
    </div>
    <div class='pb10'>
        <div class='hideable-content'>
            <div class='padding-cont'>
                <div class='available-modules-cont'>
                    <div class='just-caption'>
                        <img src='" . PBIMGURL . "/add_new_module.png' alt=''>
                    </div>
                    " . get_html_all_available_pb_modules($modules) . "
                </div>
                <div class='clear'></div>
            </div>
            <div class='pb-list-active-modules'>
                <div class='padding-cont'>
                    <ul class='sortable-modules'>
                    ";

        if (isset($pagebuilder['modules']) && is_array($pagebuilder['modules'])) {
            foreach ($pagebuilder['modules'] as $moduleid => $module) {
                if ($module['size'] == "block_1_4") {
                    $size_caption = "1/4";
                }
                if ($module['size'] == "block_1_3") {
                    $size_caption = "1/3";
                }
                if ($module['size'] == "block_1_2") {
                    $size_caption = "1/2";
                }
                if ($module['size'] == "block_2_3") {
                    $size_caption = "2/3";
                }
                if ($module['size'] == "block_3_4") {
                    $size_caption = "3/4";
                }
                if ($module['size'] == "block_1_1") {
                    $size_caption = "1/1";
                }
                echo get_pb_module($module['name'], $module['caption'], $moduleid, $pagebuilder, $module['size'], $size_caption);
            }
        }

        echo "
                    </ul>
                    <div class='clear'></div>
                </div>
            </div>
            <div class='dbg'></div>
        </div>
    </div>
</div>
";
    }
#END BUILDER AREA


#START PAGE SETTINGS AREA
    if (in_array($now_post_type, $pbconfig['page_settings_enabled_for'])) {

        if (!isset($pagebuilder['post-formats']['videourl'])) {$pagebuilder['post-formats']['videourl'] = '';}
        if (!isset($pagebuilder['settings']['layout-sidebars'])) {$pagebuilder['settings']['layout-sidebars'] = '';}
        if (!isset($pagebuilder['post-formats']['video_height'])) {$pagebuilder['post-formats']['video_height'] = $pbconfig['default_video_height'];}

        echo "
<div class='pb-cont page-settings-container'>
    <div class='heading-cont bg_type1'>
        <div class='head-text'>Page settings</div>
        <div class='show-hide-container'></div>
    </div>
    <div class='pb10'>
        <div class='hideable-content'>




            <div class='padding-cont'>";

        if ($now_post_type == "port") {
                echo "
                <div class='text_block' style='padding-top:15px;'>
                    <div class='caption' style='width: 200px;'><h2>Equipment</h2></div>
                    " . pb_setting_input('pagebuilder[settings][equipment]', (isset($pagebuilder['settings']['equipment']) ? $pagebuilder['settings']['equipment'] : ''), '') . "
                    <div class='help_here text-shadow1'></div>
                    <div class='clear'></div>
                </div>
                ";
                echo "
                <div class='text_block' style='padding-top:15px;'>
                    <div class='caption' style='width: 200px;'><h2>Location</h2></div>
                    " . pb_setting_input('pagebuilder[settings][location]', (isset($pagebuilder['settings']['location']) ? $pagebuilder['settings']['location'] : ''), '') . "
                    <div class='help_here text-shadow1'></div>
                    <div class='clear'></div>
                </div>
                ";
                echo "
                <div class='text_block' style='padding-top:15px;'>
                    <div class='caption' style='width: 200px;'><h2>Model</h2></div>
                    " . pb_setting_input('pagebuilder[settings][model]', (isset($pagebuilder['settings']['model']) ? $pagebuilder['settings']['model'] : ''), '') . "
                    <div class='help_here text-shadow1'></div>
                    <div class='clear'></div>
                </div>
                ";
                echo "
                <div class='text_block' style='padding-top:15px;'>
                    <div class='caption' style='width: 200px;'><h2>Style</h2></div>
                    " . pb_setting_input('pagebuilder[settings][style]', (isset($pagebuilder['settings']['style']) ? $pagebuilder['settings']['style'] : ''), '') . "
                    <div class='help_here text-shadow1'></div>
                    <div class='clear'></div>
                </div>
                ";
        }

        echo "</div>
        </div>
    </div>
</div>
";
    }
#END PAGE SETTINGS AREA


#START SLIDERS & BACKGROUND AREA
if ($pbconfig['slider_and_bg_area'] == true && in_array($now_post_type, $pbconfig['slider_and_bg_area_enable_for'])) {
    echo "
<div class='pb-cont hided-state sliders-and-bgs-container'>
    <div class='heading-cont bg_type1'>
        <div class='head-text'>Custom settings</div>
        <div class='show-hide-container'></div>
    </div>
    <div class='pb10'>
        <div class='hideable-content'>";


    if ($pbconfig['enable_fullscreen_slider'] == true && in_array($now_post_type, $pbconfig['fullcreen_slider_enabled_for'])) {
        echo "
            <!-- FULLSCREEN SLIDER SETTINGS -->
            <div class='padding-cont  stand-s pt_" . $now_post_type . "' style='padding-top:20px;padding-bottom:0px;'>
                <div class='bg_or_slider_option slider_type active'>
                    <input type='hidden' name='settings_type' value='fullscreen' class='settings_type'>
                    <div class='heading line_option visual_style1'>
                        <div class='option_title'>Gallery</div>
                        <div class='toggler'>" . toggle_radio_on_off('pagebuilder[sliders][fullscreen][status]', (isset($pagebuilder['sliders']['fullscreen']['status']) ? $pagebuilder['sliders']['fullscreen']['status'] : ''), 'off', 'fullscreen_toggler bg_slide_sett') . "</div>
                        <div class='pre_toggler'></div>
                    </div>
                    <div class='hideable-area'>
                        <div class='padding-cont help text-shadow2'></div>
                        <div class='padding-cont' style='padding-bottom:11px;'>
                            <div class='selected_media'>
                                <div class='append_block'>
                                     <ul class='sortable-img-items'>
                                       " . get_slider_items("fullscreen", (isset($pagebuilder['sliders']['fullscreen']['slides']) ? $pagebuilder['sliders']['fullscreen']['slides'] : '')) . "
                                     </ul>
                                </div>
                                <div class='clear'></div>
                            </div>
                        </div>
                        <div style='' class='hr_double style2'></div>
                        <div class='padding-cont' style='padding-top:12px;'>
                            <h2 class='dark_bg' style='margin-bottom:0px;'>select media</h2>
                            <div class='available_media'>
                                <div class='ajax_cont'>
                                    " . get_media_html($media_for_this_post, "small") . "
                                </div>
                                <div class='img-item style_small add_image_to_sliders_available_media cboxElement'>
                                    <div class='img-preview'>
                                        <img alt='' src='" . PBIMGURL . "/add_image.png'>
                                    </div>
                                </div><!-- .img-item -->
                                <div class='img-item style_small add_video_slider'>
                                    <div class='img-preview'>
                                        <img alt='' class='previmg' data-full-url='" . PBIMGURL . "/video_item.png' src='" . PBIMGURL . "/add_video.png'>
                                    </div>
                                </div><!-- .img-item -->
                                <div class='clear'></div>
                            </div>
                        </div>
                        <div class='hr_double style2'></div>
                    </div>
                </div>
            </div>
            <!-- END FULLSCREEN SLIDER SETTINGS -->";
    }


    if ($pbconfig['enable_fullwidth_slider'] == true && in_array($now_post_type, $pbconfig['fullwidth_slider_enabled_for'])) {
        echo "
            <!-- FULLWIDTH SLIDER SETTINGS -->
            <div class='padding-cont  stand-s pt_" . $now_post_type . "' style='padding-top:20px;padding-bottom:0px;'>
                <div class='bg_or_slider_option slider_type active'>
                    <input type='hidden' name='settings_type' value='fullwidth' class='settings_type'>
                    <div class='heading line_option visual_style1'>
                        <div class='option_title'>Full width</div>
                        <div class='toggler'>" . toggle_radio_on_off('pagebuilder[sliders][fullwidth][status]', $pagebuilder['sliders']['fullwidth']['status'], 'off', 'fullwidth_toggler bg_slide_sett') . "</div>
                        <div class='pre_toggler'></div>
                    </div>
                    <div class='hideable-area'>
                        <div class='padding-cont help text-shadow2'>Fullwidth slider description</div>
                        <div class='padding-cont' style='padding-bottom:11px;'>
                            <div class='selected_media'>
                                <div class='append_block'>
                                     <ul class='sortable-img-items'>
                                       " . get_slider_items("fullwidth", $pagebuilder['sliders']['fullwidth']['slides']) . "
                                     </ul>
                                </div>
                                <div class='clear'></div>
                            </div>
                        </div>
                        <div style='' class='hr_double style2'></div>
                        <div class='padding-cont' style='padding-top:12px;'>
                            <h2 class='dark_bg' style='margin-bottom:0px;'>select media</h2>
                            <div class='available_media'>
                                <div class='ajax_cont'>
                                    " . get_media_html($media_for_this_post, "small") . "
                                </div>
                                <div class='img-item style_small add_image_to_sliders_available_media cboxElement'>
                                    <div class='img-preview'>
                                        <img alt='' src='" . PBIMGURL . "/add_image.png'>
                                    </div>
                                </div><!-- .img-item -->
                                <div class='img-item style_small add_video_slider'>
                                    <div class='img-preview'>
                                        <img alt='' class='previmg' data-full-url='" . PBIMGURL . "/video_item.png' src='" . PBIMGURL . "/add_video.png'>
                                    </div>
                                </div><!-- .img-item -->
                                <div class='clear'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END FULLWIDTH SLIDER SETTINGS -->";
    }


    if ($pbconfig['enable_background_image'] == true && in_array($now_post_type, $pbconfig['bg_image_enabled_for'])) {

        if (get_theme_option("show_bg_img_by_default") == "yes") {
            if (strlen($pagebuilder['settings']['bg_image']['src']) < 1) {
                $pagebuilder['settings']['bg_image']['src'] = get_theme_option("bg_img");
            }
        }

        /* Default value for page bg */
        if (!isset($pagebuilder['settings']['bg_image']['src'])) {$pagebuilder['settings']['bg_image']['src']="";}
        if (strlen($pagebuilder['settings']['bg_image']['src']) < 1) {
            $pagebuilder['settings']['bg_image']['src'] = get_theme_option("bg_img");
        }

        if (get_theme_option("show_bg_img_by_default") == "on") {
            $bg_img_open_state = "on";
        } else {
            $bg_img_open_state = "off";
        }

        if (!isset($pagebuilder['settings']['bg_image']['type'])) {$pagebuilder['settings']['bg_image']['type']="";}
        if (strlen($pagebuilder['settings']['bg_image']['type']) < 1) {
            $pagebuilder['settings']['bg_image']['type'] = get_theme_option("default_bg_img_position");
        }

        /*echo "
        <!-- LAYOUT SETTINGS -->
        <div class='padding-cont stand-s layout-settings' style='padding-top:20px;padding-bottom:0px;'>
        <h2 class='dark_bg' style='margin-bottom:10px;line-height: 15px !important;'>Select layout</h2>
        <select class='newselect type_on_dark_bg' name='pagebuilder[settings][layouts][type]' style='width:190px;'>";
        echo get_select_options_with_caption(array("default"=>"Default", "clean"=>"Clean", "boxed"=>"Boxed", "fullscreen_bg_image"=>"Fullscreen bg image"), $pagebuilder['settings']['layouts']['type']);
        echo "
        </select>
        </div>
        <!-- END LAYOUT SETTINGS -->
        ";*/

        echo "
            <!-- BACKGROUND IMAGE SETTINGS -->
            <div class='padding-cont  stand-s' style='padding-top:20px;padding-bottom:0px;'>
                <div class='bg_or_slider_option bg_type active'>
                    <input type='hidden' name='settings_type' value='background_image' class='settings_type'>
                    <div class='heading line_option visual_style1'>
                        <div class='option_title'>Background image</div>
                        <div class='toggler'>" . toggle_radio_on_off('pagebuilder[settings][bg_image][status]', (isset($pagebuilder['settings']['bg_image']['status']) ? $pagebuilder['settings']['bg_image']['status'] : ''), $bg_img_open_state, 'bgimage_toggler bg_slide_sett') . "</div>
                        <div class='pre_toggler'></div>
                    </div>
                    <div class='hideable-area'>
                        <div class='padding-cont' style='padding-bottom:11px;'>
                            <div class='bg_for_this_page w2 fl'>
                                <div class='img-item'>
                                    <input type='hidden' class='bg_image_src' value='{$pagebuilder['settings']['bg_image']['src']}' name='pagebuilder[settings][bg_image][src]'>
                                    <input type='hidden' class='bg_image_type' value='{$pagebuilder['settings']['bg_image']['type']}' name='pagebuilder[settings][bg_image][type]'>
                                    <div class='img-preview'>
                                        <img class='preview_bg_image' src='" . aq_resize($pagebuilder['settings']['bg_image']['src'], "156", "106", true, true, true) ."' alt=''>
                                    </div>
                                </div>
                            </div>";
                            /*<div class='w8 fl right_block'>
                                <h2 class='dark_bg' style='margin-bottom:10px;line-height: 15px !important;'>choose image position</h2>
                                <select class='newselect type_on_dark_bg' name='pagebuilder[settings][bg_image][type]' style='width:350px;'>";
        the_select_options($pbconfig['page_bg_available_types'], $pagebuilder['settings']['bg_image']['type']);
        echo "  </select>
                                <div class='help'>

                                </div>
                            </div> */
                echo "      <div class='clear'></div>
                        </div>
                        <div style='' class='hr_double style2'></div>
                        <div class='padding-cont' style='padding-top:12px;'>
                            <h2 class='dark_bg' style='margin-bottom:0px;'>select image</h2>
                            <div class='available_media'>
                                <div class='ajax_cont'>
                                    " . get_media_html($media_for_this_post, "small") . "
                                </div>
                                <div class='img-item style_small add_image_to_sliders_available_media cboxElement'>
                                    <div class='img-preview'>
                                        <img alt='' src='" . PBIMGURL . "/add_image.png'>
                                    </div>
                                </div><!-- .img-item -->
                                <div class='clear'></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END BACKGROUND IMAGE SETTINGS -->";
    }


    if ($pbconfig['enable_background_color'] == true && in_array($now_post_type, $pbconfig['bg_color_enabled_for'])) {

        if (get_theme_option("show_bg_color_by_default") == "on") {
            $show_color_by_default = "on";
        } else {
            $show_color_by_default = "off";
        }

        if (!isset($pagebuilder['settings']['custom_color']['value'])) {
            $pagebuilder['settings']['custom_color']['value'] = get_theme_option("default_bg_color");
        }

        echo "
            <!-- BACKGROUND COLOR SETTINGS -->
            <div class='padding-cont stand-s' style='padding-top:20px;'>
                <div class='bg_or_slider_option custom_color_type active'>
                    <input type='hidden' name='settings_type' value='custom_color' class='settings_type'>
                    <div class='heading line_option visual_style1'>
                        <div class='option_title'>Background color</div>
                        <div class='toggler'>" . toggle_radio_on_off('pagebuilder[settings][custom_color][status]', (isset($pagebuilder['settings']['custom_color']['status']) ? $pagebuilder['settings']['custom_color']['status'] : ''), $show_color_by_default, 'bgcolor_toggler bg_slide_sett') . "</div>
                        <div class='pre_toggler'></div>
                    </div>
                    <div class='hideable-area'>
                        <div class='padding-cont' style='padding-bottom:20px;'>
                            <h2 style='margin-bottom:10px;line-height: 15px !important;' class='dark_bg'>choose background color</h2>
                            <div class='left_block'>
                                " . colorpicker_block("pagebuilder[settings][custom_color][value]", (isset($pagebuilder['settings']['custom_color']['value']) ? $pagebuilder['settings']['custom_color']['value'] : ''), "background_color") . "
                            </div>
                            <div class='right_block help' style='padding-left:12px;padding-top:2px;'>

                            </div>
                            <div class='clear'></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END BACKGROUND COLOR SETTINGS -->";
    }


    echo "
        </div>
    </div>
</div>
";
}
#END SLIDERS & BACKGROUND AREA


#JS FOR AJAX UPLOADER
    ?>
<script type="text/javascript">

    function reactivate_ajax_image_upload() {
        var admin_ajax = '<?php echo admin_url("admin-ajax.php"); ?>';
        $('.btn_upload_image').each(function () {
            var clickedObject = jQuery(this);
            var clickedID = jQuery(this).attr('id');
            new AjaxUpload(clickedID, {
                action:'<?php echo admin_url("admin-ajax.php"); ?>',
                name:clickedID, // File upload name
                data:{ // Additional data to send
                    action:'mix_ajax_post_action',
                    type:'upload',
                    data:clickedID },
                autoSubmit:true, // Submit file after selection
                responseType:false,
                onChange:function (file, extension) {
                },
                onSubmit:function (file, extension) {
                    clickedObject.text('Uploading'); // change button text, when user selects file
                    this.disable(); // If you want to allow uploading only 1 file at time, you can disable upload button
                    interval = window.setInterval(function () {
                        var text = clickedObject.text();
                        if (text.length < 13) {
                            clickedObject.text(text + '.');
                        }
                        else {
                            clickedObject.text('Uploading');
                        }
                    }, 200);
                },
                onComplete:function (file, response) {

                    window.clearInterval(interval);
                    clickedObject.text('Upload Image');
                    this.enable(); // enable upload button

                    // If there was an error
                    if (response.search('Upload Error') > -1) {
                        var buildReturn = '<span class="upload-error">' + response + '</span>';
                        jQuery(".upload-error").remove();
                        clickedObject.parent().after(buildReturn);

                    }
                    else {
                        var buildReturn = '<a href="' + response + '" class="uploaded-image" target="_blank"><img class="hide option-image" id="image_' + clickedID + '" src="' + response + '" alt="" /></a>';

                        jQuery(".upload-error").remove();
                        jQuery("#image_" + clickedID).remove();
                        clickedObject.parent().next().after(buildReturn);
                        jQuery('img#image_' + clickedID).fadeIn();
                        clickedObject.next('span').fadeIn();
                        clickedObject.parent().prev('input').val(response);
                    }
                }
            });
        });
    }


    $(document).ready(function () {
        reactivate_ajax_image_upload();
    });
</script>
<?php #END JS FOR AJAX UPLOADER ?>

<?php
#DEVELOPER CONSOLE
    if ($pbconfig['dev_console'] == true || get_theme_option("dev_console") == "true") {
        echo "<pre style='color:#000000;'>";
        print_r($pagebuilder);
        echo "</pre>";
    }

}

#START SAVE MODULE
function save_postdata($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    #if (!wp_verify_nonce($_POST['pagebuilder_noncename'], plugin_basename(__FILE__)))
    #    return;

    #CHECK PERMISSIONS
    if (!current_user_can('edit_post', $post_id))
        return;

    #START SAVING
    if (isset($_POST['pagebuilder'])) {
        update_theme_pagebuilder($post_id, "pagebuilder", $_POST['pagebuilder']);
    }
}

?>