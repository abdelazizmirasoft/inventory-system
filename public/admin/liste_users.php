<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } 
//echo "--".$session->user_role."--".$_SESSION['user_role'];
if($_SESSION['user_role']!=0) {
  $session->message("Vous n'avez pas de priviléges pour effectuer cette action.");
  redirect_to('journal.php');
}
?>
<?php
  // Find all the photos
  $users = User::find_all();
  $users = array_reverse($users, true);
?>
<!DOCTYPE html>
<?php include_layout_template('admin_header.php'); ?>

      

            <div class="page-header">
              <h1>Liste Utilisateurs<small>
                  <i class="ace-icon fa fa-angle-double-right"></i>
                  Ajouter/ Modifier/ Supprimer 
                </small>
              </h1>
            </div><!-- /.page-header -->

          
                <!-- PAGE CONTENT BEGINS -->

<div class='alert alert-info'><?php echo output_message($message); ?></div>

  <div class="row">
    <div class="col-md-2"><h4>ID </h4></div>
    <div class="col-md-2"><h4>Nom</h4></div>
    <div class="col-md-2"><h4>Prénom</h4></div>
    <div class="col-md-2"><h4>Rôle</h4></div>
    <div class="col-md-2"><h4>Mot de passe</h4></div>
    <div class="col-md-2"><h4>Gérer</h4></div>
  </div>
  
  <hr>
  
<?php foreach($users as $user): ?>
  <div class="row">
    <div class="col-md-2"><?php echo $user->username; ?></div>
    <div class="col-md-2"><?php echo $user->first_name; ?></div>   
    <div class="col-md-2"><?php echo $user->last_name; ?></div>   
    <div class="col-md-2"><?php echo $user->role==0?"Administrateur":"Gérant"; ?></div>   
    <div class="col-md-2"><?php echo $user->password; ?></div>   	
    <div class="col-md-2">
      <a class ="alert alert-info fa fa-edit" href="edit_user.php?id=<?php echo $user->id; ?>"></a>
      <?php if($user->id != $session->user_id){?>
        <a class ="alert alert-danger fa fa-trash-o bigger-120" href="delete_user.php?id=<?php echo $user->id; ?>"></a>
      <?php }?>
    </div>
  </div>
  <hr>
<?php endforeach; ?>
<br/>
<div class="row">
  <div class="col-md-7">
    <a href="new_user.php"><input class="btn btn-primary pull-right" value="Nouvel Utilisateur" /></a>
  </div>
</div>



<?php include_layout_template('admin_footer.php'); ?>
