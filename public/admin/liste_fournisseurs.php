<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the photos
  $fournisseurs = Fournisseur::find_all();
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Liste Fournisseurs<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Ajouter/ Supprimer
                </small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->
<div class='alert alert-info'><?php echo output_message($message); ?></div>
<table id="dynamic-table" class="table table-striped table-bordered table-hover">
  <thead>
                          <tr>
                            <th>Nom Fournisseur </th>
                            <th><h4>Raison Sociale</th>
                            <th>Ville</th>
                            <th>Télephone</th>
                            <th>Email</th>
                            <th>Dette</th>
                            <th>Gérer</th>
                          </tr>
  </thead>

  <tbody>
<?php foreach($fournisseurs as $fournisseur): ?>
  <tr>
    <td><?php echo $fournisseur->nom; ?></td>
    <td><?php echo $fournisseur->RaisonSociale; ?></td>
    <td><?php echo $fournisseur->Ville; ?></td>
    <td><?php echo $fournisseur->tel; ?></td>
    <td><?php echo $fournisseur->Adresse_Courriel; ?></td>
    <td><?php echo number_format($fournisseur->dette); ?></td>
    <td><a href="delete_fournisseur.php?id=<?php echo $fournisseur->id; ?>">Supprimer</a>|<a href="edit_fournisseur.php?id=<?php echo $fournisseur->id; ?>">Modifier</a></td> 
  </tr>
<?php endforeach; ?>
  </tbody>
</table>

<div class="row">
  <div class="col-md-7">
    <a href="new_fournisseur.php"><input class="btn btn-primary pull-right" value="Nouveau fournisseur" /></a>
  </div>
</div>

 
<?php include_layout_template('admin_footer.php'); ?>
