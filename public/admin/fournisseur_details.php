<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
	if(empty($_GET['id'])) {
	  $session->message("Aucun ID fournisseur n'a été fournit.");
	  redirect_to('index.php');
	}
	
  $fournisseur = Fournisseur::find_by_id($_GET['id']);
  if(!$fournisseur) {
    $session->message("Le fournisseur n'a pas été retrouvé.");
    redirect_to('index.php');
  }

	$notPaidFacutres = FactureAchat::find_not_paid_by_id($fournisseur->id);
  $dette = 0;
  foreach($notPaidFacutres as $facture): 
    $dette += $facture->dette;
  endforeach;
  $paidFacutres    = FactureAchat::find_paid_by_id($fournisseur->id);
	
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

            <div class="page-header">
              <h1>Détails Fournisseur<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Ajouter/ Modifier/ Supprimer 
                </small>
              </h1>
            </div><!-- /.page-header -->
      
                <!-- PAGE CONTENT BEGINS -->

<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th>Nom Client </th>
        <th>Adresse </th>
        <th>Télephone </th>
        <th>Email </th>
        <th>Raison Sociale</th>
        <th>Total dette</th>
        <th>Action</th>
      </tr>
    </thead>

    <tbody>
      <tr>
        <td><b><?php echo $fournisseur->nom; ?></b></td> 
        <td><?php echo $fournisseur->Ville; ?></td> 
        <td><?php echo $fournisseur->tel; ?></td> 
        <td><?php echo $fournisseur->Adresse_Courriel; ?></td> 
        <td><?php echo $fournisseur->RaisonSociale; ?></td> 
        <td><?php echo number_format($dette); ?> DZD</td> 
        <td>
          <a><input type="button" value="Modifier" class="btn-success"></a>
          <a href="delete_fournisseur.php?id=<?php echo $fournisseur->id; ?>"><input type="button" value="Supprimer" class="btn-danger"></a>
        </td> 
      </tr>
    </tbody>
</table>
  



<br/>

<h2 style="color: red;"><b>Facture(s) non payée(s)</b></h2>



<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th>Date Facture </th>
        <th>ID Facture </th>
        <th>Fournisseur </th>
        <th>Dette</th>
        <th>Total </th>
        <th>Nouvel versement </th>
        <th>Action </th>
      </tr>
    </thead>

    <tbody>
    <?php foreach($notPaidFacutres as $facture): ?>
      <tr>
        <td><?php echo $facture->date_facture; ?></td>
        <td><a class = "red" href="display_facture_achat.php?id=<?php echo $facture->id;?>"><?php echo $facture->id; ?></a></td>
        <?php $client = Fournisseur::find_by_id($facture->id_client); ?>
        <td><a href="fournisseur_details.php?id=<?php echo $client->id; ?>"><?php echo $client->nom; ?></a></td>
        <td><?php echo number_format($facture->dette); ?> DZD</td>
        <td><?php echo number_format($facture->total); ?> DZD</td> 
        <form method="POST" action="versement_achat.php" >
          <td><input type="number" name="<?php echo $facture->id; ?>"></td>
          <td>
            <input type="submit" value="Versement" name="submit" class="btn-primary">
            <input type="submit" value="Ajouter" name="ajout" class="btn-danger">
          </td> 
        </form>
        

       
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<br/>

<h2 style="color: green;"><b>Facture(s) payée(s)</b></h2>



<table id="dynamic-table" class="table table-striped table-bordered table-hover">
    <thead>
      <tr>
        <th>Date Facture </th>
        <th>ID Facture </th>
        <th>Fournisseur </th>
        <th>Total </th>
        <th></th>
      </tr>
    </thead>

    <tbody>
    <?php foreach($paidFacutres as $facture): ?>
      <tr>
        <td><?php echo $facture->date_facture; ?></td>
        <td><a class = "red" href="display_facture_achat.php?id=<?php echo $facture->id;?>"><?php echo $facture->id; ?></a></td>
        <?php $client = Fournisseur::find_by_id($facture->id_client); ?>
        <td><a href="fournisseur_details.php?id=<?php echo $client->id; ?>"><?php echo $client->nom; ?></a></td>
        <td><?php echo number_format($facture->total); ?> DZD</td>
        <td></td> 
      </tr>
    <?php endforeach; ?>
    </tbody>
</table>


<?php include_layout_template('admin_footer.php'); ?>
