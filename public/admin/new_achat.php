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
	$products	 = Product::find_all();
	$fournisseurs	 = Fournisseur::find_all();
	if(isset($_POST['submit'])) {
		$achat = new Achat();
		$achat->id_four = $_POST['id_four'];
		$achat->nom = $_POST['nom'];
		$achat->quantity = $_POST['quantity'];
		$achat->prix = $_POST['PU_ACHAT'];
		$achat->date_achat = date("Y-m-d");
		$stock = Stock::get_product_by_id($achat->nom);
		$stock->quantity+=$achat->quantity;
		$stock->date_alimentation=date("Y-m-d");
		$stock->save();
		$fournisseur = Fournisseur::find_by_id($achat->id_four);
		$fournisseur->dette += $achat->prix*$achat->quantity;
		
		if($fournisseur->save()){}
		if($achat->save()) {
			// Success
      		$session->message("Achat ajouter avec succés.");
      		//gestion itemStock
			$itemStock = new ItemStock();
			$itemStock->id_product=$achat->nom;
			$itemStock->id_achat=$achat->id;
			$itemStock->UNIT_PR=$_POST['UNIT_PR'];
			$itemStock->PU_ACHAT=$_POST['PU_ACHAT'];
			$itemStock->PU_VENTE=$_POST['PU_VENTE'];
			$itemStock->quantity=$_POST['quantity'];
			$itemStock->date_alimentation=date("Y-m-d");
			if($itemStock->save()){};
			redirect_to('liste_achats.php');
		} else {
			// Failure
      		$message = join("<br />", $achat->errors);
		}
	}
	
?>

<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Ajout Nouvel Achat<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>Détails de votre achat</small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->
	<?php echo output_message($message); ?>
		
		  <form action="new_achat.php" enctype="multipart/form-data" method="POST">
		    
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="id_four">Nom Fournisseur </label>
			    	</div>
			    	<div class="col-md-9">
			    		<select name="id_four" class="form-control" required>
			    				<option value=""></option>
				    		<?php foreach($fournisseurs as $fournisseur): ?>
				    			<option value="<?php echo $fournisseur->id; ?>"><?php echo $fournisseur->nom_four; ?></option>
				    		<?php endforeach; ?>
			    		</select>
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="nom">Nom Produit </label>
			    	</div>
			    	<div class="col-md-9">
			    		<select name="nom" class="form-control" required>
			    				<option value=""></option>
				    		<?php foreach($products as $product): ?>
				    			<option value="<?php echo $product->id; ?>"><?php echo $product->PART_NUMBER." (".$product->DESCRIPTION.")"; ?></option>
				    		<?php endforeach; ?>
			    		</select>
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="quantity">Quantité </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="quantity" value="" id="quantity" required/>
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="UNIT_PR">Prix U. PR </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="UNIT_PR" value="" id="UNIT_PR" required/>
			    	</div>
			    </div>
			</div>	
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="price">Prix U. Achat </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="PU_ACHAT" value="" id="PU_ACHAT" required/>
			    	</div>
			    </div>
			</div>	
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="price">Prix U. Vente </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="PU_VENTE" value="" id="PU_VENTE" required/>
			    	</div>
			    </div>
			</div>		
			   
			<div class="form-group">
			    <div class="row">		
			  		<div class="col-md-12">
					    <input class="btn btn-primary pull-right" type="submit" name="submit" value="Ajouter Achat" />
					</div>
			    </div>
			</div>
		  </form>
  	

<?php include_layout_template('admin_footer.php'); ?>
		
