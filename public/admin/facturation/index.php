<?php //require_once("../../../includes/initialize.php"); ?>
<?php //if (!$session->is_logged_in()) { redirect_to("../login.php"); } ?>
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
                    <td class="meta-head">N°Facture</td>
                    <td><textarea>#000123</textarea></td>
                </tr>
                
                <tr>
                	<td class="meta-head">Client</td>
                    <td><textarea id="customer-title"></textarea></td>
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
		  
		  <tr class="item-row">
		      <td class="item-name"><div class="delete-wpr"><textarea>Nom Article</textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>
		      <td><textarea class="qty">1</textarea></td>
		      <td><textarea class="cost">0.00</textarea></td>
		      <td><span class="price">0.00</span></td>
		  </tr>
		  
		 
		  <tr id="hiderow">
		    <td colspan="4"><a id="addrow" href="javascript:;" title="Ajouter ligne">Ajouter ligne</a></td>
		  </tr>
		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="1" class="total-line balance">Remise</td>
		      <td class="total-value balance"><div id="subtotal">0 DZD</div></td>
		  </tr>
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="1" class="total-line balance">Versement</td>
		      <td class="total-value balance"><div id="tva">0 DZD</div></td>
		  </tr>
		  
		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="1" class="total-line balance">Total T.T.C</td>
		      <td class="total-value balance"><div id="total">0 DZD</div></td>
		  </tr>
	
		  
		
		</table>
		
		<div id="terms">
		  <h5>Termes</h5>
		  <textarea></textarea>
		</div>
	
	</div>
	
</body>

</html>