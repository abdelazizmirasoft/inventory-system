<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the photos
  $etageres = Etagere::find_all();
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Liste Etagères<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Ajouter/ Supprimer
                </small>
              </h1>
            </div><!-- /.page-header -->
            <div class="row">
                  <div class="col-md-7">
                    <a href="new_etagere.php"><input class="btn btn-primary pull-right" value="Nouveau étagère" /></a>
                  </div>
                </div>
      <br/>
          
                <!-- PAGE CONTENT BEGINS -->

<div class='alert alert-info'><?php echo output_message($message); ?></div>

<table id="dynamic-table" class="table table-striped table-bordered table-hover">
  <thead>
                          <tr>
                            <th>Nom </th>
                            <th>Supprimer</th>
                          </tr>
  </thead>

  <tbody>
  
<?php foreach($etageres as $etagere): ?>
 <tr>
    <td><?php echo $etagere->nom; ?></td>
    <td><a href="edit_etagere.php?id=<?php echo $etagere->id; ?>">Modifier</a></td> 
  </tr>
<?php endforeach; ?>
  </tbody>
</table>



<?php include_layout_template('admin_footer.php'); ?>
