<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
	if(empty($_GET['id_client'])) {
	  $session->message("No photograph ID was provided.");
	  redirect_to('index.php');
	}
	
  $client = Client::find_by_id($_GET['id_client']);
  if(!$client) {
    $session->message("The client could not be located.");
    redirect_to('index.php');
  }

	$ventes = $client->ventes();
	
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

            <div class="page-header">
              <h1>Liste Ventes<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Ajouter/ Modifier/ Supprimer 
                </small>
              </h1>
            </div><!-- /.page-header -->
      
                <!-- PAGE CONTENT BEGINS -->


<h2>Historique des ventes du client: <a  href="client_details.php?id_client=<?php echo $client->id; ?>"><?php echo $client->nom; ?></a></h2>

<div class='ace-icon fa fa-hand-o-right alert alert-info'><?php echo output_message($message); ?></div>

  <div class="row">
    <div class="col-md-1"><h4>ID </h4></div>
    <div class="col-md-1"><h4>Client </h4></div>
    <div class="col-md-2"><h4>Produit </h4></div>
    <div class="col-md-1"><h4>Quantité </h4></div>
    <div class="col-md-1"><h4>Prix </h4></div>
    <div class="col-md-2"><h4>Total Prix</h4></div>
    <div class="col-md-2"><h4>Date Vente</h4></div>
		<div class="col-md-1"><h4>Modifier</h4></div>
  </div>
  
  <hr>
  <?php foreach($ventes as $vente): ?>
  <div class="row">
    <div class="col-md-1"><?php echo $vente->id; ?></div>
    <div class="col-md-1"><a href="history_client_ventes.php?id_client=<?php echo $vente->client; ?>"><?php echo $client->nom; ?></a></div>  
    <div class="col-md-6">
      <div class="row">    
          <?php $produit = Product::find_by_id($vente->nom_produit1);?>
          <div class="col-md-4"><?php echo $produit->description; ?></div>   
          <div class="col-md-2"><?php echo $vente->quantity1; ?></div>   
          <div class="col-md-2"><?php echo $vente->price1; ?> DZD</div>   
          <div class="col-md-4"><?php echo $vente->price1*$vente->quantity1; ?> DZD</div>    
      </div>
      <hr>
      <div class="row">    
        <?php $produit = Product::find_by_id($vente->nom_produit2);?>
        <div class="col-md-4"><?php echo $produit->description; ?></div>   
        <div class="col-md-2"><?php echo $vente->quantity2; ?></div>   
        <div class="col-md-2"><?php echo $vente->price2; ?> DZD</div>   
        <div class="col-md-4"><?php echo $vente->price2*$vente->quantity2; ?> DZD</div>    
      </div>
      <hr>
      <div class="row">    
        <div class="col-md-4"><u>Autres tarifs:</u> </br><?php echo $vente->tarifs; ?></div>   
        <div class="col-md-2">-</div>   
        <div class="col-md-2">-</div>   
        <div class="col-md-4"><?php echo $vente->price_tarifs; ?> DZD</div>    
      </div>
      <hr>
      <div class="row">    
        <div class="col-md-4"><u>Retour produit 1:</u> </br></div>   
        <div class="col-md-2"><?php echo $vente->retour1; ?></div>   
        <div class="col-md-2">-</div>   
        <div class="col-md-4"><?php echo $vente->price2*$vente->retour1; ?> DZD</div>    
      </div>
      <hr>
      <div class="row">    
        <div class="col-md-4"><u>Retour produit 2:</u> </br></div>   
        <div class="col-md-2"><?php echo $vente->retour2; ?></div>   
        <div class="col-md-2">-</div>   
        <div class="col-md-4"><?php echo $vente->price2*$vente->retour2; ?> DZD</div>    
      </div>
    
    </div>
        
    <div class="col-md-2"><?php echo $vente->date_vente; ?></div>   
    <div class="col-md-1">
      <a class ="alert alert-success fa fa-search-plus" href="edit_vente.php?id=<?php echo $vente->id; ?>"></a>
      <a class ="alert alert-info fa fa-edit" href="edit_vente.php?id=<?php echo $vente->id; ?>"></a>
      <a class ="alert alert-danger fa fa-trash-o bigger-120" href="delete_vente.php?id=<?php echo $vente->id; ?>"></a>
    </div>
  </div>
  <hr>
<?php endforeach; ?>

<a class="btn btn-primary" href="liste_ventes.php">&laquo; Retour</a><br />


<?php include_layout_template('admin_footer.php'); ?>
