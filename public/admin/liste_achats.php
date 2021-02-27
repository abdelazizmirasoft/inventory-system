<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the photos
  $achats = Achat::find_all();
  $achats = array_reverse($achats, true);
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Liste Achats<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Ajouter/ Modifier/ Supprimer 
                </small>
              </h1>
            </div><!-- /.page-header -->

<div class="row">
  <div class="col-md-7">
    <a href="new_achat.php"><input class="btn btn-primary pull-right" value="Nouvel Achat" /></a>
  </div>
</div>
<br>          
                <!-- PAGE CONTENT BEGINS -->

<div class='alert alert-info'><?php echo output_message($message); ?></div>

<table id="dynamic-table" class="table table-striped table-bordered table-hover">
  <thead>
                          <tr>
                            <th>Date Achat</th>
                            <th>Article</th>
                            <th>Quantité</th>
                            <th>PU_Achat</th>
                            <th>Total Prix</th>
                            <th>Modifier</th>
                          </tr>
  
  </thead>

  <tbody>
  
<?php foreach($achats as $achat): ?>
  <tr>
    <td><?php echo $achat->date_achat; ?></td>
    <td>  
    <?php $produit = Product::find_by_id($achat->nom);?>
    <a class="red" href="display_achat.php?id=<?php echo $achat->id; ?>"><?php  echo $produit->PART_NUMBER; ?></a></td>
    <td><?php echo $achat->quantity; ?></td>
    <?php $itemStock = ItemStock::find_by_achat($achat->id);?>
    <td><?php echo number_format($itemStock->PU_ACHAT); ?> DZD</td>
    <td><?php echo number_format($itemStock->PU_ACHAT*$achat->quantity); ?> DZD</td>
    <td><a href="delete_achat.php?id=<?php echo $achat->id; ?>">Supprimer</a></td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
<div class="row">
  <div class="col-md-7">
    <a href="new_achat.php"><input class="btn btn-primary pull-right" value="Nouvel Achat" /></a>
  </div>
</div>



<?php include_layout_template('admin_footer.php'); ?>
