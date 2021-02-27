<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>
<?php
	if (!isset($_GET['id'])) { redirect_to("index.php"); }
  	if(isset($_POST['submit'])){
		$categorie = Categorie::find_by_id($_GET['id']);
		if(!$categorie) {
		    $session->message("Categorie introuvable.");
		    redirect_to('liste_categories.php');
	  	}
  		if($_POST['nom']!="")
  			$categorie->nom = $_POST['nom'];
	  	//echo "--".$magasin->save();
		if($categorie->save()) {
					// Success
		      		$session->message("Categorie mis à jour avec succés.");
					redirect_to('liste_categories.php');
		}else {
			// Failure
      		$message = join("<br />", $categorie->errors);
      		redirect_to('liste_categories.php');
		}
  	}
?>

<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Modifier Categorie<small>
                  <i class="ace-icon fa fa-angle-double-right"></i></small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->
	<?php echo output_message($message); ?>
		
		  <form action="edit_categorie.php?id=<?php echo $_GET['id'];?>" enctype="multipart/form-data" method="POST">
		    
			
			
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="nom">Nom categorie</label>
			    	</div>
			    	<div class="col-md-4">
			    		<input class="form-control" type="text" name="nom" value="" id="nom" />
			    	</div>
			    	
			    </div>
			</div>
			   
			<hr>
			<div class="form-group">
			    <div class="row">		
			  		<div class="col-md-12">
					    <input class="btn btn-primary pull-right" type="submit" name="submit" value="Valider" />
					</div>
			    </div>
			</div>
		  </form>
  	

<?php include_layout_template('admin_footer.php'); ?>
		
+