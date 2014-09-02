<?php
/*
Template Name: Contacts
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

    <div class="fullscreen_block">
        <div class="fullscreen_title">
            <h1><?php the_title(); ?></h1>
            <a href="javascript:history.back()" class="btn_close"></a>
        </div>

        <div class="fullscreen_content_wrapper">
            <div class="fs_map fullscreen_container">
                <?php the_theme_option("google_map"); ?>
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
                        the_theme_option("address_location", "<p><span>Address:</span> ", "</p>");
                        the_theme_option("phone", "<p><span>Phone:</span> ", "</p>");
                        the_theme_option("contacts_to", "<p><span>Email:</span> ", "</p>");
                        the_theme_option("skype", "<p><span>Skype:</span> ", "</p>");
                        ?>
                    </div>
                </div><!-- .row-fluid -->

                <div class="row-fluid">
                    <div class="span12 module_cont module_fs_meta module_none_padding">
                        <?php
                        $compile = "
			<div class='module_content'>
			    <form class='feedback_form' action='' method='post' name='feedback_form'>
			        <label class='label-name'></label>
                    <input type='text' class='field-name form_field' title='".((get_theme_option("translator_status") == "enable") ? get_text("translator_feedback_form_name") : __('Name *','theme_localization'))."' value='".((get_theme_option("translator_status") == "enable") ? get_text("translator_feedback_form_name") : __('Name *','theme_localization'))."' name='field-name'>
                    <label class='label-email'></label>
                    <input type='text' class='field-email form_field' title='".((get_theme_option("translator_status") == "enable") ? get_text("translator_feedback_form_email") : __('Email *','theme_localization'))."' value='".((get_theme_option("translator_status") == "enable") ? get_text("translator_feedback_form_email") : __('Email *','theme_localization'))."' name='field-email'>
                    <label class='label-subject'></label>
                    <input type='text' class='field-subject form_field' title='".((get_theme_option("translator_status") == "enable") ? get_text("translator_feedback_form_subject") : __('Subject','theme_localization'))."' value='".((get_theme_option("translator_status") == "enable") ? get_text("translator_feedback_form_subject") : __('Subject','theme_localization'))."' name='field-subject'>
                    <label class='label-message'></label>
                    <textarea class='field-message form_field' title='".((get_theme_option("translator_status") == "enable") ? get_text("translator_feedback_form_message") : __('Message *','theme_localization'))."' rows='5' cols='45' name='field-message'>".((get_theme_option("translator_status") == "enable") ? get_text("translator_feedback_form_message") : __('Message *','theme_localization'))."</textarea>";

                        $compile .= "    <input type='reset' class='feedback_reset' value='".((get_theme_option("translator_status") == "enable") ? get_text("tranlator_clear") : __('Clear form','theme_localization'))."' id='reset2' name='reset'>
                    <input type='button' value='".((get_theme_option("translator_status") == "enable") ? get_text("tranlator_send_message") : __('Send comment','theme_localization'))."' id='submit2' class='feedback_go' name='submit'>
                </form>
                <div class='ajaxanswer'></div>
			</div>";

                        echo $compile;
                        ?>
                    </div>
                </div><!-- .row-fluid -->

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