<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  if(empty($_GET['id'])) {
    $session->message("Aucun produit n'a été selectionné.");
    redirect_to('index.php');
  }
  $product = Product::find_by_id($_GET['id']);
  ?>
<!DOCTYPE html>
<style type="text/css">
  img.modal-img {
  cursor: pointer;
  transition: 0.3s;
}
img.modal-img:hover {
  opacity: 0.7;
}
.img-modal {
  display: none;
  position: fixed;
  z-index: 99999;
  padding-top: 70px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0,0,0,0.9);
}
.img-modal img {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 100%;
}
.img-modal div {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 600px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}
.img-modal img, .img-modal div {
  animation: zoom 0.6s;
}
.img-modal span {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
  cursor: pointer;
}
@media only screen and (max-width: 600px) {
  .img-modal img {
    width: 70%;
  }
}
@keyframes zoom {
  0% {
    transform: scale(0);
  }
  70% {
    transform: scale(1);
  }
}


</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<?php include_layout_template('admin_header.php'); ?>

            <div class="page-header">
              <h1>Détails du produit<small>
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
                                <img class="modal-img"  alt="" id="avatar2" src="../<?php echo $product->image_path(); ?>" />
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
                                <?php $magasin = Magasin::find_by_id($product->id_magasin);?>
                                <?php $element = Element::find_by_id($product->id_element);?>
                                <?php $etagere = Etagere::find_by_id($product->id_etagere);?>
                                <?php $plateau = Plateau::find_by_id($product->id_plateau);?>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Emplacement </b></div>

                                    <div class="profile-info-value">
                                      <span><b><?php echo $magasin->nom.$element->nom.$etagere->nom.$plateau->nom; ?></b></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Prix U. PR </b></div>

                                    <div class="profile-info-value">
                                      <span><b><?php echo $product->UNIT_PR; ?></b></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Prix U. Achat </b></div>

                                    <div class="profile-info-value">
                                      <span><b><?php echo number_format($product->PU_ACHAT); ?></b></span>
                                    </div>
                                </div>
                                <div class="profile-info-row">
                                    <div class="profile-info-name"><b> Prix U. Vente </b></div>

                                    <div class="profile-info-value">
                                      <span><b><?php echo number_format($product->PU_VENTE); ?></b></span>
                                    </div>
                                </div>
                                
                              </div>
                            </div><!-- /.col -->
                          </div><!-- /.row -->

                          <div class="space-20"></div>

                         
                        </div><!-- /#home -->

                       

                       
                      </div>
                    </div>
                  </div>
                </div>

<!---->


<div class="row">
  <div class="col-md-7">
    <a href="liste_products.php"><input class="btn btn-primary pull-right" value="Retour à la liste " /></a>
  </div>
</div>
<script type="text/javascript">
  $('img.modal-img').each(function() {
    var modal = $('<div class="img-modal"><span>&times;</span><img /><div></div></div>');
    modal.find('img').attr('src', $(this).attr('src'));
    if($(this).attr('alt'))
      modal.find('div').text($(this).attr('alt'));
    $(this).after(modal);
    modal = $(this).next();
    $(this).click(function(event) {
      modal.show(300);
      modal.find('span').show(0.3);
    });
    modal.find('span').click(function(event) {
      modal.hide(300);
    });
  });
  $(document).keyup(function(event) {
    if(event.which==27)
      $('.img-modal>span').click();
  });


</script>
<?php include_layout_template('admin_footer.php'); ?>