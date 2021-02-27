<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the photos
  $clients = Client::find_all();
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Liste Clients<small>
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
                            <th>Nom Client </th>
                            <th>Adresse</th>
                            <th>Télephone</th>
                            <th>Email</th>
                            <th>Raison Sociale</th>
                            <th>Créance</th>
                            <th>Gérer</th>
                          </tr>
  </thead>

  <tbody>
<?php foreach($clients as $client): ?>
  <tr>
    <td><?php echo $client->nom; ?></td>
    <td><?php echo $client->adresse; ?></td>
    <td><?php echo $client->tel; ?></td>
    <td><?php echo $client->email; ?></td>
    <td><?php echo $client->Raison_sociale; ?></td>
    <td><?php echo number_format($client->dette); ?> DZD</td>
    <td><a  href="client_details.php?id=<?php echo $client->id; ?>">Détails</a>|<a  href="edit_client.php?id=<?php echo $client->id; ?>">Modifier</a></td> 
  </tr>
<?php endforeach; ?>
  </tbody>
</table>

<div class="row">
  <div class="col-md-7">
    <a href="new_client.php"><input class="btn btn-primary pull-right" value="Nouveau client" /></a>
  </div>
</div>

                <!-- PAGE CONTENT ENDS -->
              <!-- /.col -->
            <!-- /.row -->
          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->

      
      
<?php include_layout_template('admin_footer.php'); ?>
