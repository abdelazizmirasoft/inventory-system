<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  if(empty($_GET['id'])) {
    $session->message("Aucun produit n'a été selectionné.");
    redirect_to('index.php');
  }
  $achat = Achat::find_by_id($_GET['id']);
  $product = Product::find_by_id($achat->nom);
  $stock = ItemStock::find_by_achat($_GET['id']);
  ?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

            <div class="page-header">
              <h1>Détails du stock produit<small>
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
                            <div class="col-xs-12 col-sm-3 center">
                              <span class="profile-picture">
                                <img class="editable img-responsive" alt="" id="avatar2" src="../<?php echo $product->image_path(); ?>" />
                              </span>

                              <div class="space space-4"></div>

                              

                             
                            </div><!-- /.col -->

                            <div class="col-xs-12 col-sm-9">
                              <h4 class="blue">
                                <span class="middle"><b><?php echo $product->DESCRIPTION; ?></b></span>
                              </h4>

                                <div class="profile-user-info">
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Part Number </b></div>

                                    <div class="profile-info-value">
                                      <span><b><?php echo $product->PART_NUMBER; ?></b></span>
                                    </div>
                                </div>
                                
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Catégorie </b></div>

                                    <div class="profile-info-value">
                                    <?php if (strlen($product->categorie)!=0) $categorie = Categorie::find_by_id($product->categorie);?>
                                      <span><b><?php if (strlen($product->categorie)!=0) echo $categorie->nom; else echo "-"; ?></b></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Code </b></div>

                                    <div class="profile-info-value">
                                      <span><b><?php echo $product->CODIFICATION; ?></b></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Modèle </b></div>

                                    <div class="profile-info-value">
                                      <span><b><?php echo $product->MODEL; ?></b></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Magasin </b></div>

                                    <div class="profile-info-value">
                                    <?php $magasin = Magasin::find_by_id($product->id_magasin);?>
                                      <span><b><?php echo $magasin->nom; ?></b></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Element </b></div>

                                    <div class="profile-info-value">
                                    <?php $element = Element::find_by_id($product->id_element);?>
                                      <span><b><?php echo $element->nom; ?></b></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Etagère </b></div>

                                    <div class="profile-info-value">
                                    <?php $etagere = Etagere::find_by_id($product->id_etagere);?>
                                      <span><b><?php echo $etagere->nom; ?></b></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Plateaux </b></div>

                                    <div class="profile-info-value">
                                    <?php $palteaux = Plateau::find_by_id($product->id_plateau);?>
                                      <span><b><?php echo $palteaux->nom; ?></b></span>
                                    </div>
                                </div>
                                
                                
                                
                              </div>
                            </div><!-- /.col -->
                          </div><!-- /.row -->
                            <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                              <thead>
                                                      <tr>
                                                        <th>Quantité</th>
                                                        <th>Prix U. PR</th>
                                                        <th>Prix U. Achat</th>
                                                        <th>Prix U. Vente</th>
                                                      </tr>
                              </thead>

                              <tbody>
                              
                            <?php   ?>
                              <tr>                                
                                <td><?php echo $stock->quantity; ?></td> 
                                <td><?php echo $stock->UNIT_PR; ?></td> 
                                <td><?php echo $stock->PU_ACHAT; ?></td> 
                                <td><?php echo $stock->PU_VENTE; ?></td> 
                              </tr>
                            <?php  ?>
                              </tbody>
                            </table>
                          <div class="space-20"></div>

                         
                        </div><!-- /#home -->

                       

                       
                      </div>
                    </div>
                  </div>
                </div>

<!---->


<div class="row">
  <div class="col-md-7">
    <a href="stock_produit.php"><input class="btn btn-primary pull-right" value="Retour au stock " /></a>
  </div>
</div>

<?php include_layout_template('admin_footer.php'); ?>