<?php
require_once('../../includes/initialize.php');
if (!$session->is_logged_in()) { redirect_to("login.php"); }
?>
<?php
	
	$user = User::find_by_id($session->user_id);
	if(!$user) {
	    $session->message("The client could not be located.");
	    redirect_to('index.php');
  	}
  	if(isset($_POST['submit']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])){
  		$user->password = $_POST['new_password'];
  	}
  if($user->save()) {
			// Success
      		$session->message("Mot de passe mise à jour avec succés.");
			redirect_to('index.php');
		} else {
			// Failure
			
      		$message = join("<br />", $user->errors);
		}
?>

<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Changement de mot de passe<small>
                  <i class="ace-icon fa fa-angle-double-right"></i></small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->
	<?php echo output_message($message); ?>
		
		  <form action="edit_password.php" enctype="multipart/form-data" method="POST">
		    
			
			
			<div class="form-group">
			    <div class="row">
			  		<div class="col-md-3">
			    		<label for="new_password">Nouveau mot de passe</label>
			    	</div>
			    	<div class="col-md-4">
			    		<input class="form-control" type="password" name="new_password" value="" id="new_password" required/>
			    	</div>
			    	
			    </div>
			</div>
					
			
			<div class="form-group">
			    <div class="row">
			    	<div class="col-md-3">
			    		<label for="confirm_password">Confirmer mot de passe</label>
			    	</div>
			    	<div class="col-md-4">
			    		<input class="form-control" type="password" name="confirm_password" value="" id="confirm_password" required/>
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