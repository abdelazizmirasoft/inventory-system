<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
	// must have an ID
  if(empty($_GET['id'])) {
  	$session->message("Aucun magasin n'a été selectionné.");
    redirect_to('index.php');
  }

  $magasin = Magasin::find_by_id($_GET['id']);
  if($magasin && $magasin->destroy()) {
    $session->message("Le magasin {$magasin->nom} a été supprimé.");
    redirect_to('liste_magasins.php');
  } else {
    $session->message("Le magasin ne peut pas être supprimé.");
    redirect_to('liste_magasins.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
