<?php

	require_once( "../../../../../../wp-config.php" );

	require_once( "../class.db.php" );

	global $wpdb;

	$logo = get_theme_option("logo");

	$html = '<img src="'.$logo.'" style="width:80%; max-width:360px"><br>
			<div style="text-align:center;padding-top:1em;" id="contact-form-container">

			<style>
				.fancybox-inner{
					padding: 1.5em;
					width: 70%;
					max-width: 700px;
				}
				#contact-form{
					width: 90%;
					max-width: 400px
					background: transparent;
					position:relative;
				}
				#contact-form input[type=text],#contact-form input[type=email],#contact-form input[type=submit]{
				height:22px;
				padding: 3px 20px;

			}
				#contact-form input[type=text], #contact-form input[type=email],#contact-form textarea{
					padding: 3px 20px;
					background: #FFF;
					width: 60%;
					float:right !important;
				}
				#contact-form label{
					float:left !important;
					font-weight: 900;
					padding-top: 5px;
					color: #C99;
				}
				
				#contact-form textarea, #contact-form input, #contact-form label{
					display:inline-block;
					border:0;
				}

				.control-box{
					display:block;
					margin-bottom:10px;
				}
				#contact-form input[type=submit]{
					cursor: pointer;
					background-color: #ECC;
					height: 42px;
					color: #FFF;
					font-weight: 900;
				}
			</style>
				<form id="contact-form" action="" method="post">
					<div class="control-box"><label>Name</label><input id="contact-form-name" type="text" name="name" required/><div style="clear:both;"></div></div>
					<div class="control-box"><label>Email</label><input id="contact-form-email" type="email" name="email" required/><div style="clear:both;"></div></div>
					<div class="control-box"><label>Subject</label><input id="contact-form-subject" type="text" name="subject" required/><div style="clear:both;"></div></div>
					<div class="control-box"><label>Message</label><textarea id="contact-form-message" name="message" required></textarea> <div style="clear:both;"></div></div>
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
						$("#contact-form-container").html("Sending...");
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

