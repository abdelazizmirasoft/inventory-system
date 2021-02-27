<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
	// must have an ID
  if(empty($_GET['id'])) {
  	$session->message("Aucun produit n'a été selectionné.");
    redirect_to('index.php');
  }

  $product = MatierePremiere::find_by_id($_GET['id']);

  if($product && $product->destroy()) {
    $stockMP = StockMP::find_by_id($_GET['id']);
    $stockMP->destroy();
    $session->message("Le produit {$product->nom} a été supprimé.");
    redirect_to('liste_matieresp.php');
  } else {
    $session->message("Le produit ne peut pas être supprimé.");
    redirect_to('liste_matieresp.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
