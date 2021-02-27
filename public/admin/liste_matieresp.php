<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the photos
  $products = MatierePremiere::find_all();
?>

<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Matières Premières<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Ajouter/ Supprimer
                </small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->

<div class='alert alert-info'><?php echo output_message($message); ?></div>

  <div class="row">
    <div class="col-md-4"><h4>Nom</h4> </div>
    <div class="col-md-4"><h4>Prix</h4></div>
		<div class="col-md-4"><h4>Supprimer</h4></div>
  </div>
 
 <hr>
<?php foreach($products as $product): ?>
  <div class="row">
    <div class="col-md-4"><?php echo $product->nom; ?></div>
    <div class="col-md-4"><?php echo $product->PRIX; ?> DZD</div>		
		<div class="col-md-4"><a href="delete_matierep.php?id=<?php echo $product->id; ?>">Supprimer</a>|<a href="edit_matierep.php?id=<?php echo $product->id; ?>">Modifier</a></div>
  </div>
  <hr>
<?php endforeach; ?>

<br/>
<div class="row">
  <div class="col-md-7">
    <a href="new_matierep.php"><input class="btn btn-primary pull-right" value="Nouvelle matière première" /></a>
  </div>
</div>

                <!-- PAGE CONTENT ENDS -->
              <!-- /.col -->
            <!-- /.row -->
          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->

      

<?php include_layout_template('admin_footer.php'); ?>
