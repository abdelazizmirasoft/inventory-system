<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>
<?php
	if (!isset($_GET['id'])) { redirect_to("index.php"); }
  	if(isset($_POST['submit'])){
		$client = Client::find_by_id($_GET['id']);
		if(!$client) {
		    $session->message("Client introuvable.");
		    redirect_to('liste_clients.php');
	  	}
  		if($_POST['nom']!="")
  			$client->nom = $_POST['nom'];
  		if($_POST['adresse']!="")
  			$client->adresse = $_POST['adresse'];
  		if($_POST['tel']!="")
  			$client->tel = $_POST['tel'];
  		if($_POST['email']!="")
  			$client->email = $_POST['email'];
  		if($_POST['description']!="")
  			$client->Raison_sociale = $_POST['Raison_sociale'];
 
	  	//echo "--".$magasin->save();
		if($client->save()) {
					// Success
		      		$session->message("Client mis à jour avec succés.");
					redirect_to('liste_clients.php');
		}else {
			// Failure
      		$message = join("<br />", $client->errors);
      		redirect_to('liste_clients.php');
		}
  	}
?>


<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Modifier Client<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Détails de votre client
                </small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->

	<?php echo output_message($message); ?>
		
		  <form action="edit_client.php?id=<?php echo $_GET['id'];?>" enctype="multipart/form-data" method="POST">
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="nom">Nom Client </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="nom" value="" id="nom" />
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="adresse">Adresse </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="adresse" value="" id="adresse" />
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
			    		<label for="email">E-mail </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="email" value="" id="email" />
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="Raison_sociale">Raison Sociale </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="Raison_sociale" value="" id="Raison_sociale" />
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
		
