<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>jQuery czMore Plugin Demo</title>
    <link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        body {
          background-color:#fafafa;
          font-family:'Roboto';
        }

        .navbar-brand img {
            margin-top: -5px;
            margin-right: auto;
            margin-left: auto;
        }
        .container { margin:150px auto;}
    </style>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">


    <!-- Latest compiled and minified JavaScript -->
</head>
<body>

<div class="container">
<h1>jQuery czMore Plugin Demo</h1>
    <div class="well clearfix">
        <div id="czContainer">
            <div id="first">
                <div class="recordset">
                    <div class="fieldRow clearfix">
                        <div class="col-md-5">
                            <div id="div_id_stock_1_service" class="form-group">
                                <label for="id_stock_1_product" class="control-label  requiredField">
                                    Product<span class="asteriskField">*</span>
                                </label><div class="controls ">
                                            <input type="text" name="stock_1_product" id="id_stock_1_product" class="textinput form-control" />
                                </div>
                            </div>
                        </div><div class="col-md-3">
                            <div id="div_id_stock_1_unit" class="form-group">
                                <label for="id_stock_1_unit" class="control-label  requiredField">
                                    Unit<span class="asteriskField">*</span>
                                </label><div class="controls "><select class="select form-control" id="id_stock_1_unit" name="stock_1_unit"><option value="" selected="selected">---------</option><option value="1">1/2liter</option></select></div>
                            </div>
                        </div><div class="col-md-3">
                            <div id="div_id_stock_1_quantity" class="form-group">
                                <label for="id_stock_1_quantity" class="control-label  requiredField">
                                    Quantity<span class="asteriskField">*</span>
                                </label><div class="controls "><input class="numberinput form-control" id="id_stock_1_quantity" name="stock_1_quantity" step="0.01" type="number" /> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/jquery.czMore-1.5.3.2.js"></script>
    <script type="text/javascript">
        //One-to-many relationship plugin by Yasir O. Atabani. Copyrights Reserved.
        $("#czContainer").czMore();
    </script>
    </div>

</body>
</html>
