<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the dettes
  $fournisseurs = Fournisseur::dettes();
  //$fournisseurs = array_reverse($fournisseurs, true);
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

            <div class="page-header">
              <h1>Liste Dettes<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Effectuer paiement 
                </small>
              </h1>
            </div><!-- /.page-header -->
      
                <!-- PAGE CONTENT BEGINS -->

<div class='ace-icon fa fa-hand-o-right alert alert-info'><?php echo output_message($message); ?></div>
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
  <thead>
                          <tr>
                            <th>Fournisseur </th>
                            <th>Total dettes </th>
                            <th>Paiement</th>
                          </tr>
  </thead>

  <tbody>
  
<?php foreach($fournisseurs as $fournisseur): ?>
  <tr>
    <td><a href="history_dettes_fournisseur.php?id_fournisseur=<?php echo $fournisseur->id; ?>"><?php echo $fournisseur->nom_four; ?></a></td>
    <td><?php echo number_format($fournisseur->dette); ?> DZD</td>
    <td>
      <!--<a class ="alert alert-success fa fa-search-plus" href="edit_vente.php?id=<?php echo $fournisseur->id; ?>"></a>-->
      <a class ="alert alert-info fa fa-money" href="payement_mes_dettes.php?id_fournisseur=<?php echo $fournisseur->id; ?>"></a>
    </td> 
  </tr>
<?php endforeach; ?>
  </tbody>
</table>

<?php include_layout_template('admin_footer.php'); ?>