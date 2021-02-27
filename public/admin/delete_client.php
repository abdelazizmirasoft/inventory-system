<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
	// must have an ID
  if(empty($_GET['id'])) {
  	$session->message("Aucun client n'a été selectionné.");
    redirect_to('index.php');
  }

  $client = Client::find_by_id($_GET['id']);
  if($client && $client->destroy()) {
    $session->message("Le client {$client->nom} a été supprimé.");
    redirect_to('liste_clients.php');
  } else {
    $session->message("Le client ne peut pas être supprimé.");
    redirect_to('liste_clients.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
