	<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>
<?php
if(empty($_GET['id_fournisseur'])) {
	  $session->message("No fournisseur ID was provided.");
	  redirect_to('index.php');
	}
	$fournisseur = Fournisseur::find_by_id($_GET['id_fournisseur']);
	if(!$fournisseur) {
	    $session->message("The fournisseur could not be located.");
	    redirect_to('index.php');
  	}
  	if (isset($_POST['submit'])){

  		$dette = new MaDette();
  		$dette->fournisseur_id = $fournisseur->id;
  		$dette->somme = $_POST['somme'];
  		$dette->last_dette = $fournisseur->dette;
  		$fournisseur->dette = $fournisseur->dette - $_POST['somme'];
  		$dette->new_dette = $fournisseur->dette;
  		$dette->date_payement = $_POST['date_paiement'];
  		//;
  		  if ($fournisseur->save()){}
		  if($dette->save() ) {
					// Success
		      		$session->message("Dette mise à jour avec succés.");
					redirect_to('liste_mes_dettes.php');
				} else {
					// Failure

		      		$message = join("<br />", $fournisseur->errors);
				}
  	}
?>

<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Paiement dette<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>Détails de votre Vente</small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->
	<?php echo output_message($message); ?>
		
		  <form action="payement_mes_dettes.php?id_fournisseur=<?php echo $_GET['id_fournisseur'];?>" enctype="multipart/form-data" method="POST">
		    
			
			
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="somme">Somme a payé</label>
			    	</div>
			    	<div class="col-md-4">
			    		<input class="form-control" type="text" name="somme" value="" id="somme" required/>
			    	</div>
			    	<label for="quantity1">DZD</label>
			    </div>
			</div>
					
			
			<div class="form-group">
			    <div class="row">
			    	<div class="col-md-3">
			    		<label for="date_paiement">Date paiement </label>
			    	</div>
			    	<div class="col-md-4">
			    		<input class="form-control" type="date" name="date_paiement" value="" id="date_paiement" required/>
			    	</div>
			    </div>
			</div>    
			<hr>
			<div class="form-group">
			    <div class="row">		
			  		<div class="col-md-12">
					    <input class="btn btn-primary pull-right" type="submit" name="submit" value="Effectuer Paiement" />
					</div>
			    </div>
			</div>
		  </form>
  	

<?php include_layout_template('admin_footer.php'); ?>
		
+