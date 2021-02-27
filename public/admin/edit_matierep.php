<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>
<?php
	if (!isset($_GET['id'])) { redirect_to("index.php"); }
  	if(isset($_POST['submit'])){
		$matierePremiere = MatierePremiere::find_by_id($_GET['id']);
		if(!$matierePremiere) {
		    $session->message("Matiere Premiere introuvable.");
		    redirect_to('liste_matieresp.php');
	  	}
  		if($_POST['nom']!="")
  			$matierePremiere->nom = $_POST['nom'];
  		if($_POST['price']!="")
  			$matierePremiere->PRIX = $_POST['price'];
  		
	  	//echo "--".$magasin->save();
		if($matierePremiere->save()) {
			// Success
      		$session->message("Produit mis à jour avec succés.");
			redirect_to('liste_matieresp.php');
		}else {
			// Failure
      		$message = join("<br />", $matierePremiere->errors);
      		redirect_to('liste_matieresp.php');
		}
  	}
?>

<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Modifier Matière Première<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>Détails de votre produit</small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->
	<?php echo output_message($message); ?>
		
		  <form action="edit_matierep.php?id=<?php echo $_GET['id'];?>" enctype="multipart/form-data" method="POST">
		    
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="nom">Nom de la matière </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="nom" value="" id="nom" />
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="price">Prix de la matière </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="price" value="" id="price" />
			    	</div>
			    </div>
			</div>		    
			<div class="form-group">
			    <div class="row">		
			  		<div class="col-md-12">
					    <input class="btn btn-primary pull-right" type="submit" name="submit" value="Modifier Produit" />
					</div>
			    </div>
			</div>
		  </form>
  	

<?php include_layout_template('admin_footer.php'); ?>
		
