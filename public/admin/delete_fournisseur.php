<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
	// must have an ID
  if(empty($_GET['id'])) {
  	$session->message("Aucun produit n'a été selectionné.");
    redirect_to('index.php');
  }

  $fournisseur = Fournisseur::find_by_id($_GET['id']);
  if($fournisseur && $fournisseur->destroy()) {
    $session->message("Le fournisseur {$fournisseur->nom_four} a été supprimé.");
    redirect_to('liste_fournisseurs.php');
  } else {
    $session->message("Le fournisseur ne peut pas être supprimé.");
    redirect_to('liste_fournisseurs.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
