<?php

	require_once( "../../../../../../wp-config.php" );

	require_once( "../class.db.php" );

	global $wpdb;

	$logo = get_theme_option("logo");

	$html = '<img src="'.$logo.'" ><br>
			<div style="text-align:center;padding-top:1em;" id="contact-form-container">

			<style>
				#contact-form{
					width: 350px;
					background: transparent;
					position:relative;
				}
				#contact-form input[type=text],#contact-form input[type=submit]{
				height:42px;
				padding: 3px 20px;

			}
				#contact-form input[type=text], #contact-form textarea{
					padding: 3px 20px;
					background: #FFF;
					width: 60%;
					float:right !important;
				}
				#contact-form label{
					float:left !important;
					font-weight: 900;
					
				}
				
				#contact-form textarea, #contact-form input, #contact-form label{
					display:inline-block;
					border:0;
				}

				.control-box{
					display:block;
					margin-bottom:10px;
				}
			</style>
				<form id="contact-form" action="" method="post">
					<div class="control-box"><label>Name</label><input id="contact-form-name" type="text" name="name"/><div style="clear:both;"></div></div>
					<div class="control-box"><label>Email</label><input id="contact-form-email" type="email" name="email" /><div style="clear:both;"></div></div>
					<div class="control-box"><label>Subject</label><input id="contact-form-subject" type="text" name="subject" /><div style="clear:both;"></div></div>
					<div class="control-box"><label>Message</label><textarea id="contact-form-message" name="message"></textarea> <div style="clear:both;"></div></div>
					<div class="control-box"><input type="submit" value="Submit"></div>
				</form>
				<script>
					$("#contact-form").on("submit", function(e){
						e.preventDefault();
						var data = {
							"name": $("#contact-form-name").val(),
							"email": $("#contact-form-email").val(),
							"subject": $("#contact-form-subject").val(),
							"message": $("#contact-form-message").val(),
						}
						console.log(data);
						$.post("/wp-content/themes/bettinaschutze/core/gallery/ajax/ajax-mail.php", data, function(response) {
							console.log(response);
							$("#contact-form-container").html(response);
							return response;
						});
					});
				</script>
			</div>
	';
	echo $html;

?>

