<?php

	# CODE_ERR: MOSTRAR ERROR DE DUPLICADO DE CÓDIGO DE MATERIA

	if($_POST['verify_materia'] == 'add'):
	
		$data = $_POST;
			
		$materiadata = array(
			'materia_codigo' => $data['materia_codigo'],
			'materia_descripcion' => $data['materia_descripcion'],
			'semestre_id' => $data['semestre_id']
			);
		
		$id = el_insert_materia($materiadata);

		$msg = '';
		
		if($id != 0):

			$bool = true;

			if( 0 == (add_materia_meta( $id , 'num_h_teoria' , $data['num_h_teoria'] )))
				$bool = false;
			if( 0 == (add_materia_meta( $id , 'num_h_laboratorio' , $data['num_h_laboratorio'] )))
				$bool = false;
			if( 0 == (add_materia_meta( $id , 'num_h_practica' , $data['num_h_practica'] )))
				$bool = false;
			if( 0 == (add_materia_meta( $id , 'unid_credito' , $data['unid_credito'] )))
				$bool = false;

			if($bool):

				$msg = 'Materia agregada con éxito!';
			
				$count = 0;
				$band;
				
				do{
					
					$key = 'materia_prelacion'.++$count;
					
					if(isset($data[$key])):
					
						if( 0 == (add_materia_meta( $id , 'materia_prelacion' , $data[$key] )))
							$bool = false;
						$band = true;
						
					else:
					
						$band = false;
						
					endif;
					
					}while( $band );

			else:

				$msg = 'No se pudieron agregar algunos datos debido a un error!';

			endif;
			
			unset($_POST['verify_materia']);
			
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
	<h2>Añadir Galerias</h2>
	<hr>
	
	<!-- PAGE CONTENT -->
	
	<form method="post" action="" id="form-materia">
		<input type="hidden" name="verify_materia" value="add"/>
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

