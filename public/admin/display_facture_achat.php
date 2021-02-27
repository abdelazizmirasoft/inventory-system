<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  if(empty($_GET['id'])) {
    $session->message("Aucun produit n'a été selectionné.");
    redirect_to('index.php');
  }
  $facture = FactureAchat::find_by_id($_GET['id']);
  ?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

            <div class="page-header">
              <h1>Détails facture<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  
                </small>
              </h1>
            </div><!-- /.page-header -->
      
                <!-- PAGE CONTENT BEGINS -->
                <div class="row">
  
</div>
<br>
<!---->
                <div class="">
                  <div id="user-profile-2" class="user-profile">
                    <div class="tabbable">
                        
                      <div class="tab-content no-border padding-24">
                        <div id="home" class="tab-pane in active">
                          <div class="row">
                           

                            <div class="col-xs-12 col-sm-9">
                              <h4 class="blue">
                                <span class="middle"><b>N° Facture: <?php echo $facture->id; ?></b></span>
                              </h4>

                                <div class="profile-user-info">
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Date facture </b></div>

                                    <div class="profile-info-value">
                                      <span><b><?php echo $facture->date_facture; ?></b></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Client </b></div>
                                    <?php $client = Fournisseur::find_by_id($facture->id_client);?>
                                    <div class="profile-info-value">
                                      <span><b><?php echo $client->nom; ?></b></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Total </b></div>

                                    <div class="profile-info-value">
                                      <span><b><?php echo number_format($facture->total)." DZD"; ?></b></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Remise </b></div>

                                    <div class="profile-info-value">
                                      <span><b><?php echo number_format($facture->remise)." DZD"; ?></b></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Dette </b></div>

                                    <div class="profile-info-value">
                                      <span><b><?php echo number_format($facture->dette)." DZD"; ?></b></span>
                                    </div>
                                </div>
                                
                                
                              </div>
                            </div><!-- /.col -->
                          </div><!-- /.row -->

                          <div class="space-20"></div>

                         
                        </div><!-- /#home -->
                        <h2>Listes des articles achetés:</h2>
                       <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                                                <tr>
                                                  <th>Nom </th>
                                                  <th>Description</th>
                                                  <th>Prix Achat</th>
                                                  <th>Quantité</th>
                                                </tr>
                        
                        </thead>

                        <tbody>
                      <?php $items= ItemFactureAchat::find_by_sql("SELECT * FROM itemFactureAchat WHERE id_facture=".$database->escape_value($facture->id)); ?>  
                      <?php foreach($items as $item): ?>
                        <tr>
                        <?php $product = Product::find_by_id($item->id_product);?>
                          <td><?php echo $product->PART_NUMBER; ?></td>
                          <td><?php echo $product->DESCRIPTION; ?></td>
                          <td><?php echo number_format($item->PU_ACHAT); ?></td>
                          <td><?php echo number_format($item->quantity); ?></td>
                          
                        </tr>
                      <?php endforeach; ?>
                        </tbody>
                      </table>
                      <h2>Historique des versements:</h2>
                       <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                                                <tr>
                                                  <th>Date </th>
                                                  <th>Versement</th>
                                                </tr>
                        
                        </thead>

                        <tbody>
                      <?php $items= VersementAchat::find_by_facture($facture->id); 
                      //print_r($items); ?>  
                      <?php foreach($items as $item): ?>
                        <tr>                        
                          <td><?php echo $item->date; ?></td>
                          <td><?php echo $item->total; ?></td>
                        </tr>
                      <?php endforeach; ?>
                        </tbody>
                      </table>
                      </div>
                    </div>
                  </div>
                </div>

<!---->




<?php include_layout_template('admin_footer.php'); ?>+