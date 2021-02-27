<html lang="fr">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Tableau de bord</title>

    <meta name="description" content="overview &amp; stats" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />

    <!-- ace styles -->
    <link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
    <![endif]-->
    <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
    <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />

    <!--[if lte IE 9]>
      <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
    <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="assets/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.-js"></script>
    <![endif]-->
  </head>
  

     <div id="navbar" class="navbar navbar-default          ace-save-state">
      <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
          <span class="sr-only">Toggle sidebar</span>

          <span class="icon-bar"></span>

          <span class="icon-bar"></span>

          <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
          <a href="index.html" class="navbar-brand">
            <small>
              <i class="fa fa-leaf"></i>
              Administration
            </small>
          </a>
        </div>

        <div class="navbar-buttons navbar-header pull-right" role="navigation">
          <ul class="nav ace-nav">
            
            <li>
                  <a href="edit_password.php">
                    <i class="ace-icon fa fa-cog"></i>
                    Changer mot de passe
                  </a>
                </li>
            <?php if($_SESSION['user_role']==0) {?>
                <li>
                  <a href="liste_users.php">
                    <i class="ace-icon fa fa-user"></i>
                    Gestion utilisateurs
                  </a>
                </li>
                <?php }?>
                <li>
                  <a href="logout.php">
                    <i class="ace-icon fa fa-power-off"></i>
                    Déconnecté
                  </a>
                </li>
            <li class="light-blue dropdown-modal">
              <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                
                  Bienvenue <?php $user = User::find_by_id($_SESSION['user_id']); echo strtoupper($user->first_name);?>
                <span class="user-info">
                  
                </span>

                <i class="ace-icon fa fa-caret-down"></i>
              </a>

              <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                <li>
                  <a href="edit_password.php">
                    <i class="ace-icon fa fa-cog"></i>
                    Changer mot de passe
                  </a>
                </li>
                <?php if($_SESSION['user_role']==0) {?>
                <li>
                  <a href="liste_users.php">
                    <i class="ace-icon fa fa-user"></i>
                    Gestion utilisateurs
                  </a>
                </li>
                <?php }?>
                <li class="divider"></li>

                <li>
                  <a href="logout.php">
                    <i class="ace-icon fa fa-power-off"></i>
                    Déconnecté
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </div><!-- /.navbar-container -->
    </div>

<body class="no-skin">
    

    <div class="main-container ace-save-state" id="main-container">
      <script type="text/javascript">
        try{ace.settings.loadState('main-container')}catch(e){}
      </script>

      <div id="sidebar" class="sidebar                  responsive                    ace-save-state">
        <script type="text/javascript">
          try{ace.settings.loadState('sidebar')}catch(e){}
        </script>


        <ul class="nav nav-list">
          <?php if($_SESSION['user_role']==0) {?>
          <!--
          <li class="">
            <a href="index.php">
              <i class="menu-icon fa fa-tachometer"></i>
              <span class="menu-text"> Tableau de bord </span>
            </a>

            <b class="arrow"></b>
          </li>
          -->
          <?php }?>

          <li class="">
            <a href="achat_vente.php" >
              <i class="menu-icon fa fa-cart-arrow-down "></i>
              <span class="menu-text"> Mouvement </span>
            </a>
          </li>
        
          <li class="">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-exchange"></i>
              <span class="menu-text"> Entrés/Sorties </span>

              <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
              
              <li class="">
                <a href="liste_factures_achats.php">
                  <i class="menu-icon "></i>
                  <span class="menu-text"> Achat </span>
                </a>

                <b class="arrow"></b>
              </li>
              <li class="">
            <a href="liste_factures.php">
              <i class="menu-icon "></i>
              <span class="menu-text"> Ventes </span>
            </a>

            <b class="arrow"></b>
          </li>
            </ul>
          </li>
          
          <li class="">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-money"></i>
              <span class="menu-text "> Paiements </span>

              <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
              

              <li class="">
                <a href="versement_achat.php">
                  <i class="menu-icon "></i>
                  <span class="menu-text"> Créances </span>
                </a>

                <b class="arrow"></b>
              </li>
              <li class="">
            <a href="versement_vente.php">
              <i class="menu-icon "></i>
              <span class="menu-text"> Dettes </span>
            </a>

            <b class="arrow"></b>
          </li>
            </ul>
          </li>
               
          <li class="">
            <a href="facturation" target="_blank">
              <i class="menu-icon fa fa-file-archive-o "></i>
              <span class="menu-text"> Facturation </span>
            </a>

            <b class="arrow"></b>
          </li>


          <li class="">
            <a href="#" class="dropdown-toggle">
              <i class="menu-icon fa fa-cogs"></i>
              <span class="menu-text">
                Paramétrage
              </span>

              <b class="arrow fa fa-angle-down"></b>
            </a>

            <b class="arrow"></b>

            <ul class="submenu">
              
                

              <li class="">
                <a href="liste_magasins.php">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Magasins
                </a>

                <b class="arrow"></b>
              </li>
              <li class="">
                <a href="liste_elements.php">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Elements
                </a>

                <b class="arrow"></b>
              </li>
              <li class="">
                <a href="liste_etageres.php">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Etagères
                </a>

                <b class="arrow"></b>
              </li>
              <li class="">
                <a href="liste_plateaux.php">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Plateaux
                </a>

                <b class="arrow"></b>
              </li>

              

              <li class="">
                <a href="liste_products.php">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Produits
                </a>

                <b class="arrow"></b>
              </li>

              <li class="">
                <a href="liste_fournisseurs.php">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Fournisseurs
                </a>

                <b class="arrow"></b>
              </li>

              <li class="">
                <a href="liste_clients.php">
                  <i class="menu-icon fa fa-caret-right"></i>
                  Clients
                </a>

                <b class="arrow"></b>
              </li>
              
            </ul>
          </li>

        </ul><!-- /.nav-list -->

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
          <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
      </div>

      <div class="main-content">
        <div class="main-content-inner">
          <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
              <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Accueil</a>
              </li>
              <li class="active">Tableau de borad</li>
            </ul><!-- /.breadcrumb -->

            
          </div>

          <div class="page-content">