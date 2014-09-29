<?php

	require_once( "../../../../../../wp-config.php" );

	require_once( "../class.db.php" );

	global $wpdb;

	$logo = get_theme_option("logo");

	$html = '<img src="'.$logo.'" ><br>
			<div style="width:500px;text-align:justify;">'.$bio['post_content'].'</div>
	';
	echo $html;

