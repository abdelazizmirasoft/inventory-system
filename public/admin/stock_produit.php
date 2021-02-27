<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the photos
  $stocks = Stock::find_all();
  $stocks = array_reverse($stocks, true);
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Stock Produits<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  
                </small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->

<?php echo output_message($message); ?>
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
  <thead>
                          <tr>
                            <th>Produit</th>
                            <th>Magasin</th>
                            <th>Quantité</th>
                          </tr>
  </thead>

  <tbody>
  
<?php foreach($stocks as $stock): ?>
  <tr>
    <?php $produit = Product::find_by_id($stock->id_product);?>
    <td><a class="red" href="display_stock.php?id=<?php echo $stock->id_product; ?>"><?php echo $produit->PART_NUMBER; ?></a></td>
    <td>
    <?php $magasin = Magasin::find_by_id($produit->id_magasin);?>
    <?php echo $magasin->nom; ?></td>
    <td><?php echo $stock->quantity; ?></td> 
  </tr>
<?php endforeach; ?>
  </tbody>
</table>




<?php include_layout_template('admin_footer.php'); ?>
