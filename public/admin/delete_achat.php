<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // must have an ID
  if(empty($_GET['id'])) {
    $session->message("Aucun achat n'a été selectionné.");
    redirect_to('index.php');
  }

  $achat = Achat::find_by_id($_GET['id']);
  $stock = Stock::find_by_id($achat->nom);
  $stock->quantity-=$achat->quantity;
  $stock->save();
  if($achat && $achat->destroy()) {
    $session->message("L'achat {$achat->nom} a été supprimé.");
    redirect_to('liste_achats.php');
  } else {
    $session->message("L'achat ne peut pas être supprimé.");
    redirect_to('liste_achats.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
