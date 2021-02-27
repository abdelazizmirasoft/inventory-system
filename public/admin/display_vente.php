<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  if(empty($_GET['id'])) {
    $session->message("Aucun produit n'a été selectionné.");
    redirect_to('index.php');
  }
  $vente = Vente::find_by_id($_GET['id']);
  ?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

            <div class="page-header">
              <h1>Détails vente<small>
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
                                <span class="middle"><b>N° Facture: <?php echo $vente->id; ?></b></span>
                              </h4>

                                <div class="profile-user-info">
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Date vente </b></div>

                                    <div class="profile-info-value">
                                      <span><b><?php echo $vente->date_vente; ?></b></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Client </b></div>
                                    <?php $client = Client::find_by_id($vente->client);?>
                                    <div class="profile-info-value">
                                      <span><b><?php echo $client->nom; ?></b></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Total </b></div>

                                    <div class="profile-info-value">
                                      <span><b><?php echo number_format($vente->total)." DZD"; ?></b></span>
                                    </div>
                                </div>
                                
                                
                              </div>
                            </div><!-- /.col -->
                          </div><!-- /.row -->

                          <div class="space-20"></div>

                         
                        </div><!-- /#home -->

                       <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                                                <tr>
                                                  <th>Nom </th>
                                                  <th>Description</th>
                                                  <th>Prix </th>
                                                  <th>Quantité</th>
                                                </tr>
                        
                        </thead>

                        <tbody>
                      <?php $items= ItemList::find_by_sql("SELECT * FROM itemList WHERE id_vente=".$database->escape_value($vente->id)); ?>  
                      <?php foreach($items as $item): ?>
                        <tr>
                          <td><?php echo $item->id; ?></td>
                          <td><?php echo""; ?></td>
                          <td><?php echo $item->price; ?></td>
                          <td><?php echo number_format($item->price*$item->quantity); ?></td>
                          
                        </tr>
                      <?php endforeach; ?>
                        </tbody>
                      </table>

                       
                      </div>
                    </div>
                  </div>
                </div>

<!---->


<div class="row">
  <div class="col-md-7">
    <a href="liste_products.php"><input class="btn btn-primary pull-right" value="Imprimer " /></a>
  </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>