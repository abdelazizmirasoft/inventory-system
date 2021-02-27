<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // must have an ID
  if(empty($_GET['id'])) {
    $session->message("Aucune facture n'a été selectionné.");
    redirect_to('index.php');
  }

  $facture = Facture::find_by_id($_GET['id']);
  if($facture){
    $items = ItemFacture::find_by_facture($facture->id);
    foreach ($items as $item) {
      $stockProduct = Stock::find_by_id($item->id_product);
      $stockProduct->quantity += $item->quantity;
      if($stockProduct->save()){}
    }
    if ($facture->destroy()) {
      $session->message("La facture {$vente->nom} a été supprimé.");
      redirect_to('liste_factures.php');
    }else{
      $session->message("La facture {$vente->nom} n'a pas été supprimé.");
      redirect_to('liste_factures.php');
    }
  }
  
?>

