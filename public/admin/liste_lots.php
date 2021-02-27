<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the photos
  $lots = Lot::find_all();
  $lots = array_reverse($lots, true);
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

<table id="dynamic-table" class="table table-striped table-bordered table-hover">
  <thead>
                          <tr>
                            <th>ID </th>
                            <th>Produit</th>
                            <th>Magasin</th>
                            <th>Date production</th>
                            <th>Date expiration</th>
                            <th>Quantité</th>
                            <th>Modifier</th>
                          </tr>
  </thead>
<tbody>
<?php foreach($lots as $lot): ?>
  <tr>
    <td>
    <?php $produit = Product::find_by_id($lot->id_produit);?>
    <?php echo $lot->id; ?></td>
    <td><?php echo $produit->PART_NUMBER; ?></td>
    <td> 
    <?php $magasin = Magasin::find_by_id($lot->id_magasin);?> 
    <?php echo $magasin->nom; ?></td>
    <td><?php echo $lot->date_production; ?></td>
    <td><?php echo $lot->date_expiration; ?></td>
    <td><?php echo $lot->quantity; ?></td>
    <td><a href="edit_lot.php?id=<?php echo $lot->id; ?>">Modifier</a> | <a href="delete_lot.php?id=<?php echo $lot->id; ?>">Supprimer</a></td>
  </tr>

<?php endforeach; ?>
  </tbody>
</table>
<div class="row">
  <div class="col-md-7">
    <a href="new_lot.php"><input class="btn btn-primary pull-right" value="Nouveau lot" /></a>
  </div>
</div>



<?php include_layout_template('admin_footer.php'); ?>
