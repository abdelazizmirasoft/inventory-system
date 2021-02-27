<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
if($_SESSION['user_role']!=0)  {
	$session->message("Vous n'avez pas de priviléges pour effectuer cette action.");
	redirect_to('journal.php');
}
?>
<?php

	if(isset($_POST['submit'])) {
		$user = new User();
		$user->username = $_POST['username'];
		$user->first_name = $_POST['first_name'];
		$user->last_name = $_POST['last_name'];
		$user->role = $_POST['role'];
		$user->password = $_POST['password'];

		if($user->save()) {
			// Success
      		$session->message("Utilisateur ajouter avec succés.");
			redirect_to('liste_users.php');
		} else {
			// Failure
      		$message = join("<br />", $user->errors);
		}
	}
	
?>

<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Ajout Nouveau Utilisateur<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>Détails de votre utilisateur</small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->
	<?php echo output_message($message); ?>
		
		  <form action="new_user.php" enctype="multipart/form-data" method="POST">
		    
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="username">Identifiant (ID) </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="username" value="" id="username" required/>
			    	</div>
			    </div>
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="first_name">Nom </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="first_name" value="" id="first_name" required/>
			    	</div>
			    </div>
			</div>	
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="last_name">Prénom </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="text" name="last_name" value="" id="last_name" required/>
			    	</div>
			    </div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="role">Rôle </label>
			    	</div>
			    	<div class="col-md-9">
			    		<select name="role" class="form-control" required>
			    				<option value="">-- CHOISIR RÔLE --</option>
				    			<option value="0">Administrateur</option>
				    			<option value="1">Gérant</option>
			    		</select>
			    	</div>
			    </div>
			</div>		
			</div>
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="password">Mot de passe </label>
			    	</div>
			    	<div class="col-md-9">
			    		<input class="form-control" type="password" name="password" value="" id="password" required/>
			    	</div>
			    </div>
			</div>
			   
			<div class="form-group">
			    <div class="row">		
			  		<div class="col-md-12">
					    <input class="btn btn-primary pull-right" type="submit" name="submit" value="Ajouter Utilisateur" />
					</div>
			    </div>
			</div>
		  </form>
  	

<?php include_layout_template('admin_footer.php'); ?>
		
