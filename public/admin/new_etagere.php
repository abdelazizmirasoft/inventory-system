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
		$etagere = new Etagere();
		$etagere->nom = $_POST['nom'];

		if($etagere->save()) {
			// Success
      $session->message("Etagere ajouter avec succés.");
			redirect_to('liste_etageres.php');
		} else {
			// Failure
      $message = join("<br />", $etagere->errors);
		}
	}
	
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Ajout Etagere<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>Détails de votre etagere</small>
              </h1>
            </div><!-- /.page-header -->
     <div class="row">
                  <div class="col-md-7">
                    <a href="new_etagere.php"><input class="btn btn-primary pull-right" value="Nouveau étagère" /></a>
                  </div>
                </div>
      <br/>
          
                <!-- PAGE CONTENT BEGINS -->
	<?php echo output_message($message); ?>
		
		  <form action="new_etagere.php" enctype="multipart/form-data" method="POST">
		    
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="nom">Nom de l'etagere </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="nom" value="" id="nom" required/>
			    	</div>
			    </div>
			</div>
			    
			<div class="form-group">
			    <div class="row">		
			  		<div class="col-md-12">
					    <input class="btn btn-primary pull-right" type="submit" name="submit" value="Ajouter Etagere" />
					</div>
			    </div>
			</div>
		  </form>

  	

<?php include_layout_template('admin_footer.php'); ?>
		
