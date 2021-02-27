<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the photos
  $stocks = StockMP::find_all();
  $stocks = array_reverse($stocks, true);
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Stock Matières Premières
                <small>
                  <i class="ace-icon fa fa-angle-double-right"></i>                  
                </small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->

<?php echo output_message($message); ?>

  <div class="row">
    <div class="col-md-4"><h4>Date </h4></div>
    <div class="col-md-4"><h4>Produit</h4></div>
    <div class="col-md-4"><h4>Quantité</h4></div>
  </div>
  
  <hr>
  
<?php foreach($stocks as $stock): ?>
  <div class="row">
  <?php $produit = MatierePremiere::find_by_id($stock->id_product);?>
    <div class="col-md-4"><?php echo $stock->date_alimentation; ?></div> 
    <div class="col-md-4"><?php echo $produit->nom; ?></div>   
    <div class="col-md-4"><?php echo $stock->quantity; ?></div>   
  </div>
  <hr>
<?php endforeach; ?>
<br/>




<?php include_layout_template('admin_footer.php'); ?>
