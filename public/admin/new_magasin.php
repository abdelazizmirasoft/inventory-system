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
		$magaisn = new Magasin();
		$magaisn->nom = $_POST['nom'];
		$magaisn->adresse = $_POST['adresse'];

		if($magaisn->save()) {
			// Success
      $session->message("Matière première ajouter avec succés.");
			redirect_to('liste_magasins.php');
		} else {
			// Failure
      $message = join("<br />", $magaisn->errors);
		}
	}
	
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Ajout Magasin<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>Détails de votre magasin</small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->
	<?php echo output_message($message); ?>
		
		  <form action="new_magasin.php" enctype="multipart/form-data" method="POST">
		    
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="nom">Nom du magasin </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="nom" value="" id="nom" required/>
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="adresse">Adresse du magasin </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="adresse" value="" id="adresse" required/>
			    	</div>
			    </div>
			</div>		    
			<div class="form-group">
			    <div class="row">		
			  		<div class="col-md-12">
					    <input class="btn btn-primary pull-right" type="submit" name="submit" value="Ajouter Magasin" />
					</div>
			    </div>
			</div>
		  </form>

  	

<?php include_layout_template('admin_footer.php'); ?>
		
