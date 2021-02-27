<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the photos
  $products = Product::find_all();
?>



<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>



            <div class="page-header">
              <h1>
                Facturation
                <small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  créer une facture
                </small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->
               
                <div id="ignore-css">
                  
                <?php include("facture/index.php");?>
                </div>

                
                

                <!-- PAGE CONTENT ENDS -->
              <!-- /.col -->
            <!-- /.row -->
          </div><!-- /.page-content -->
        </div>
      </div><!-- /.main-content -->

      
<?php include_layout_template('admin_footer.php'); ?>



    <!-- inline scripts related to this page -->
    
  </body>
</html>


  <?php echo output_message($message); ?>
  
    
  

    
