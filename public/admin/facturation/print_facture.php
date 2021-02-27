
<?php require_once("../../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("../login.php"); } ?>
<?php if(isset($_GET['id'])) {
		$total = 0;
		// LE CAS DES VENTES
        $facture = Facture::find_by_id($_GET['id']);
        $items = ItemFacture::find_by_facture($_GET['id']);
         
	  }
 ?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Etablire la facture</title>
	
	<link rel='stylesheet' type='text/css' href='css/style.css' />
	<link rel='stylesheet' type='text/css' href='css/print.css' media="print" />
	<script type='text/javascript' src='js/jquery-1.3.2.min.js'></script>
	<script type='text/javascript' src='js/example.js'></script>

</head>

<body>

	<div id="page-wrap">

		<textarea id="header">BON DE LIVRAION</textarea>
			
		<div id="identity">
		<div style="text-align: center;font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase;" >
				<h2></h2>
		<hr>
			</div>

			<textarea id="address">

Cité El-Makhfi section n° 02,
Lot 272, OULED HADDADJ 
BOUDOUAOU-BOUMERDES-

Mobile: 0774.23.53.74/0561.49.70.00
Tél/Fax: 024.84.58.74
			</textarea>
			
            <div id="logo">

              <div id="logoctr">
                <a href="javascript:;" id="change-logo" title="Changer logo">Changer</a>
                <a href="javascript:;" id="save-logo" title="Enregistrer modification">Enregistrer</a>
                |
                <a href="javascript:;" id="delete-logo" title="Supprimer logo">Supprimer</a>
                <a href="javascript:;" id="cancel-logo" title="Annuler changement">Annuler</a>
              </div>

              <div id="logohelp">
                <input id="imageloc" type="text" size="50" value="" /><br />
                (max largeur: 540px, max hauteur: 100px)
              </div>
              <img id="image" src="images/logo.jpg" alt="logo" />
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		<hr style="color: #000;"><br>
		<div id="customer">



            <table id="meta">
                <tr>
                    <td class="meta-head">Date</td>
                    <td><textarea id="date">December 15, 2017</textarea></td>
                </tr>

                <tr>
                    <td class="meta-head">N°Bon</td>
                    <td><textarea>#<?php echo $facture->id;?></textarea></td>
                </tr>
                
                <tr>
                	<td class="meta-head">Client</td>
                    <td><textarea id="customer-title"><?php echo $facture->nom_client;?></textarea></td>
                </tr>
            </table>
            
		
		</div>
		
		<table id="items">
		
		  <tr>
		      <th>Désignation</th>
		      <th>Quantité</th>
		      <th>Prix unitaire (DZD)</th>
		      <th>Prix (DZD)</th>
		  </tr>
		  <?php $total=0;
		  		foreach( $items as $item ) { 
                          $product=Product::find_by_id($item->id_product); ?>
						  <tr class="item-row">
						      <td class="item-name"><div class="delete-wpr"><textarea disabled><?php echo $product->DESCRIPTION; ?></textarea></div></td>
						      <td><textarea class="qty" disabled><?php echo $item->quantity;?></textarea></td>
						      <td><textarea class="cost" disabled><?php echo number_format($item->PU_VENTE); ?></textarea></td>
						      <td><span class="price" disabled><?php echo number_format($item->PU_VENTE*$item->quantity); ?></span></td>
						  </tr>
		  				  <?php } ?>
		 
		 
		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="1" class="total-line balance">Remise</td>
		      <td class="total-value balance"><div id="subtotal"><?php echo number_format($facture->remise);?> DZD</div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="1" class="total-line balance">Versement</td>
		      <td class="total-value balance"><div id="tva"><?php echo number_format($facture->premier_versement);?> DZD</div></td>
		  </tr>
		  
		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="1" class="total-line balance">Total T.T.C</td>
		      <td class="total-value balance"><div id="total"><?php echo number_format($facture->total);?> DZD</div></td>
		  </tr>
	
		  
		
		</table>
		
		<div id="terms">
		  <h5>Termes</h5>
		  <textarea></textarea>
		</div>
	
	</div>
	
</body>

</html>