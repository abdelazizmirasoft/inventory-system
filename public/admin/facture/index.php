<?php //require_once("../../../includes/initialize.php"); ?>
<?php //if (!$session->is_logged_in()) { redirect_to("../login.php"); } ?>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	
	<title>Etablire la facture</title>
	
	<link rel='stylesheet' type='text/css' href='facture/css/style.css' />
	<link rel='stylesheet' type='text/css' href='facture/css/print.css' media="print" />
	<script type='text/javascript' src='facture/js/jquery-1.3.2.min.js'></script>
	
	<script type='text/javascript' src='facture/js/example.js'></script>

</head>

<body>

	<div id="page-wrap">

		<textarea id="header">FACTURE</textarea>
		
		<div id="identity">
		
            <textarea id="address">
مؤسسة بن معزة مراد
حي طرابلس بودواو -بومرداس-

Mobile: 0774.23.53.74/0554.18.49.27
Tél/Fax: 024.84.58.74
</textarea>

            <div id="logo">

              <div id="logoctr">
                <a href="javascript:;" id="change-logo" title="Change logo">Changer Logo</a>
                <a href="javascript:;" id="save-logo" title="Save changes">Enregistrer</a>
                |
                <a href="javascript:;" id="delete-logo" title="Delete logo">Supprimer Logo</a>
                <a href="javascript:;" id="cancel-logo" title="Cancel changes">Annuler</a>
              </div>

              <div id="logohelp">
                <input id="imageloc" type="text" size="50" value="" /><br />
                (max largeur: 540px, max hauteur: 100px)
              </div>
              <img id="image" src="facture/images/logo.png" alt="logo" />
            </div>
		
		</div>
		
		<div style="clear:both"></div>
		
		<div id="customer">

            <textarea id="customer-title">Client:
Nom du client</textarea>

            <table id="meta">
                <tr>
                    <td class="meta-head">Numéro Facture #</td>
                    <td><textarea>000123</textarea></td>
                </tr>
                <tr>

                    <td class="meta-head">Date</td>
                    <td><textarea id="date">December 15, 2017</textarea></td>
                </tr>
                

            </table>
		
		</div>
		
		<table id="items">
		
		  <tr>
		      <th>Désignation</th>
		      <th>Déscription</th>
		      <th>Quantité</th>
		      <th>Prix unitaire</th>
		      <th>Prix</th>
		  </tr>
		  
		  <tr class="item-row">
		      <td class="item-name"><div class="delete-wpr"><textarea>Nom Article</textarea><a class="delete" href="javascript:;" onclick="delete()" title="Remove row">X</a></div></td>
		      <td class="description"><textarea>Déscription</textarea></td>
		      <td><textarea class="qty">1</textarea></td>
		      <td><textarea class="cost">0.00 DZD</textarea></td>
		      <td><span class="price">0.00 DZD</span></td>
		  </tr>
		  
		 
		  <tr id="hiderow">
		    <td colspan="5"><a id="addrow" href="javascript:;" title="Ajouter ligne">Ajouter ligne</a></td>
		  </tr>
		  
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Total</td>
		      <td class="total-value balance"><div id="subtotal">0.00 DZD</div></td>
		  </tr>
	
		  
		
		</table>
		
		<div id="terms">
		  <h5>Termes</h5>
		  <textarea></textarea>
		</div>
	
	</div>
	
</body>

</html>