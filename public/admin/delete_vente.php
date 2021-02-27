<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // must have an ID
  if(empty($_GET['id'])) {
    $session->message("Aucun vente n'a été selectionné.");
    redirect_to('index.php');
  }

  $vente = Vente::find_by_id($_GET['id']);
  $client = Client::find_by_id($vente->client);
  $client->dette = $client->dette - ($vente->price1*$vente->quantity1 + $vente->price2*$vente->quantity2 + $vente->price_tarifs);
  $stockProduitGM = Stock::find_by_id($vente->nom_produit1, '3');
  $stockProduitGM->quantity += $vente->quantity1;
  $stockProduitPM = Stock::find_by_id($vente->nom_produit2, '3');
  $stockProduitPM->quantity += $vente->quantity2;
  if($vente && $vente->destroy()) {
    $client->save();
    $stockProduitPM->save();
    $stockProduitGM->save();
    $session->message("La vente {$vente->nom} a été supprimé.");
    redirect_to('liste_ventes.php');
  } else {
    $session->message("La  vente ne peut pas être supprimé.");
    redirect_to('liste_ventes.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
