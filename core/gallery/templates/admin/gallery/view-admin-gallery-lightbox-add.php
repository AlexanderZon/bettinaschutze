<?php

	# CODE_ERR: MOSTRAR ERROR DE DUPLICADO DE CÓDIGO DE MATERIA

	if($_POST['verify_gallery'] == 'add'):

		global $gldb;
	
		$data = $_POST;
			
		$gallery = array(
			'post_title' => $data['post_title']
			);
		
		$id = $glbd->addGallery($gallery);

		$msg = '';
		
		if($id != 0):

			$bool = true;

			if($bool):

				$msg = 'Materia agregada con éxito!';

			else:

				$msg = 'No se pudieron agregar algunos datos debido a un error!';

			endif;
			
			unset($_POST['verify_gallery']);
			
		else:

			$msg = 'No se pudo agregar la materia, revise sus datos';

		endif;

		echo "<div class='update-nag'>$msg</div>";
		
	endif;

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

<!--<script language="javascript" src="<?php echo plugins_url().'/elearning/assets/js/jquery.js'; ?>"></script>-->
<div class="wrap">
	<div class="icon32 element"><br></div>
	<h2>Añadir Galerias <a href="admin.php?page=page_gallery_lightbox_add" class="add-new-h2">Volver</a></h2>
	<hr>
	
	<!-- PAGE CONTENT -->
	
	<form method="post" action="" id="form-materia">
		<input type="hidden" name="verify_gallery" value="add"/>
		<table style="border:1px #AAA dashed;padding:1em;">
			<tr>
				<td><span class="label">Título de la Galería:</span></td>
				<td><input type="text" id="post_title" name="post_title" maxlength="255" required/></td>
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

