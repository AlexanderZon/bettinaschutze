<?php

	# CODE_ERR: MOSTRAR ERROR DE DUPLICADO DE CÓDIGO DE MATERIA

	if($_POST['verify_gallery'] == 'edit'):

		global $gldb;
	
		$data = $_POST;
			
		$gallery = array(
			'post_title' => $data['post_title']
			);
		
		$id = $gldb->updateGallery($gallery);

		$msg = '';
		
		if($id != 0):

			$bool = true;

			if($bool):

				$msg = 'Galería editada con éxito!';

			else:

				$msg = 'No se pudieron agregar algunos datos debido a un error!';

			endif;
			
			unset($_POST['verify_gallery']);
			
		else:

			$msg = 'No se pudo editar la galería, revise sus datos';

		endif;

		echo "<div class='update-nag'>$msg</div>";
		
	endif;

	global $gldb;

	$gallery = $gldb->getGallery($_GET['ID']);

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
	<h2>Editar Galerias <a href="admin.php?page=page_gallery_lightbox" class="add-new-h2">Volver</a></h2>
	<hr>
	
	<!-- PAGE CONTENT -->
	
	<form method="post" action="" id="form-materia">
		<input type="hidden" name="verify_gallery" value="edit"/>
		<input type="hidden" name="ID" value="<?php echo $gallery['ID']; ?>"/>
		<table style="border:1px #AAA dashed;padding:1em;">
			<tr>
				<td><span class="label">Título de la Galería:</span></td>
				<td><input type="text" id="post_title" name="post_title" maxlength="255" value="<?php echo $gallery['post_title']; ?>" required/></td>
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

