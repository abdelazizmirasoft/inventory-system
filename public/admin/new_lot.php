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
	$products = Product::find_all();
	$magasins = Magasin::find_all();
	if(isset($_POST['submit'])) {
		$lot = new Lot();
		$lot->id_produit = $_POST['nom_produit'];
		$lot->id_magasin = $_POST['nom_magasin'];
		$lot->date_production = $_POST['date_production'];
		$lot->date_expiration = $_POST['date_expiration'];
		$lot->quantity = $_POST['quantity'];
		// MAJ stock
		$stockProduit = Stock::find_by_id($lot->id_produit, $lot->id_magasin);
		$stockProduit->quantity+=$lot->quantity;
		$stockProduit->save();
		if($lot->save()) {
			// Success
      		$session->message("Lot ajouter avec succés.");
			redirect_to('liste_lots.php');
		} else {
			// Failure
      $message = join("<br />", $lot->errors);
		}
	}
	
?>

<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Ajout Lot<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>Détails de votre lot</small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->
	<?php echo output_message($message); ?>
		
		  <form action="new_lot.php" enctype="multipart/form-data" method="POST">
		    
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="nom_produit">Produit</label>
			    	</div>
			    	<div class="col-md-9">
			    		<select name="nom_produit" class="form-control" required>
			    				<option value=""></option>
				    		<?php foreach($products as $product): ?>
				    			<option value="<?php echo $product->id; ?>"><?php echo $product->DESCRIPTION; ?></option>
				    		<?php endforeach; ?>
			    		</select>
			    		
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="nom_magasin">Magasin</label>
			    	</div>
			    	<div class="col-md-9">
			    		<select name="nom_magasin" class="form-control" required>
			    				<option value=""></option>
			    			<?php foreach($magasins as $magasin): ?>
				    			<option value="<?php echo $magasin->id; ?>"><?php echo $magasin->nom; ?></option>
				    		<?php endforeach; ?>
			    		?>
			    		</select>
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="date_production">Date de production </label>
			    	</div>
			    	<div class="col-md-3">
			    		<input class="form-control" type="date" name="date_production" value="" id="date_production" required/>
			    	</div>
			    	<div class="col-md-3">
			    		<label for="date_expiration">Date expiration </label>
			    	</div>
			    	<div class="col-md-3">
			    		<input class="form-control" type="date" name="date_expiration" value="" id="date_expiration" required/>
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
			  		<div class="col-md-12">
					    <input class="btn btn-primary pull-right" type="submit" name="submit" value="Ajouter Lot" />
					</div>
			    </div>
			</div>
		  </form>
  	

<?php include_layout_template('admin_footer.php'); ?>
		
