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
	$products = MatierePremiere::find_all();
	if(isset($_POST['submit'])) {
		$consomation = new Consomation();
		$consomation->id_produit = $_POST['id_produit'];
		$consomation->date_consomation = $_POST['date_consomation'];
		$consomation->quantity = $_POST['quantity'];
		// MAJ stock
		$stockProduit = StockMP::find_by_id($consomation->id_produit);
		$stockProduit->quantity-=$consomation->quantity;
		//$stockProduit->date_alimentation=date("Y-m-d");
		$stockProduit->save();
		if($consomation->save()) {
			// Success
      		$session->message("Consomation ajouter avec succés.");
			redirect_to('liste_consomations.php');
		} else {
			// Failure
      $message = join("<br />", $consomation->errors);
		}
	}
	
?>

<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Ajout Consomation<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>Détails de votre consomation</small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->
	<?php echo output_message($message); ?>
		
		  <form action="new_consomation.php" enctype="multipart/form-data" method="POST">
		    
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="date_consomation">Date de consomation </label>
			    	</div>
			    	<div class="col-md-3">
			    		<input class="form-control" type="date" name="date_consomation" value="" id="date_consomation" required/>
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="id_produit">Produit</label>
			    	</div>
			    	<div class="col-md-9">
			    		<select name="id_produit" class="form-control" required>
			    				<option value=""></option>
				    		<?php foreach($products as $product): ?>
				    			<option value="<?php echo $product->id; ?>"><?php echo $product->nom; ?></option>
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
			  		<div class="col-md-12">
					    <input class="btn btn-primary pull-right" type="submit" name="submit" value="Ajouter Consomation" />
					</div>
			    </div>
			</div>
		  </form>
  	

<?php include_layout_template('admin_footer.php'); ?>
		
