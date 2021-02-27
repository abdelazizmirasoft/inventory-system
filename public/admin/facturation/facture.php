
<?php require_once("../../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("../login.php"); } ?>
<?php if(isset($_POST['submit'])) {
		$total = 0;
		// LE CAS DES ACHATS
		if(isset($_POST['FOURNISSEUR'])){
			print_r($_POST);

	        $facture = new FactureAchat();
	        $facture->total ='0';
	        $facture->dette ='0';
	        $facture->remise ='0';
	        $facture->id_client = "0";
	        $facture->date_facture =date("Y-m-d");
	        $facture->nom_client = " ";
	        // POUR IDENTIFIER LA QUANTITY (PAIRE) & LE PRIX (IMPAIRE)
	        $index = 0;
	        if ($facture->save()){
	        	foreach( $_POST as $key=>$stuff ) { 
	        		  if (strcmp($key, "FOURNISSEUR")==0 ) {
	        		  	$facture->id_client =  $stuff;
	        		  	$client=FOURNISSEUR::find_by_id($stuff);
	        		  	$facture->nom_client = $client->nom;
	        		  	continue;
	        		  }elseif (strcmp($key, "remise")==0 ) {
	        		  	$facture->remise = $stuff;
	        		  	continue;
	        		  }
	        		  $post = substr($key, 1);
		              if(!is_numeric($post)  or strlen($stuff)==0 or $stuff==0)
		                continue;
			          $product=Product::find_by_id($post);
		              // TO GET THE QUANTITY
		              $q=substr($key, 0, 1);
		              if($key[0] == 'q'){
			              $itemFacture = new ItemFactureAchat();
			              $itemFacture->id_facture = $facture->id;
			              $itemFacture->id_product = substr($key, 1);
			              $itemFacture->quantity = $stuff;
			              if($itemFacture->save()){};
			              //UPDATE STOCK
			              $stock = Stock::find_by_id($product->id);
			              $stock->quantity+=$itemFacture->quantity;
			              if($stock->save()){};
			              $index+=1;
			          }else{
		              	// TO GET THE PRICE
		              	  $itemFacture->PU_ACHAT = $stuff;
			              $total+= $stuff*$itemFacture->quantity;
			              if($itemFacture->save()){};
			              $index+=1;

			          }
			          

		        }
	        }
	        $facture->total = $total;
	        $facture->dette = $total-$facture->remise-preg_replace("/[^0-9\.]/", '', $_POST['versement']);;
	        $versement = new VersementAchat();
	        $versement->id_facture = $facture->id;
	        $versement->total = preg_replace("/[^0-9\.]/", '', $_POST['versement']);;
	        $versement->date = date("Y-m-d");
	        if ($versement->save()){}
	        if ($facture->save()){}
	        $session->message("Achat effectuer avec succés.");
			redirect_to("../achat_vente.php"); 
		}
		// LE CAS DES VENTES
        $facture = new Facture();
        $facture->total ='0';
        $facture->dette ='0';
        $facture->remise =0;
        $facture->id_client = "0";
        $facture->date_facture =date("Y-m-d");
        $facture->nom_client = " ";
        //print_r($_POST);
        if ($facture->save()){

        	foreach( $_POST as $key=>$stuff ) { 
        		  if (strcmp($key, "CLIENT")==0 and $stuff !=4 ) {
        		  	$facture->id_client =  $stuff;
        		  	$client=Client::find_by_id($stuff);
        		  	$facture->nom_client = $client->nom;
        		  	continue;
        		  }
        		  elseif($stuff == 4){
        		  	$facture->id_client = "4";
        		  	$facture->nom_client = $_POST['nom']." ".$_POST['prenom'];
        		  	continue;
        		  }elseif (strcmp($key, "prenom")==0 and $stuff ==4) {
        		  	//echo "string";
        		  	$facture->nom_client .= " ".$stuff;
        		  	continue;
        		  }elseif (strcmp($key, "remise")==0 ) {
        		  	$facture->remise = $stuff;
        		  	continue;
	        	  }
        		  
	              //echo "YES".$key;
	              if(!is_integer($key)  or strlen($stuff)==0 or $stuff==0)
	                continue;
	              $product=Product::find_by_id($key);
	              $itemFacture = new ItemFacture();
	              $itemFacture->id_facture = $facture->id;
	              $itemFacture->id_product = $key;
	              $itemFacture->PU_VENTE = $product->PU_VENTE;
	              $itemFacture->quantity = $stuff;
	              $total+= $stuff*$product->PU_VENTE;
	              if($itemFacture->save()){};
	              //UPDATE STOCK
	              $stock = Stock::find_by_id($product->id);
	              $stock->quantity-=$itemFacture->quantity;
	              if($stock->save()){};

	        }
        }
        $facture->total = $total;
        $facture->dette = $total-$facture->remise-preg_replace("/[^0-9]/", '', $_POST['versement']);
        $facture->premier_versement = preg_replace("/[^0-9\.]/", '', $_POST['versement']);
        $versement = new VersementVente();
        $versement->id_facture = $facture->id;
        $versement->total = preg_replace("/[^0-9\.]/", '', $_POST['versement']);;
        $versement->date = date("Y-m-d");
        if ($versement->save()){}
        if ($facture->save()){};
         
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
              <img id="image" src="images/logo.png" alt="logo" />
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
		  		foreach( $_POST as $key=>$stuff ) { 
                          if(!is_integer($key)  or strlen($stuff)==0 or $stuff==0)
                            continue;
                        ?>

                          <?php $product=Product::find_by_id($key); ?>
						  <tr class="item-row">
						      <td class="item-name"><div class="delete-wpr"><textarea disabled><?php echo $product->DESCRIPTION; ?></textarea></div></td>
						      <td><textarea class="qty" disabled><?php echo $stuff;?></textarea></td>
						      <td><textarea class="cost" disabled><?php echo number_format($product->PU_VENTE); ?></textarea></td>
						      <td><span class="price" disabled><?php echo number_format($product->PU_VENTE*$stuff); ?></span></td>
						  </tr>
		  				  <?php $total+= $stuff*$product->PU_VENTE;
		  				  		} ?>
		 
		 
		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="1" class="total-line balance">Remise</td>
		      <td class="total-value balance"><div id="subtotal"><?php echo $_POST['remise'];?> DZD</div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="1" class="total-line balance">Versement</td>
		      <td class="total-value balance"><div id="tva"><?php echo $_POST['versement'];?> DZD</div></td>
		  </tr>
		  
		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="1" class="total-line balance">Total T.T.C</td>
		      <td class="total-value balance"><div id="total"><?php echo number_format($total-$_POST['remise']);?> DZD</div></td>
		  </tr>
	
		  
		
		</table>
		
		<div id="terms">
		  <h5>Termes</h5>
		  <textarea></textarea>
		</div>
	
	</div>
	
</body>

</html>