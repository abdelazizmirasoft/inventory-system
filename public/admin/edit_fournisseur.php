<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>
<?php
	if (!isset($_GET['id'])) { redirect_to("index.php"); }
  	if(isset($_POST['submit'])){
		$fournisseur = Fournisseur::find_by_id($_GET['id']);
		if(!$fournisseur) {
		    $session->message("Fournisseur introuvable.");
		    redirect_to('liste_fournisseurs.php');
	  	}
  		if($_POST['nom_four']!="")
  			$fournisseur->nom_four = $_POST['nom_four'];
  		if($_POST['RaisonSociale']!="")
  			$fournisseur->RaisonSociale = $_POST['RaisonSociale'];
  		if($_POST['Ville']!="")
  			$fournisseur->Ville = $_POST['Ville'];
  		if($_POST['tel']!="")
  			$fournisseur->tel = $_POST['tel'];
  		if($_POST['Adresse_Courriel']!="")
  			$fournisseur->Adresse_Courriel = $_POST['Adresse_Courriel'];
  		
	  	//echo "--".$magasin->save();
		if($fournisseur->save()) {
					// Success
      		$session->message("Forunisseur mis à jour avec succés.");
			redirect_to('liste_fournisseurs.php');
		}else {
			// Failure
      		$message = join("<br />", $fournisseur->errors);
      		redirect_to('liste_fournisseurs.php');
		}
  	}
?>

<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Modifier Forunisseur<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>Détails de votre fournisseur</small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->
	<?php echo output_message($message); ?>
		
		  <form action="edit_fournisseur.php?id=<?php echo $_GET['id'];?>" enctype="multipart/form-data" method="POST">
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="nom_four">Nom Fournisseur </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="nom_four" value="" id="nom_four" />
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="RaisonSociale">Raison Sociale </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="RaisonSociale" value="" id="RaisonSociale" />
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="Ville">Adresse </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="Ville" value="" id="Ville" />
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="tel">Téléphone</label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="tel" value="" id="tel" />
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="Adresse_Courriel">E-mail </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="Adresse_Courriel" value="" id="Adresse_Courriel" />
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
		
