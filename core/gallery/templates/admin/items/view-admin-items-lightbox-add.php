<?php

	# CODE_ERR: MOSTRAR ERROR DE DUPLICADO DE CÓDIGO DE MATERIA
	$data = $_GET;

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
	<h2>Añadir Items <a href="admin.php?page=page_item_lightbox&parent=<?php echo $data['parent']; ?>" class="add-new-h2">Volver</a></h2>
	<hr>
	
	<!-- PAGE CONTENT -->
	
	<form method="post" action="" id="form-materia" enctype="multipart/form-data">
		<input type="hidden" name="verify_item" value="add"/>
		<input type="hidden" name="parent" value="<?php echo $data['parent']; ?>"/>
		<table style="border:1px #AAA dashed;padding:1em;">
			<tr>
				<td><span class="label">Título del Ítem:</span></td>
				<td><input type="text" id="post_title" name="post_title" maxlength="255" required/></td>
			</tr>
			<tr>
				<td><span class="label">Descripción:</span></td>
				<td><textarea type="text" id="post_content" name="post_content" maxlength="255" required></textarea></td>
			</tr>
			<tr>
				<td><span class="label">Imagen de Destaque:</span></td>
				<td><input type="file" id="image" name="image" maxlength="255" required/></td>
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

