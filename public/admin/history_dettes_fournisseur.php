<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the dettes
  if(empty($_GET['id_fournisseur'])) {
    $session->message("No photograph ID was provided.");
    redirect_to('index.php');
  }
 $fournisseur = Fournisseur::find_by_id($_GET['id_fournisseur']);
  if(!$fournisseur) {
    $session->message("The photo could not be located.");
    redirect_to('liste_mes_dettes.php');
  }
  $dettes_history = $fournisseur->history_dettes();
  //$fournisseurs = array_reverse($fournisseurs, true);
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

            <div class="page-header">
              <h1>Historique Dettes<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Effectuer paiement 
                </small>
              </h1>
            </div><!-- /.page-header -->
      
                <!-- PAGE CONTENT BEGINS -->
<h2>Historique des paiements de dettes du fournisseur: <a  href="fournisseur_details.php?id_fournisseur=<?php echo $fournisseur->id; ?>"><?php echo $fournisseur->nom_four; ?></a></h2>                

<div class='ace-icon fa fa-hand-o-right alert alert-info'><?php echo output_message($message); ?></div>

  <div class="row">
    <div class="col-md-1 col-md-offset-1"><h4>ID </h4></div>
    <div class="col-md-2"><h4>Paiement effectué </h4></div>
    <div class="col-md-3"><h4>Dette avant paiement </h4></div>
    <div class="col-md-3"><h4>Dette aprés paiement</h4></div>
		<div class="col-md-2"><h4>Date paiement</h4></div>
  </div>
  
  <hr>
  
<?php foreach($dettes_history as $dette): ?>
  <div class="row">
    <div class="col-md-1 col-md-offset-1"><?php echo $dette->id; ?></div>  
    <div class="col-md-2"><?php echo number_format($dette->somme); ?></div>
    <div class="col-md-3"><?php echo number_format($dette->last_dette); ?></div>
    <div class="col-md-3"><?php echo number_format($dette->new_dette); ?></div>
    <div class="col-md-2"><?php echo $dette->date_payement; ?></div>
    
  </div>
  <hr>
<?php endforeach; ?>
<br/>

<?php include_layout_template('admin_footer.php'); ?>