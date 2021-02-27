<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
	// must have an ID
  if(empty($_GET['id'])) {
  	$session->message("Aucun produit n'a été selectionné.");
    redirect_to('index.php');
  }

  $product = Product::find_by_id($_GET['id']);
  $stock = Stock::find_by_id($_GET['id']);
  $stock->destroy();
  
  if($product && $product->destroy()) {

    $session->message("Le produit {$product->DESCRIPTION} a été supprimé.");
    redirect_to('liste_products.php');
  } else {
    $session->message("Le produit ne peut pas être supprimé.");
    redirect_to('liste_products.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
