<?php

	# CODE_ERR: MOSTRAR ERROR DE DUPLICADO DE CÓDIGO DE MATERIA
	global $gldb;

	$video = $gldb->getVideo($_GET['ID']);

?>

<style>
	.element {
	    position: relative;
	}

	.element:before {
	    content: "\f041"; 
	    font-family: FontAwesome;
	    font-style: normal;
	    font-weight: normal;
	    text-decoration: inherit;
	    color: #000;
	    font-size: 32px;
	    position: absolute;
	}

	.icon-plus-sign {
	  *zoom: expression( this.runtimeStyle['zoom'] = '5', this.innerHTML = '&#xf055;');
	}

	input[type=text]{
		width:100%;	
		}
		
</style>

<div class="wrap">
	<div class="icon32 element"><br></div>
	<h2>Edit Videos <a href="admin.php?page=page_video_lightbox&parent=<?php echo $video['post_parent']; ?>" class="add-new-h2">Back</a></h2>
	<hr>
	
	<!-- PAGE CONTENT -->
	
	<form method="post" action="" id="form-materia" enctype="multipart/form-data">
		<input type="hidden" name="verify_video" value="edit"/>
		<input type="hidden" name="parent" value="<?php echo $data['parent']; ?>"/>
		<table style="border:1px #AAA dashed;padding:1em;">
			<tr>
				<td><span class="label">Title:</span></td>
				<td><input type="text" id="post_title" name="post_title" maxlength="255" required value="<?php echo $video['post_title']; ?>"/></td>
			</tr>
			<tr>
				<td><span class="label">Origin:</span></td>
				<td>
					<select name="pinged">
						<option value="youtube" <?php echo $video['pinged'] == 'youtube' ? 'selected' : '' ?>>YouTube</option>
						<option value="vimeo" <?php echo $video['pinged'] == 'vimeo' ? 'selected' : '' ?>>Vimeo</option>
					</select>
				</td>
			</tr>
			<tr>
				<td><span class="label">Video URL:</span></td>
				<td><input type="text" id="url" name="post_content" maxlength="255" required value="<?php echo $video['post_content']; ?>"/></td>
			</tr>
			<tr>
				<td><span class="label">Main Image:</span></td>
				<td><input type="file" id="image" name="image" maxlength="255"/></td>
			</tr>
			<tr>
				<td colspan="2"><img src="<?php echo wp_get_attachment_url($video['post_excerpt']) ?>" width="400"></td>
			</tr>
			<tr>
				<td colspan="3">
				<hr>
					<center>
						<input type="submit" value="Confirmar" class="button button-primary"/>
					</center>
				</td>
			</tr>
		</table>
	</form>

</div>

