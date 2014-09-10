<?php

#main config
require_once("config.php");
require_once("variables.php");
require_once("update_parameters.php");

#Add image resizer
require_once("aq_resizer.php");

#page builder
require_once("page-builder/pb.php");

#classes
require_once("classes/admin-tabs-controls.php");
require_once("classes/admin-tabs-option-types.php");
require_once("classes/admin-tabs-list.php");

#shortcodes
require_once("shortcodes/buttons.php");
require_once("shortcodes/blockquote.php");
require_once("shortcodes/social_icons.php");
require_once("shortcodes/dropcaps.php");
require_once("shortcodes/frame.php");
require_once("shortcodes/highlighter.php");
require_once("shortcodes/divider.php");

#all registration
require_once("registrator/admin-pages.php");
require_once("registrator/css-js.php");
require_once("registrator/css-js-demo.php");
require_once("registrator/custom-post-types.php");
require_once("registrator/ajax-handlers.php");
require_once("registrator/post-handlers.php");
require_once("registrator/sidebars.php");
require_once("registrator/fonts.php");
require_once("registrator/misc.php");

#admin
require_once("admin/options.php");
require_once("admin/theme-settings-page.php");
require_once("gallery/class.gallery.php");

?>