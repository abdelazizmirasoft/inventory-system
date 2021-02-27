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
	$message_error = "";
	$products = Product::find_all();
	$magasins = Magasin::find_all();
	$clients = Client::find_all();
	if(isset($_POST['submit'])) {
		$vente = new Vente();
		$vente->client = $_POST['client'];
		$index = '1';
		$vente->total = '0';
		$vente->date_vente = date("Y-m-d");
		if($vente->save()){}
		while (isset($_POST['product_'.$index.'_name'])){
			$stock = Stock::find_by_id($_POST['product_'.$index.'_name']);
			if($stock->quantity < $_POST['product_'.$index.'_qty']){
				$product = Product::find_by_id($_POST['product_'.$index.'_name']);
				$message_error += "Quantité insufisante de: ".$product->PART_NUMBER." | ".$product->DESCRIPTION.", total stock --> ".$stock->quantity."<br>";
				continue;
			}
			$productStocks = ItemStock::find_all($_POST['product_'.$index.'_name']);
			$productStocks = array_reverse($productStocks, true);
			foreach ($productStocks as $productStock) {
					if($productStock->quantity>$_POST['product_'.$index.'_qty']){
							$productStock->quantity -= $_POST['product_'.$index.'_qty'];
							$item = new ItemList();
							$item->id_vente = $vente->id;
							$item->id_product = $_POST['product_'.$index.'_name'];
							$item->quantity = $_POST['product_'.$index.'_qty'];
							$item->price = $_POST['product_'.$index.'_price'];			
							//alimenter le stock
							$stockProduit = Stock::get_product_by_id($item->id_product);
							$stockProduit->quantity -= $item->quantity;
							//get the price of the product:
							//x$produit = Product::find_by_id($item->quantity);
							$vente->total+= $item->quantity*$item->price;
							$index += '1';
							//SYNCRONISE DB
							if($item->save()){}
							if($stockProduit->save()){}
							break;
					}
					//regelemnt de la dette
					//---------------------
					if (!isset($_POST['ordianaire'])){

						$dette = new Dette();
				  		$dette->client_id = $vente->client;
				  		$dette->somme = $_POST['somme_reglement'];
				  		$dette->last_dette = $client->dette;
				  		$client->dette = $client->dette - $_POST['somme_reglement'];
				  		$dette->new_dette = $client->dette;
				  		$dette->date_payement = date("Y-m-d");
				  		$dette->save();
					}
			  		//SYNCRONISE DB
					if($item->save()){}
					if($stockProduit->save()){}

			}
		}
		$client = Client::find_by_id($vente->client);
		$client->dette += $vente->total;
		if($client->save()){}
		
		if($vente->save()) {
			// Success
      $session->message("Vente ajouter avec succés.");
			redirect_to('liste_ventes.php');
		} else {
			// Failure
      $message = join("<br />", $vente->errors);
      redirect_to('liste_ventes.php');
		}
	}
	
?>

<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>
<!-- **************************************** -->
<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
   
    <!-- Latest compiled and minified CSS -->
    
<!-- **************************************** -->

      

            <div class="page-header">
              <h1>Ajout Nouvelle Vente<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>Détails de votre Vente</small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->
	<?php echo output_message($message); ?>
		
		  <form action="new_vente.php" enctype="multipart/form-data" method="POST">
		    
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="client"><u>Client</u> </label>
			    	</div>
			    	<div class="col-md-9">
			    		<select name="client" class="form-control" >
			    				<option value="">-- CHOISIR CLIENT --</option>
				    		<?php foreach($clients as $client): ?>
				    			<option value="<?php echo $client->id; ?>"><?php echo $client->nom; ?></option>
				    		<?php endforeach; ?>
			    		</select>
			    	</div>
			    </div>
			    <h4><input type="checkbox" name="ordianaire" value="ordianaire"> Client Ordinaire</h4>
			</div>
			<hr>
			<!-- **************************************** -->
			<div id="czContainer">
	            <div id="first">
	                <div class="recordset">
	                    <div class="fieldRow clearfix">
	                        <div class="col-md-6">
	                            <div id="div_id_product_1_name" class="form-group">
	                                <label for="id_stock_1_product" class="control-label  requiredField">
	                                    Produit<span class="asteriskField">*</span>
	                                </label><div class="controls ">
                                    <select name="product_1_name" id="id_product_1_name" class="form-control" required>
						    				<option value=""></option>
							    		<?php foreach($products as $product): ?>
							    			<option value="<?php echo $product->id; ?>"><?php echo $product->PART_NUMBER." (".$product->DESCRIPTION.")"; ?></option>
							    		<?php endforeach; ?>
						    		</select>
	                                </div>
	                            </div>
	                        </div>
	                        
	                        <div class="col-md-5">
	                            <div id="div_id_produit_1_qty" class="form-group">
	                                <label for="id_product_1_qty" class="control-label  requiredField">
	                                    Quantité<span class="asteriskField">*</span>
	                                </label><div class="controls "><input class="numberinput form-control" id="id_product_1_qty" name="product_1_qty"  type="text" /> </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
			<!-- **************************************** -->		
			
			<hr>
			
			<div class="form-group">
			    <div class="row">		
			  		<div class="col-md-12">
					    <input class="btn btn-primary pull-right" type="submit" name="submit" value="Ajouter Vente" />
					</div>
			    </div>
			</div>
		  </form>
  	
<!-- **************************************** -->
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    
    <script src="js/jquery.czMore-1.5.3.2.js"></script>
    <script type="text/javascript">
        
        $("#czContainer").czMore();
    </script>
<!-- **************************************** -->

<?php include_layout_template('admin_footer.php'); ?>
		
