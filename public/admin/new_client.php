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

		$client = new CLient();
		$client->nom = $_POST['nom'];
		$client->adresse = $_POST['adresse'];
		$client->tel = $_POST['tel'];
		$client->email = $_POST['email'];
		$client->Raison_sociale = $_POST['Raison_sociale'];
		$client->dette = 0;

		if($client->save()) {
			// Success
			echo "yes is set";
      $session->message("Client ajouté avec succés.");
			redirect_to('liste_clients.php');
		} else {
			// Failure
      $message = join("<br />", $client->errors);
		}
	}
	
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Ajout Client<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Détails de votre client
                </small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->

	<?php echo output_message($message); ?>
		
		  <form action="new_client.php" enctype="multipart/form-data" method="POST">
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="nom">Nom Client </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="nom" value="" id="nom" required/>
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="adresse">Adresse </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="adresse" value="" id="adresse" required/>
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
			    		<label for="email">E-mail </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="email" value="" id="email" required/>
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="Raison_sociale">Raison Sociale </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="Raison_sociale" value="" id="Raison_sociale" required/>
			    	</div>
			    </div>
			</div>
			
		    			    
			<div class="form-group">
			    <div class="row">		
			  		<div class="col-md-12">
					    <input class="btn btn-primary pull-right" type="submit" name="submit" value="Ajouter Client" />
					</div>
			    </div>
			</div>
		  </form>
  	

<?php include_layout_template('admin_footer.php'); ?>
		
