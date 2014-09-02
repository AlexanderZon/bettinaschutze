<?php

$tabs = new Tabs();

$tabs->add(new Tab(array(
    'name' => 'General',
    'desc' => '',
    'icon' => 'general.png',
    'icon_active' => 'general_active.png',
    'icon_hover' => 'general_hover.png'
), array(
    new UploadOption(array(
        'name' => 'Header logo',
        'id' => 'logo',
        'desc' => 'Default: 125px x 39px',
        'default' => THEMEROOTURL . '/img/logo.png'
    )),
    new UploadOption(array(
        'name' => 'Logo (Retina)',
        'id' => 'logo_retina',
        'desc' => 'Default: 250px x 78px',
        'default' => THEMEROOTURL . '/img/retina/logo.png'
    )),
    new textOption(array(
        'name' => 'Header logo width',
        'id' => 'header_logo_standart_width',
        'not_empty' => true,
        'width' => '100px',
        'textalign' => 'center',
        'default' => '125'
    )),
    new textOption(array(
        'name' => 'Header logo height',
        'id' => 'header_logo_standart_height',
        'not_empty' => true,
        'width' => '100px',
        'textalign' => 'center',
        'default' => '39'
    )),
    new UploadOption(array(
        'type' => 'upload',
        'name' => 'Favicon',
        'id' => 'favicon',
        'desc' => 'Icon must be 16x16px or 32x32px',
        'default' => THEMEROOTURL . '/img/favicon.ico'
    )),
    new UploadOption(array(
        'type' => 'upload',
        'name' => 'Apple touch icon (57px)',
        'id' => 'apple_touch_57',
        'desc' => 'Icon must be 57x57px',
        'default' => THEMEROOTURL . '/img/apple_icons_57x57.png'
    )),
    new UploadOption(array(
        'type' => 'upload',
        'name' => 'Apple touch icon (72px)',
        'id' => 'apple_touch_72',
        'desc' => 'Icon must be 72x72px',
        'default' => THEMEROOTURL . '/img/apple_icons_72x72.png'
    )),
    new UploadOption(array(
        'type' => 'upload',
        'name' => 'Apple touch icon (114px)',
        'id' => 'apple_touch_114',
        'desc' => 'Icon must be 114x114px',
        'default' => THEMEROOTURL . '/img/apple_icons_114x114.png'
    )),
    new TextareaOption(array(
        'name' => 'Custom CSS',
        'id' => 'custom_css',
        'default' => ''
    )),
    new TextareaOption(array(
        'name' => 'Google analytics or any other code<br>(before &lt;/head&gt;)',
        'id' => 'code_before_head',
        'default' => ''
    )),
    new TextareaOption(array(
        'name' => 'Any code <br>(before &lt;/body&gt;)',
        'id' => 'code_before_body',
        'default' => ''
    )),
    new AjaxButtonOption(array(
        'title' => 'Import Sample Data',
        'id' => 'action_import',
        'name' => 'Import demo content',
        'confirm' => TRUE,
        'data' => array(
            'action' => 'ajax_import_dump'
        )
    ))
)));


$tabs->add(new Tab(array(
    'name' => 'Fonts',
    'desc' => '',
    'icon' => 'fonts.png',
    'icon_active' => 'fonts_active.png',
    'icon_hover' => 'fonts_hover.png'
), array(
    new FontSelector(array(
        'name' => 'Main font',
        'id' => 'additional_font',
        'desc' => '',
        'default' => 'Open Sans',
        'options' => get_fonts_array_only_key_name()
    )),
    new textOption(array(
        'name' => 'Main font parameters',
        'id' => 'google_font_parameters_main_font',
        'not_empty' => true,
        'default' => ':400,600,700,800,400italic,600italic,700italic',
        'width' => '100%',
        'textalign' => 'left',
        'desc' => 'Google font. Click <a href="https://developers.google.com/webfonts/docs/getting_started" target="_blank">here</a> for help.'
    )),
    new FontSelector(array(
        'name' => 'Content',
        'id' => 'main_content_font',
        'desc' => '',
        'default' => 'Arial',
        'options' => get_fonts_array_only_key_name()
    )),
    new textOption(array(
        'name' => 'Content font parameters',
        'id' => 'google_font_parameters_main_content_font',
        'not_empty' => true,
        'default' => ':400,600,700,800,400italic,600italic,700italic',
        'width' => '100%',
        'textalign' => 'left',
        'desc' => 'Google font. Click <a href="https://developers.google.com/webfonts/docs/getting_started" target="_blank">here</a> for help.'
    )),
    new textOption(array(
        'name' => 'H1 font size',
        'id' => 'h1_font_size',
        'not_empty' => true,
        'default' => '32px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption(array(
        'name' => 'H2 font size',
        'id' => 'h2_font_size',
        'not_empty' => true,
        'default' => '28px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption(array(
        'name' => 'H3 font size',
        'id' => 'h3_font_size',
        'not_empty' => true,
        'default' => '24px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption(array(
        'name' => 'H4 font size',
        'id' => 'h4_font_size',
        'not_empty' => true,
        'default' => '20px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption(array(
        'name' => 'H5 font size',
        'id' => 'h5_font_size',
        'not_empty' => true,
        'default' => '18px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
    new textOption(array(
        'name' => 'H6 font size',
        'id' => 'h6_font_size',
        'not_empty' => true,
        'default' => '16px',
        'width' => '100px',
        'textalign' => 'center',
        'desc' => ''
    )),
)));


$tabs->add(new Tab(array(
    'name' => 'Contacts',
    'icon' => 'contacts.png',
    'icon_active' => 'contacts_active.png',
    'icon_hover' => 'contacts_hover.png'
), array(
    new TextOption(array(
        'name' => 'Send mails to',
        'id' => 'contacts_to',
        'not_empty' => true,
        'default' => get_option("admin_email")
    )),
    new TextOption(array(
        'name' => 'Phone number',
        'id' => 'phone',
        'default' => '+1 800 789 50 12'
    )),
    new TextOption(array(
        'name' => 'Address',
        'id' => 'address_location',
        'default' => '5512 Lorem Ipsum Vestibulum 666/13.'
    )),
    new TextOption(array(
        'name' => 'Skype',
        'id' => 'skype',
        'default' => 'some_name'
    )),
    new TextareaOption(array(
        'name' => 'Google map',
        'id' => 'google_map',
        'default' => '<iframe src="http://maps.google.ca/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=New+York&amp;sll=49.891235,-97.15369&amp;sspn=47.259509,86.923828&amp;ie=UTF8&amp;hq=&amp;hnear=New+York,+United+States&amp;ll=40.714867,-74.005537&amp;spn=0.019517,0.018797&amp;z=14&amp;iwloc=near&amp;output=embed"></iframe>'
    )),
)));


$tabs->add(new Tab(array(
    'name' => 'View Options',
    'icon' => 'colors.png',
    'icon_active' => 'colors_active.png',
    'icon_hover' => 'colors_hover.png'
), array(
    new ColorOption(array(
        'name' => 'Theme color',
        'id' => 'theme_color1',
        'desc' => '',
        'not_empty' => 'true',
        'default' => 'ff5474'
    )),
    new SelectOption(array(
        'name' => 'Menu position',
        'id' => 'menu_position',
        'default' => 'bottom',
        'options' => array(
            'bottom' => 'Bottom',
            'top' => 'Top'
        )
    )),
    new SelectOption(array(
        'name' => 'Theme skin',
        'id' => 'theme_layout',
        'default' => 'dark',
        'options' => array(
            'dark' => 'Dark',
            'light' => 'Light'
        )
    )),
    new SelectOption(array(
        'name' => 'Thumbs (fullscreen gallery)',
        'id' => 'fullscreen_gallery_thumbs',
        'default' => 'show',
        'options' => array(
            'show' => 'Show',
            'hide' => 'Hide'
        )
    )),
    new SelectOption(array(
        'name' => 'Blog post style',
        'id' => 'blog_post_style',
        'default' => 'default',
        'options' => array(
            'default' => 'Default',
            'fullwidth' => 'Full width'
        )
    )),
)));

/* TRANSLATOR */
$tabs->add(new Tab(array(
    'name' => 'Translator',
    'icon' => 'translator.png',
    'icon_active' => 'translator_active.png',
    'icon_hover' => 'translator_hover.png'
), array(
    new SelectOption(array(
        'name' => 'Custom translator status',
        'id' => 'translator_status',
        'desc' => 'If you want to use .po .mo files, please disable custom translator, otherwise you can use the custom translator below.',
        'default' => 'enable',
        'options' => array(
            'enable' => 'Enable',
            'disable' => 'Disable'
        )
    )),
    new textOption(array(
        'name' => 'Collapse',
        'id' => 'collapse',
        'not_empty' => false,
        'default' => 'Collapse',
        'desc' => 'Collapse'
    )),
    new textOption(array(
        'name' => 'Show info',
        'id' => 'show_info',
        'not_empty' => false,
        'default' => 'Show info',
        'desc' => 'Show info'
    )),
    new textOption(array(
        'name' => '404 Error',
        'id' => 'translator_404error',
        'not_empty' => false,
        'desc' => '404 Error',
        'default' => '404 Error'
    )),
    new textOption(array(
        'name' => 'Oops!',
        'id' => 'translator_oops',
        'not_empty' => false,
        'desc' => 'Error 404 page header',
        'default' => 'Oops!'
    )),
    new textOption(array(
        'name' => '404 header',
        'id' => 'translator_header_404',
        'not_empty' => false,
        'desc' => 'Error 404 page header',
        'default' => 'Not Found :('
    )),
    new TextareaOption(array(
        'name' => '404 text',
        'id' => 'translator_text_404',
        'not_empty' => false,
        'desc' => 'Error 404 page text',
        'default' => 'Apologies, but we were unable to find what you were looking for.'
    )),
    new textOption(array(
        'name' => 'All items',
        'id' => 'translator_portfolio_all',
        'not_empty' => false,
        'desc' => 'Portfolio page (filter)',
        'default' => 'All'
    )),
    new textOption(array(
        'name' => 'Password protected',
        'id' => 'password_protected',
        'not_empty' => false,
        'desc' => '',
        'default' => 'This post is password protected. Enter the password to view comments.'
    )),
    new textOption(array(
        'name' => 'Read more',
        'id' => 'read_more_link',
        'not_empty' => false,
        'desc' => 'All pages',
        'default' => 'Read more!'
    )),
    new textOption(array(
        'name' => 'Tags',
        'id' => 'tags_caption',
        'not_empty' => false,
        'desc' => '',
        'default' => 'Tags'
    )),
    new textOption(array(
        'name' => 'Equipment',
        'id' => 'equipment',
        'not_empty' => true,
        'desc' => '',
        'default' => 'Equipment'
    )),
    new textOption(array(
        'name' => 'Location',
        'id' => 'location',
        'not_empty' => true,
        'desc' => '',
        'default' => 'Location'
    )),
    new textOption(array(
        'name' => 'Model',
        'id' => 'model',
        'not_empty' => true,
        'desc' => '',
        'default' => 'Model'
    )),
    new textOption(array(
        'name' => 'Style',
        'id' => 'style',
        'not_empty' => true,
        'desc' => '',
        'default' => 'Style'
    )),
    new textOption(array(
        'name' => 'Load more button',
        'id' => 'translator_load_more',
        'not_empty' => false,
        'desc' => 'Portfolio page',
        'default' => 'Load more works'
    )),
    new textOption(array(
        'name' => 'Author',
        'id' => 'translator_author',
        'not_empty' => true,
        'desc' => '',
        'default' => 'Author'
    )),
    new textOption(array(
        'name' => 'Feedback form name',
        'id' => 'translator_feedback_form_name',
        'not_empty' => false,
        'desc' => 'Contact form',
        'default' => 'Name *'
    )),
    new textOption(array(
        'name' => 'Feedback form email',
        'id' => 'translator_feedback_form_email',
        'not_empty' => false,
        'desc' => 'Contact form',
        'default' => 'Email *'
    )),
    new textOption(array(
        'name' => 'Feedback form subject',
        'id' => 'translator_feedback_form_subject',
        'not_empty' => false,
        'desc' => 'Contact form',
        'default' => 'Subject'
    )),
    new textOption(array(
        'name' => 'Feedback form message',
        'id' => 'translator_feedback_form_message',
        'not_empty' => false,
        'desc' => 'Contact form',
        'default' => 'Message *'
    )),
    new TextOption(array(
        'name' => 'Message subject',
        'id' => 'contacts_subject',
        'default' => '[Website] Contact Form'
    )),
    new TextareaOption(array(
        'name' => 'Thank you message',
        'id' => 'contacts_thanx',
        'default' => 'Thank you! Your message has been sent.'
    )),
    new textOption(array(
        'name' => 'Please fill the required field',
        'id' => 'fill_the_required_field',
        'not_empty' => false,
        'desc' => 'Contact page',
        'default' => 'Please fill the required field.'
    )),
    new textOption(array(
        'name' => 'Name',
        'id' => 'comment_form_name',
        'not_empty' => false,
        'desc' => 'Comment form',
        'default' => 'Name *'
    )),
    new textOption(array(
        'name' => 'Email',
        'id' => 'comment_form_email',
        'not_empty' => false,
        'desc' => 'Comment form',
        'default' => 'Email *'
    )),
    new textOption(array(
        'name' => 'URL',
        'id' => 'comment_form_url',
        'not_empty' => false,
        'desc' => 'Comment form',
        'default' => 'URL'
    )),
    new textOption(array(
        'name' => 'Message',
        'id' => 'comment_form_message',
        'not_empty' => false,
        'desc' => 'Comment form',
        'default' => 'Message...'
    )),
    new textOption(array(
        'name' => 'Leave a Comment!',
        'id' => 'leave_a_comment',
        'not_empty' => false,
        'desc' => '',
        'default' => 'Leave a Comment!'
    )),
    new textOption(array(
        'name' => 'Logged in',
        'id' => 'you_must_logged_in',
        'not_empty' => false,
        'desc' => 'Comments',
        'default' => 'You must be logged in to post a comment.'
    )),
    new textOption(array(
        'name' => 'Logged in as',
        'id' => 'logged_in_as',
        'not_empty' => false,
        'desc' => 'Comments',
        'default' => 'Logged in as'
    )),
    new textOption(array(
        'name' => 'Log out',
        'id' => 'log_out',
        'not_empty' => false,
        'desc' => 'Comments',
        'default' => 'Log out?'
    )),
    new textOption(array(
        'name' => 'Comment form is closed',
        'id' => 'comment_form_is_closed',
        'not_empty' => false,
        'desc' => 'Comments',
        'default' => 'Sorry, the comment form is closed at this time.'
    )),
    new textOption(array(
        'name' => 'Comments',
        'id' => 'comments_number',
        'not_empty' => false,
        'desc' => '',
        'default' => 'Comments'
    )),
	new textOption(array(
        'name' => 'Search',
        'id' => 'translator_search_value',
        'not_empty' => false,
        'default' => 'Search the site...'
    )),
	new textOption(array(
        'name' => 'Reply button',
        'id' => 'translator_reply_value',
        'not_empty' => false,
		'desc' => 'Comments',
        'default' => 'Reply'
    )),
    new textOption(array(
        'name' => 'Post Comment',
        'id' => 'post_comment',
        'not_empty' => false,
        'desc' => 'Comments',
        'default' => 'Post Comment'
    )),
    new textOption(array(
        'name' => 'Awaiting moderation',
        'id' => 'translator_awaiting_moder_value',
        'not_empty' => false,
        'desc' => 'Comments',
        'default' => 'Your comment is awaiting moderation.'
    )),
    new textOption(array(
        'name' => 'Clear',
        'id' => 'tranlator_clear',
        'not_empty' => false,
        'desc' => 'In all forms',
        'default' => 'Clear'
    )),
    new textOption(array(
        'name' => 'Send comment',
        'id' => 'tranlator_send_message',
        'not_empty' => false,
        'desc' => 'In all forms',
        'default' => 'Send'
    )),
    new textOption(array(
        'name' => 'Pages',
        'id' => 'translate_pages',
        'not_empty' => false,
        'desc' => '',
        'default' => 'Pages'
    )),
)));

?>