<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the photos
  $ventes = Vente::find_all();
  $ventes = array_reverse($ventes, true);
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

            <div class="page-header">
              <h1>Liste Ventes<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Ajouter/ Modifier/ Supprimer 
                </small>
              </h1>
            </div><!-- /.page-header -->
      
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
  <div class="col-md-7">
    <a href="new_vente.php"><input class="btn btn-primary pull-right" value="Nouvelle Vente" /></a>
  </div>
</div>
<br>

<div class='ace-icon fa fa-hand-o-right alert alert-info'><?php echo output_message($message); ?></div>
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
  <thead>
                          <tr>
                            <th>Date Vente</th>
                            <th>Client </th>
                            <th>Total</th>
                            <th>Modifier</th>
                          </tr>
  
  </thead>

  <tbody>
  
<?php foreach($ventes as $vente): ?>
  <?php $client = Client::find_by_id($vente->client);?>
  <tr>
    <td><a class = "red" href="display_vente.php?id=<?php echo $vente->id;?>"><?php echo $vente->date_vente; ?></a></td>
    <td><a href="history_client_ventes.php?id_client=<?php echo $vente->client; ?>"><?php echo $client->nom; ?></a></td>
    <td><?php echo number_format($vente->total); ?></td>
    <td>
      <!--<a class ="alert alert-success fa fa-search-plus" href="edit_vente.php?id=<?php echo $vente->id; ?>"></a>-->
      <!--<a class ="alert alert-info fa fa-edit" href="edit_vente.php?id=<?php echo $vente->id; ?>"></a>-->
      <a class="red" href="delete_vente.php?id=<?php echo $vente->id; ?>"><i class="ace-icon fa fa-trash-o bigger-130"></i></a>
    </td>
  </tr>
<?php endforeach; ?>
  </tbody>
</table>
<div class="row">
  <div class="col-md-7">
    <a href="new_vente.php"><input class="btn btn-primary pull-right" value="Nouvelle Vente" /></a>
  </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>