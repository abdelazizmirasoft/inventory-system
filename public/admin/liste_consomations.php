<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the photos
  $consomations = Consomation::find_all();
  $consomations = array_reverse($consomations, true);
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Consomations Produits<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Ajouter/ Modifier/ Supprimer 
                </small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->

<div class='alert alert-info'><?php echo output_message($message); ?></div>

  <div class="row">
    <div class="col-md-2"><h4>Date </h4></div>
    <div class="col-md-2"><h4>ID </h4></div>
    <div class="col-md-3"><h4>Produit</h4></div>
    <div class="col-md-3"><h4>Quantité</h4></div>
		<div class="col-md-2"><h4>Modifier</h4></div>
  </div>
  
  <hr>
  
<?php foreach($consomations as $consomation): ?>
  <div class="row">
    <?php $produit = MatierePremiere::find_by_id($consomation->id_produit);?>
    <div class="col-md-2"><?php echo $consomation->date_consomation; ?></div>   
    <div class="col-md-2"><?php echo $consomation->id; ?></div>
    <div class="col-md-3"><?php echo $produit->nom; ?></div>   
    <div class="col-md-3"><?php echo $consomation->quantity; ?></div>		
    <div class="col-md-2"><a href="edit_consomation.php?id=<?php echo $consomation->id; ?>">Modifier</a> | <a href="delete_consomation.php?id=<?php echo $consomation->id; ?>">Supprimer</a></div>
  </div>
  <hr>
<?php endforeach; ?>
<br/>
<div class="row">
  <div class="col-md-7">
    <a href="new_consomation.php"><input class="btn btn-primary pull-right" value="Nouveau consomation" /></a>
  </div>
</div>



<?php include_layout_template('admin_footer.php'); ?>
