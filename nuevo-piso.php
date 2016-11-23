<?php
/*
    Template name: Nuevo Piso
*/
get_header();
?>
<div class="container">
		<div class="row">
			<div id="primary" class="col-md-12" <?php bavotasan_primary_attr(); ?>>
			
			<form name="formulario" action="http://localhost/wordpress/prueba-insercion-2/" method="POST" enctype="multipart/form-data">
				<input type="text" name="titulo" value="TITULO"> <br>
				<input type="text" name="contenido" value="CONTENIDO"> <br>
				<input type="text" name="email" value="EMAIL@"> <br>
				<input type="number" name="precio" value="200"> <br>
				<?php wp_dropdown_categories($args = array('hide_empty' => '0')); ?><br>
				<input type="file" id="thmbnl" name="thmbnl"><br>
				<input type="submit" name="submit" value="Siguiente paso">
			</form>
<?php
get_footer();
?>