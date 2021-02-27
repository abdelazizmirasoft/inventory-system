<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>
<?php
	$products = Product::find_all();
	$magasins = Magasin::find_all();
?>
<?php
// EDITION SE FAIT POUR CHANGEMENT DE MAGASIN, QUANTITÉ OU DATE
	if (!isset($_GET['id'])) { redirect_to("index.php"); }
  	if(isset($_POST['submit'])){
		$lot = Lot::find_by_id($_GET['id']);
		if(!$lot) {
		    $session->message("Lot introuvable.");
		    redirect_to('liste_lots.php');
	  	}
  		if($_POST['nom_magasin']=="" or $_POST['nom_magasin']==$lot->id_magasin){
  			if($_POST['nom_produit']=="" or $_POST['nom_produit']==$lot->id_produit){
  				if($_POST['quantity']!=""){
  					$stockProduit = Stock::find_by_id($lot->id_produit, $lot->id_magasin);
					$stockProduit->quantity-=$lot->quantity;
  					$lot->quantity = $_POST['quantity'];
  					$stockProduit->quantity+=$lot->quantity;
  					$stockProduit->save();
  				}
  			}
  			else if ($_POST['nom_produit']!=$lot->id_produit){
  				if($_POST['quantity']==""){
  					$stockProduit = Stock::find_by_id($lot->id_produit, $lot->id_magasin);
					$stockProduit->quantity-=$lot->quantity;
					$stockProduit->save();
					$stockProduit = Stock::find_by_id($_POST['nom_produit'], $lot->id_magasin);
					$lot->id_produit = $_POST['nom_produit'];
  					$stockProduit->quantity+=$lot->quantity;
  					$stockProduit->save();
  				}else{
  					$stockProduit = Stock::find_by_id($lot->id_produit, $lot->id_magasin);
					$stockProduit->quantity-=$lot->quantity;
					$stockProduit->save();
					$stockProduit = Stock::find_by_id($_POST['nom_produit'], $lot->id_magasin);
					$lot->id_produit = $_POST['nom_produit'];
  					$stockProduit->quantity+=$_POST['quantity'];
  					$stockProduit->save();
  				}
			}
		}else if($_POST['nom_magasin']!=$lot->id_magasin){
			if($_POST['nom_produit']=="" or $_POST['nom_produit']==$lot->id_produit){
				if($_POST['quantity']==""){
  					$stockProduit = Stock::find_by_id($lot->id_produit, $lot->id_magasin);
					$stockProduit->quantity-=$lot->quantity;
					$stockProduit->save();
					$stockProduit = Stock::find_by_id($lot->id_produit, $_POST['nom_magasin']);
					$lot->id_magasin = $_POST['nom_magasin'];
  					$stockProduit->quantity+=$lot->quantity;
  					$stockProduit->save();
  				}else{
  					$stockProduit = Stock::find_by_id($lot->id_produit, $lot->id_magasin);
					$stockProduit->quantity-=$lot->quantity;
					$stockProduit->save();
					$stockProduit = Stock::find_by_id($_POST['nom_produit'], $lot->id_magasin);
					$lot->id_produit = $_POST['nom_produit'];
  					$stockProduit->quantity+=$_POST['quantity'];
  					$stockProduit->save();
  				}
  			}
  			else if ($_POST['nom_produit']!=$lot->id_produit){
  				if($_POST['quantity']==""){
  					$stockProduit = Stock::find_by_id($lot->id_produit, $lot->id_magasin);
					$stockProduit->quantity-=$lot->quantity;
					$stockProduit->save();
					$stockProduit = Stock::find_by_id($lot->id_produit, $_POST['nom_magasin']);
					$lot->id_magasin = $_POST['nom_magasin'];
  					$stockProduit->quantity+=$lot->quantity;
  					$stockProduit->save();
  				}else{
  					$stockProduit = Stock::find_by_id($lot->id_produit, $lot->id_magasin);
					$stockProduit->quantity-=$lot->quantity;
					$stockProduit->save();
					$stockProduit = Stock::find_by_id($_POST['nom_produit'], $_POST['nom_magasin']);
					$lot->id_produit = $_POST['nom_produit'];
					$lot->id_magasin = $_POST['nom_magasin'];
  					$stockProduit->quantity+=$_POST['quantity'];
  					$stockProduit->save();
  				}
			}
  		}
  		
  		
  		
	  	//echo "--".$magasin->save();
		if($lot->save()) {
					// Success
		      		$session->message("Lot mis à jour avec succés.");
					redirect_to('liste_lots.php');
		}else {
			// Failure
      		$message = join("<br />", $lot->errors);
      		redirect_to('liste_lots.php');
		}
  	}
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Modifier Lot<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>Détails de votre lot</small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->
	<?php echo output_message($message); ?>
		
		  <form action="edit_lot.php?id=<?php echo $_GET['id'];?>" enctype="multipart/form-data" method="POST">
		    
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="nom_produit">Produit</label>
			    	</div>
			    	<div class="col-md-9">
			    		<select name="nom_produit" class="form-control" >
			    				<option value=""></option>
				    		<?php foreach($products as $product): ?>
				    			<option value="<?php echo $product->id; ?>"><?php echo $product->description; ?></option>
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
			    		<select name="nom_magasin" class="form-control" >
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
			    		<input class="form-control" type="date" name="date_production" value="" id="date_production" />
			    	</div>
			    	<div class="col-md-3">
			    		<label for="date_expiration">Date expiration </label>
			    	</div>
			    	<div class="col-md-3">
			    		<input class="form-control" type="date" name="date_expiration" value="" id="date_expiration" />
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="quantity">Quantité </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="quantity" value="" id="quantity" />
			    	</div>
			    </div>
			</div>
				    
			<div class="form-group">
			    <div class="row">		
			  		<div class="col-md-12">
					    <input class="btn btn-primary pull-right" type="submit" name="submit" value="Modifier Lot" />
					</div>
			    </div>
			</div>
		  </form>
  	

<?php include_layout_template('admin_footer.php'); ?>
		
