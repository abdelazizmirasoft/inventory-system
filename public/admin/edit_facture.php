<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // Find all the photos
  if (!isset($_GET['id'])){
    redirect_to("login.php");
  }
  if (isset($_POST["submit"])) {
    $facture = Facture::find_by_id($_GET['id']);
    $facture->premier_versement = preg_replace("/[^0-9]/", '', $_POST['versement']);
    $facture->remise = $_POST['remise'];
    $items = ItemFacture::find_by_facture($_GET['id']);
    $total = 0;
    foreach ($items as $item) {
      $stockProduct = Stock::find_by_id($item->id_product);
      $stockProduct->quantity += $item->quantity;
      $stockProduct->quantity -= $_POST[$item->id_product];
      if($stockProduct->save()){}
      $item->quantity = $_POST[$item->id_product];
      if($item->save()){}
      $product = Product::find_by_id($item->id_product);
      $total += $item->quantity*$product->PU_VENTE;
    }
    if($_POST['client'] == 4){
      if (isset($_POST['nom'])) {
        $facture->id_client = $_POST['client'];
        $facture->nom_client = $_POST['nom']." ".$_POST['prenom'];
      }
    }else{
      $facture->id_client = $_POST['client'];
      $client = Client::find_by_id($facture->id_client);
      $facture->nom_client = $client->nom;
    }
    $facture->total = $total;
    $facture->dette = $total-$facture->premier_versement;
    if($facture->save()){}
  }
  $facture = Facture::find_by_id($_GET['id']);
  $items = ItemFacture::find_by_facture($_GET['id']);
  //print_r($items);
  $clients = Client::find_all();
  $total = 0;
?>



<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

<!-- ***************************-->

<!-- ***************************-->

            <div class="page-header">
              <h1>
                Produits
                <small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Modifier
                </small>
              </h1>
            </div><!-- /.page-header -->
            <form method="POST" action="edit_facture.php?id=<?php echo $facture->id;?>" >
            <div class="form-group">
                <div class="row">
                  <div class="col-md-2">
                    <label for="client"><u><?php echo $type_client;?></u> </label>
                  </div>
                  <div class="col-md-2">
                    <select name="client" id="client" class="form-control" required="true">
                        <option value="">-- CHOISIR CLIENT --</option>
                      <?php foreach($clients as $client): ?>
                        <option value="<?php echo $client->id; ?>" <?php if($client->id==$facture->id_client) echo "selected"; ?>><?php echo $client->nom; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <input type="text" name="nom" id="nom" placeholder="Nom" style="display: none;">
                  </div>
                  <div class="col-md-3">
                    <input type="text" name="prenom" id="prenom" placeholder="Prénom" style="display: none;">
                  </div>
                </div>
            </div>
              
                <br>
          
                <!-- PAGE CONTENT BEGINS -->

                <div class='alert alert-info'><?php echo output_message($message); ?></div>
                <!-- -->
                <div>
                      <table id="dynamic-table" class="table table-striped table-bordered table-hover">
                        <thead>
                          <tr>
                            <th>Selectionner </th>
                            <th>N_Pièce </th>
                            <th>Emplacement </th>
                            <th>Description </th>
                            <th>Modele </th>
                            <th>Quantité </th>
                            <th>P.U Vente</th>
                          </tr>
                        </thead>

                        <tbody>
                        <?php foreach( $items as $item ) { 
                        
                        ?>
                      <?php $product=Product::find_by_id($item->id_product); ?>
                              <tr>
                                <td></td>
                                <td><?php echo $product->CODIFICATION; ?></td>
                                <?php $magasin = Magasin::find_by_id($product->id_magasin);?>
                                <?php $element = Element::find_by_id($product->id_element);?>
                                <?php $etagere = Etagere::find_by_id($product->id_etagere);?>
                                <?php $plateau = Plateau::find_by_id($product->id_plateau);?>
                                <td><?php echo $magasin->nom.$element->nom.$etagere->nom.$plateau->nom; ?></td>
                                <td><a class="red" href="display_product.php?id=<?php echo $product->id; ?>"><?php echo $product->DESCRIPTION; ?></a></td>
                                <td><?php echo $product->MODEL; ?></td>
                                <?php $stock = Stock::find_by_id($product->id);?>
                                <td><div class="col-md-6" ><input value="<?php echo $item->quantity;?>" type="number" width="30" name='<?php echo $product->id; ?>' max="<?php echo $stock->quantity; ?>" min="0" ></div><div class="col-md-4 col-md-offset-2"><b><?php echo $stock->quantity; ?></b></div></td> 
                                <td><?php echo number_format($product->PU_VENTE); ?></td> 
                                
                                <?php $total+= $stuff*$product->PU_VENTE; ?>
                               
                              </tr>
                        <?php 
                              } ?>
                        </tbody>
                      </table>
                    </div>
                  </div>

                <!-- -->

                <br/>
                
                
                
                <div class="row">
                <label class="col-md-2 col-md-offset-3"><b>Remise</b></label>
                  <div class="col-md-3">
                    <input name="remise" type="text"  value="0" />
                  </div>
                </div>
                <br>
                <div class="row">
                <label class="col-md-2 col-md-offset-3"><b>Versement</b></label>
                  <div class="col-md-3">
                    <input name="versement" type="text"  value="<?php echo number_format($facture->premier_versement)?>" />
                  </div>
                </div>
                <br>
                <div class="row">
                  <div class="col-md-7">
                    <input name="submit" type="submit" class="btn btn-primary pull-right" value="Effectuer Paiement" />
                  </div>
                </div>
               </form>   


<?php include_layout_template('admin_footer.php'); ?>
  <!-- basic scripts -->

    <!--[if !IE]> -->
    <script src="assets/js/jquery-2.1.4.min.js"></script>

    <!-- <![endif]-->

    <!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
    <script type="text/javascript">
      if('ontouchstart' in document.documentElement) document.write("<script src='assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
    </script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!-- page specific plugin scripts -->
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
    <script src="assets/js/dataTables.buttons.min.js"></script>
    <script src="assets/js/buttons.flash.min.js"></script>
    <script src="assets/js/buttons.html5.min.js"></script>
    <script src="assets/js/buttons.print.min.js"></script>
    <script src="assets/js/buttons.colVis.min.js"></script>
    <script src="assets/js/dataTables.select.min.js"></script>

    <!-- ace scripts -->
    <script src="assets/js/ace-elements.min.js"></script>
    <script src="assets/js/ace.min.js"></script>

    <!-- inline scripts related to this page -->
    <script type="text/javascript">
      jQuery(function($) {
        //initiate dataTables plugin
        var myTable = 
        $('#dynamic-table')
        //.wrap("<div class='dataTables_borderWrap' />")   //if you are applying horizontal scrolling (sScrollX)
        .DataTable( {
          bAutoWidth: false,
          "aoColumns": [
            { "bSortable": false },
            null, null,null, null, null,
            { "bSortable": false }
          ],
          "aaSorting": [],
          
          
          //"bProcessing": true,
              //"bServerSide": true,
              //"sAjaxSource": "http://127.0.0.1/table.php" ,
      
          //,
          //"sScrollY": "200px",
          //"bPaginate": false,
      
          //"sScrollX": "100%",
          //"sScrollXInner": "120%",
          //"bScrollCollapse": true,
          //Note: if you are applying horizontal scrolling (sScrollX) on a ".table-bordered"
          //you may want to wrap the table inside a "div.dataTables_borderWrap" element
      
          //"iDisplayLength": 50
      
      
          select: {
            style: 'multi'
          }
          } );
      
        
        
        $.fn.dataTable.Buttons.defaults.dom.container.className = 'dt-buttons btn-overlap btn-group btn-overlap';
        
        new $.fn.dataTable.Buttons( myTable, {
          buttons: [
            {
            "extend": "colvis",
            "text": "<i class='fa fa-search bigger-110 blue'></i> <span class='hidden'>Show/hide columns</span>",
            "className": "btn btn-white btn-primary btn-bold",
            columns: ':not(:first):not(:last)'
            },
            {
            "extend": "copy",
            "text": "<i class='fa fa-copy bigger-110 pink'></i> <span class='hidden'>Copy to clipboard</span>",
            "className": "btn btn-white btn-primary btn-bold"
            },
            {
            "extend": "csv",
            "text": "<i class='fa fa-database bigger-110 orange'></i> <span class='hidden'>Export to CSV</span>",
            "className": "btn btn-white btn-primary btn-bold"
            },
            {
            "extend": "excel",
            "text": "<i class='fa fa-file-excel-o bigger-110 green'></i> <span class='hidden'>Export to Excel</span>",
            "className": "btn btn-white btn-primary btn-bold"
            },
            {
            "extend": "pdf",
            "text": "<i class='fa fa-file-pdf-o bigger-110 red'></i> <span class='hidden'>Export to PDF</span>",
            "className": "btn btn-white btn-primary btn-bold"
            },
            {
            "extend": "print",
            "text": "<i class='fa fa-print bigger-110 grey'></i> <span class='hidden'>Print</span>",
            "className": "btn btn-white btn-primary btn-bold",
            autoPrint: false,
            message: 'This print was produced using the Print button for DataTables'
            }     
          ]
        } );
        myTable.buttons().container().appendTo( $('.tableTools-container') );
        
        //style the message box
        var defaultCopyAction = myTable.button(1).action();
        myTable.button(1).action(function (e, dt, button, config) {
          defaultCopyAction(e, dt, button, config);
          $('.dt-button-info').addClass('gritter-item-wrapper gritter-info gritter-center white');
        });
        
        
        var defaultColvisAction = myTable.button(0).action();
        myTable.button(0).action(function (e, dt, button, config) {
          
          defaultColvisAction(e, dt, button, config);
          
          
          if($('.dt-button-collection > .dropdown-menu').length == 0) {
            $('.dt-button-collection')
            .wrapInner('<ul class="dropdown-menu dropdown-light dropdown-caret dropdown-caret" />')
            .find('a').attr('href', '#').wrap("<li />")
          }
          $('.dt-button-collection').appendTo('.tableTools-container .dt-buttons')
        });
      
        ////
      
        setTimeout(function() {
          $($('.tableTools-container')).find('a.dt-button').each(function() {
            var div = $(this).find(' > div').first();
            if(div.length == 1) div.tooltip({container: 'body', title: div.parent().text()});
            else $(this).tooltip({container: 'body', title: $(this).text()});
          });
        }, 500);
        
        
        
        
        
        myTable.on( 'select', function ( e, dt, type, index ) {
          if ( type === 'row' ) {
            $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', true);
          }
        } );
        myTable.on( 'deselect', function ( e, dt, type, index ) {
          if ( type === 'row' ) {
            $( myTable.row( index ).node() ).find('input:checkbox').prop('checked', false);
          }
        } );
      
      
      
      
        /////////////////////////////////
        //table checkboxes
        $('th input[type=checkbox], td input[type=checkbox]').prop('checked', false);
        
        //select/deselect all rows according to table header checkbox
        $('#dynamic-table > thead > tr > th input[type=checkbox], #dynamic-table_wrapper input[type=checkbox]').eq(0).on('click', function(){
          var th_checked = this.checked;//checkbox inside "TH" table header
          
          $('#dynamic-table').find('tbody > tr').each(function(){
            var row = this;
            if(th_checked) myTable.row(row).select();
            else  myTable.row(row).deselect();
          });
        });
        
        //select/deselect a row when the checkbox is checked/unchecked
        $('#dynamic-table').on('click', 'td input[type=checkbox]' , function(){
          var row = $(this).closest('tr').get(0);
          if(this.checked) myTable.row(row).deselect();
          else myTable.row(row).select();
        });
      
      
      
        $(document).on('click', '#dynamic-table .dropdown-toggle', function(e) {
          e.stopImmediatePropagation();
          e.stopPropagation();
          e.preventDefault();
        });
        
        
        
        //And for the first simple table, which doesn't have TableTools or dataTables
        //select/deselect all rows according to table header checkbox
        var active_class = 'active';
        $('#simple-table > thead > tr > th input[type=checkbox]').eq(0).on('click', function(){
          var th_checked = this.checked;//checkbox inside "TH" table header
          
          $(this).closest('table').find('tbody > tr').each(function(){
            var row = this;
            if(th_checked) $(row).addClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', true);
            else $(row).removeClass(active_class).find('input[type=checkbox]').eq(0).prop('checked', false);
          });
        });
        
        //select/deselect a row when the checkbox is checked/unchecked
        $('#simple-table').on('click', 'td input[type=checkbox]' , function(){
          var $row = $(this).closest('tr');
          if($row.is('.detail-row ')) return;
          if(this.checked) $row.addClass(active_class);
          else $row.removeClass(active_class);
        });

      
        
      
        /********************************/
        //add tooltip for small view action buttons in dropdown menu
        $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
        
        //tooltip placement on right or left
        function tooltip_placement(context, source) {
          var $source = $(source);
          var $parent = $source.closest('table')
          var off1 = $parent.offset();
          var w1 = $parent.width();
      
          var off2 = $source.offset();
          //var w2 = $source.width();
      
          if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
          return 'left';
        }
        
        
        
        
        /***************/
        $('.show-details-btn').on('click', function(e) {
          e.preventDefault();
          $(this).closest('tr').next().toggleClass('open');
          $(this).find(ace.vars['.icon']).toggleClass('fa-angle-double-down').toggleClass('fa-angle-double-up');
        });
        /***************/
        
        
        /*****************/
        $('#client').change(function(){
          /// 4 = client ordinaire
          if($(this).val()=="4"){
            $('#nom').show();
            $('#prenom').show();
          }else{
            $('#nom').hide();
            $('#prenom').hide();
          }

        });
        /*****************/
        
        
        /**
        //add horizontal scrollbars to a simple table
        $('#simple-table').css({'width':'2000px', 'max-width': 'none'}).wrap('<div style="width: 1000px;" />').parent().ace_scroll(
          {
          horizontal: true,
          styleClass: 'scroll-top scroll-dark scroll-visible',//show the scrollbars on top(default is bottom)
          size: 2000,
          mouseWheelLock: true
          }
        ).css('padding-top', '12px');
        */
      
      
      })
    </script>
        
  </body>
</html>


  <?php echo output_message($message); ?>
  
    
  

  