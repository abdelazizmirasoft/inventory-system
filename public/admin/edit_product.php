<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>
<?php
	$max_file_size = 1048576;   // expressed in bytes
	                            //     10240 =  10 KB
	                            //    102400 = 100 KB
	                            //   1048576 =   1 MB
	                            //  10485760 =  10 MB
	$magasins = Magasin::find_all();
	$elements = Element::find_all();
	$etageres = Etagere::find_all();
	$plateaux = Plateau::find_all();

	if(isset($_POST['submit'])) {
		$product = Product::find_by_id($_GET['id']);
		if(strlen($_POST['PART_NUMBER'])>0){
			$product->PART_NUMBER = $_POST['PART_NUMBER'];			
		}
		if (strlen($_POST['DESCRIPTION'])>0) {
			$product->DESCRIPTION = $_POST['DESCRIPTION'];
		}
		if (strlen($_POST['id_magasin'])>0) {
			$product->id_magasin  = $_POST['id_magasin'];
		}
		if (strlen($_POST['id_element'])>0) {
			$product->id_element  = $_POST['id_element'];
		}
		if (strlen($_POST['id_etagere'])>0) {
			$product->id_etagere  = $_POST['id_etagere'];
		}
		if (strlen($_POST['id_plateau'])>0) {
			$product->id_plateau  = $_POST['id_plateau'];
		}
		if (strlen($_POST['CODIFICATION'])>0) {
			$product->CODIFICATION = $_POST['CODIFICATION'];
		}
		if (strlen($_POST['MODEL'])>0) {
			$product->MODEL = $_POST['MODEL'];
		}
		if (strlen($_POST['UNIT_PR'])>0) {
			$product->UNIT_PR = $_POST['UNIT_PR'];
		}
		if (strlen($_POST['PU_ACHAT'])>0) {
			$product->PU_ACHAT = $_POST['PU_ACHAT'];
		}
		if (strlen($_POST['PU_VENTE'])>0) {
			$product->PU_VENTE = $_POST['PU_VENTE'];
		}
		if (strlen($_FILES['file_upload'])>0) {
			$product->attach_file($_FILES['file_upload']);
		}

		if($product->save()) {
			// Success
			
			
      		$session->message("Produit mis à jour avec succés.");
			redirect_to('liste_products.php');
		} else {
			// Failure
      $message = join("<br />", $product->errors);
		}
	}
	
?>

<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Modifier Produit<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>Détails de votre produit</small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->
	<?php echo output_message($message); ?>
		
		  <form action="edit_product.php?id=<?php echo $_GET['id']; ?>" enctype="multipart/form-data" method="POST">
		    <input type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-2 col-md-offset-1">
			    		<label for="PART_NUMBER">PART_NUMBER </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="PART_NUMBER" value="" id="PART_NUMBER" />
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-2 col-md-offset-1">
			    		<label for="description">Description </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="DESCRIPTION" value="" id="DESCRIPTION" />
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-2 col-md-offset-1">
			    		<label for="CODIFICATION">Code </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="CODIFICATION" value="" id="CODIFICATION" />
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-2 col-md-offset-1">
			    		<label for="modele">Modele </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="MODEL" value="" id="MODEL" />
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-2 col-md-offset-1">
			    		<label for="id_magasin">Magasin </label>
			    	</div>
			    	<div class="col-md-2">
			    		<select name="id_magasin" id="id_magasin" class="form-control" >
						    				<option value=""></option>
							    		<?php foreach($magasins as $magasin): ?>
							    			<option value="<?php echo $magasin->id; ?>"><?php echo $magasin->nom; ?></option>
							    		<?php endforeach; ?>
						    		</select>
			    	</div>
			    	<div class="col-md-2 col-md-offset-1">
			    		<label for="id_element">Element </label>
			    	</div>
			    	<div class="col-md-2">
			    		<select name="id_element" id="id_element" class="form-control" >
						    				<option value=""></option>
							    		<?php foreach($elements as $element): ?>
							    			<option value="<?php echo $element->id; ?>"><?php echo $element->nom; ?></option>
							    		<?php endforeach; ?>
						    		</select>
			    	</div>
			    	<div class="col-md-2 col-md-offset-1">
			    		<label for="id_etagere">Etagère </label>
			    	</div>
			    	<div class="col-md-2">
			    		<select name="id_etagere" id="id_etagere" class="form-control" >
						    				<option value=""></option>
							    		<?php foreach($etageres as $etagere): ?>
							    			<option value="<?php echo $etagere->id; ?>"><?php echo $etagere->nom; ?></option>
							    		<?php endforeach; ?>
						    		</select>
			    	</div>
			    	<div class="col-md-2 col-md-offset-1">
			    		<label for="id_plateau">Plateau </label>
			    	</div>
			    	<div class="col-md-2">
			    		<select name="id_plateau" id="id_plateau" class="form-control" >
						    				<option value=""></option>
							    		<?php foreach($plateaux as $plateau): ?>
							    			<option value="<?php echo $plateau->id; ?>"><?php echo $plateau->nom; ?></option>
							    		<?php endforeach; ?>
						    		</select>
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-2 col-md-offset-1">
			    		<label for="UNIT_PR">Unit PR </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="UNIT_PR" value="" id="UNIT_PR" />
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-2 col-md-offset-1">
			    		<label for="PU_ACHAT">P.U Achat </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="PU_ACHAT" value="" id="PU_ACHAT" />
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-2 col-md-offset-1">
			    		<label for="PU_VENTE">P.U Vente </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="PU_VENTE" value="" id="PU_VENTE" />
			    	</div>
			    </div>
			</div>
			
		    <div class="form-group" >
			  	<div class="row">
			  		<div class="col-md-2 col-md-offset-1">
			    		<label for="price">Image du produit </label>
			    	</div>
			  		<div class="col-md-9">
			    		<input type="file" name="file_upload" />
			    	</div>
			    </div>
			</div>			    
			<div class="form-group">
			    <div class="row">		
			  		<div class="col-md-12">
					    <input class="btn btn-primary pull-right" type="submit" name="submit" value="Ajouter Produit" />
					</div>
			    </div>
			</div>
		  </form>
		

<?php include_layout_template('admin_footer.php'); ?>
		
