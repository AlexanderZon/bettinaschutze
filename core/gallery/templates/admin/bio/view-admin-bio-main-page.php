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
/*--adjust as necessary--*/
    color: #000;
    font-size: 32px;
    position: absolute;
}
</style>


<div class="wrap">
	<div class="icon32 element"><br></div>
	<h2>Bio </h2>
	<hr>
	
	<!-- PAGE CONTENT -->
	
	<form method="post" action="" id="form-materia">
		<input type="hidden" name="verify_gallery" value="add"/>
		<table style="border:1px #AAA dashed;padding:1em;">
			<tr>
				<td><span class="label">Título de la Galería:</span></td>
				<td><textarea type="text" id="post_title" name="content" maxlength="255" required/></td>
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