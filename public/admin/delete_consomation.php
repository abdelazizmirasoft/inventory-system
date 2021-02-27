<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // must have an ID
  if(empty($_GET['id'])) {
    $session->message("Aucune consomation n'a été selectionné.");
    redirect_to('index.php');
  }
  $consomation = Consomation::find_by_id($_GET['id']);
  // MAJ stock
  $stockProduit = StockMP::find_by_id($consomation->id_produit);
  $stockProduit->quantity-=$consomation->quantity;
  $stockProduit->save();
  $consomation = Consomation::find_by_id($_GET['id']);
  if($consomation && $consomation->destroy()) {
    $session->message("La consomation {$consomation->nom} a été supprimé.");
    redirect_to('liste_consomations.php');
  } else {
    $session->message("La consomation ne peut pas être supprimé.");
    redirect_to('liste_consomations.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
