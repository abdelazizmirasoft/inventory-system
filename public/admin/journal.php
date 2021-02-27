<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the photos
  $clients = Client::find_all();
  $clients = array_reverse($clients, true);
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

            <div class="page-header">
              <h1>Dernière Ventes<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Visualiser
                </small>
              </h1>
            </div><!-- /.page-header -->
      
                <!-- PAGE CONTENT BEGINS -->

<div class='ace-icon fa fa-hand-o-right alert alert-info'><?php echo output_message($message); ?></div>

  <div class="row">
    <div class="col-md-1"><h4>Date </h4></div>
    <div class="col-md-1"><h4>Client </h4></div>
    <div class="col-md-2"><h4>Quantité GM</h4></div>
    <div class="col-md-2"><h4>Quantité PM</h4></div>
    <div class="col-md-2"><h4>Retour GM</h4></div>
    <div class="col-md-2"><h4>Retour PM</h4></div>
    <div class="col-md-2"><h4>Créances</h4></div>
  </div>
  
  <hr>
<?php foreach($clients as $client): ?>
  <div class="row">
    <?php $vente = Vente::find_last_vente_client_id($client->id); ?>
    <div class="col-md-1"><?php echo $vente->date_vente; ?></div>
    <div class="col-md-1"><a href="new_vente.php"><?php echo $client->nom; ?></a></div>
    <div class="col-md-2"><?php echo $vente->quantity1; ?></div>   
    <div class="col-md-2"><?php echo $vente->quantity2; ?></div>   
    <div class="col-md-2"><?php echo $vente->retour1; ?></div>
    <div class="col-md-2"><?php echo $vente->retour2; ?> </div>
    <?php $dette = Dette::find_client_id($client->id); ?>
    <div class="col-md-2"><?php echo $dette->new_dette; ?> DZD</div>
  </div>
  
  <hr>
<?php endforeach; ?>
<br/>
<div class="row">
  <div class="col-md-7">  </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>