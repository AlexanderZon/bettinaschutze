<?php

	# CODE_ERR: MOSTRAR ERROR DE DUPLICADO DE CÓDIGO DE MATERIA
	global $gldb;

	$item = $gldb->getItem($_GET['ID']);

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
	<h2>Editar Items <a href="admin.php?page=page_photo_lightbox&parent=<?php echo $item['post_parent']; ?>" class="add-new-h2">Volver</a></h2>
	<hr>
	
	<!-- PAGE CONTENT -->
	
	<form method="post" action="" id="form-materia">
		<input type="hidden" name="verify_photo" value="edit"/>
		<input type="hidden" name="ID" value="<?php echo $_GET['ID']; ?>"/>
		<input type="hidden" name="parent" value="<?php echo $item['post_parent']; ?>"/>
		<table style="border:1px #AAA dashed;padding:1em;">
			<tr>
				<td><span class="label">Título del Ítem:</span></td>
				<td><input type="text" id="post_title" name="post_title" maxlength="255" required value="<?php echo $item['post_title']; ?>"/></td>
			</tr>
			<tr>
				<td><span class="label">Descripción:</span></td>
				<td><textarea type="text" id="post_content" name="post_content" maxlength="255" required><?php echo $item['post_content']; ?></textarea></td>
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
