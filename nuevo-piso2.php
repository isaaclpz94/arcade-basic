<?php
/*
    Template name: Nuevo Piso 2
*/
				if(isset($_POST['submit'])){ //Viene del primer formulario
					//variables
					$precio = $_POST['precio'];
					$email = $_POST['email'];
					$titulo = $_POST['titulo'];
					$contenido = $_POST['contenido'];
					$id_categoria = $_POST['cat'];
					
					//insertamos post
					$my_post = array(
						'post_title'    => $titulo,
						'post_content'  => $contenido,
						'post_status'   => 'pending',
						'post_author'   => 1,
						'post_category' => array( $id_categoria )
					);
					$post_id = wp_insert_post( $my_post, false );	
					
					if( ! is_wp_error( $post_id ) ){
						//archivos requeridos para subir la imagen
						require_once(ABSPATH . "wp-admin" . '/includes/image.php');
						require_once(ABSPATH . "wp-admin" . '/includes/file.php');
						require_once(ABSPATH . "wp-admin" . '/includes/media.php');
						//subimos la imagen principal
						$thmbnl_id = media_handle_upload('thmbnl', $post_id );
						if ( !is_wp_error( $thmbnl_id ) ) {
							update_post_meta( $post_id, '_thumbnail_id', $thmbnl_id ); //La asignamos al post
							save_extra_profile_fields_manual($post_id, $precio, $email);//Vamos guardando los meta
							unset($_FILES);
						}else{
							echo $thmbnl_id->get_error_message();
						}
					}else{
						echo "Error al subir el post";
					}
											
				}else{
					if(isset($_POST['html-upload'])){
						//Viene de subir una imagen
					}else{
						//Que haces aqui!?!?!?
					}
				}
				
				if(isset($_POST['html-upload']) && !empty( $_FILES )){ //Si hemos seleccionado alguna imagen para la galería del post
					//variables
					$precio = $_POST['precio'];
					$email = $_POST['email'];
					$post_id = $_POST['post_id'];
					$files = $_FILES["async_upload"];
					$contenido = $_POST['post_content'];
					
					$imgs = Array(); //Creamos array vacío para almacenar los IDs de las imagenes subidas
					foreach ($files['name'] as $key => $value) { //Recorremos $_FILES
					if ($files['name'][$key]) { 
						$file = array( 
							'name' => $files['name'][$key],
							'type' => $files['type'][$key], 
							'tmp_name' => $files['tmp_name'][$key], 
							'error' => $files['error'][$key],
							'size' => $files['size'][$key]
						); 
						$_FILES = array ("async_upload" => $file);
						
						foreach ($_FILES as $file => $array) { //Obtenemos el id de cada imagen subida y lo añadimos al array. PUEDE SER QUE EL ID SEA UN ERROR
							$newupload = my_handle_attachment($file,$post_id);
							$imgs[] = $newupload;
						}
					} 
					$gallery_ids = implode(",", $imgs); //Hacemos una cadena que contenga los IDs separados por comas
						// Actualizamos el post
						$my_post = array(
							'ID'           => $post_id,
							'post_content' => $contenido ." [gallery ids=". $gallery_ids ."]",
							'meta_input'   => array( //meta
										'precio' => $precio, 
										'email' => $email
										) 
						);
						wp_update_post( $my_post );
					}
				}
get_header();
?>
<div class="container">
		<div class="row">
		<?php
			if(!isset($_POST['html-upload'])){ //Si no viene de este formulario
				
				echo "<div id='primary'>";
				echo $_POST['titulo'].'<br>';
				echo $_POST['contenido'].'<br>';
				echo $_POST['precio'].'<br>';
				echo $_POST['email'].'<br>';
				
				echo "<form action=". $_SERVER['REQUEST_URI'] ." method='POST' enctype='multipart/form-data'>";
				echo "<input type='file' id='async_upload[]' name='async_upload[]' multiple>";
				echo "<input type='submit' name='html-upload'  value='Upload'>";
				echo "<input type='hidden' name='post_id' value='". $post_id ."'>";
				echo "<input type='hidden' name='post_content' value='". $_POST['contenido'] ."'>";
				echo "<input type='hidden' name='precio' value='". $_POST['precio'] ."'>";
				echo "<input type='hidden' name='email' value='". $_POST['email'] ."'>";
				wp_nonce_field('client-file-upload');
				echo "</form>";
			}
		?>

<?php
get_footer();
?>