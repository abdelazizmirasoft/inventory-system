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

	if(isset($_POST['submit'])) {

		$fournisseur = new Fournisseur();
		$fournisseur->nom = $_POST['nom_four'];
		$fournisseur->RaisonSociale = $_POST['RaisonSociale'];
		$fournisseur->Ville = $_POST['Ville'];
		$fournisseur->tel = $_POST['tel'];
		$fournisseur->Adresse_Courriel = $_POST['Adresse_Courriel'];
		$fournisseur->dette = 0;

		if($fournisseur->save()) {
			// Success
			echo "yes is set";
      $session->message("Fournisseur ajouté avec succés.");
			redirect_to('liste_fournisseurs.php');
		} else {
			// Failure
      $message = join("<br />", $fournisseur->errors);
		}
	}
	
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Ajout Forunisseur<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>Détails de votre fournisseur</small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->
	<?php echo output_message($message); ?>
		
		  <form action="new_fournisseur.php" enctype="multipart/form-data" method="POST">
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="nom_four">Nom Fournisseur </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="nom_four" value="" id="nom_four" required/>
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="RaisonSociale">Raison Sociale </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="RaisonSociale" value="" id="RaisonSociale" required/>
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="Ville">Adresse </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="Ville" value="" id="Ville" required/>
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="tel">Téléphone</label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="tel" value="" id="tel" required/>
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="Adresse_Courriel">E-mail </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="Adresse_Courriel" value="" id="Adresse_Courriel" required/>
			    	</div>
			    </div>
			</div>
			
		    			    
			<div class="form-group">
			    <div class="row">		
			  		<div class="col-md-12">
					    <input class="btn btn-primary pull-right" type="submit" name="submit" value="Ajouter Fournisseur" />
					</div>
			    </div>
			</div>
		  </form>

  	

<?php include_layout_template('admin_footer.php'); ?>
		
