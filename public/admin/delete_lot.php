<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // must have an ID
  if(empty($_GET['id'])) {
    $session->message("Aucun lot n'a été selectionné.");
    redirect_to('index.php');
  }
  $lot = Lot::find_by_id($_GET['id']);
  // MAJ stock
  $stockProduit = Stock::find_by_id($lot->id_produit, $lot->id_magasin);
  $stockProduit->quantity-=$lot->quantity;
  $stockProduit->save();
  $lot = Lot::find_by_id($_GET['id']);
  if($lot && $lot->destroy()) {
    $session->message("Le lot {$lot->nom} a été supprimé.");
    redirect_to('liste_lots.php');
  } else {
    $session->message("Le lot ne peut pas être supprimé.");
    redirect_to('liste_lots.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
