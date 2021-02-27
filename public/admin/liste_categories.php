<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the photos
  $categories = Categorie::find_all();
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Liste Catégories<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Ajouter/ Supprimer
                </small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->

<div class='alert alert-info'><?php echo output_message($message); ?></div>

  <div class="row">
    <div class="col-md-6"><h4>Nom </h4></div>
		<div class="col-md-6"><h4>Supprimer</h4></div>
  </div>
  
  <hr>
<?php foreach($categories as $categorie): ?>
  <div class="row">
    <div class="col-md-6"><?php echo $categorie->nom; ?></div>
		<div class="col-md-6"><a href="edit_categorie.php?id=<?php echo $categorie->id; ?>">Modifier</a></div>
  </div>
  <hr>
<?php endforeach; ?>

<br/>



<?php include_layout_template('admin_footer.php'); ?>
