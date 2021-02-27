<?php require_once("../../includes/initialize.php"); ?>
<?php if (!$session->is_logged_in()) { redirect_to("login.php"); } ?>
<?php
  // must have an ID
  if(empty($_GET['id'])) {
    $session->message("Aucun utilisateur n'a été selectionné.");
    redirect_to('index.php');
  }
  if($session->user_role!=0) {
    $session->message("Vous n'avez pas de priviléges pour effectuer cette action.");
    redirect_to('liste_users.php');
  }
  if($_GET['id'] == $session->user_id){
    $session->message("Vous ne pouvez pas supprimer l'utilisateur courrant");
    redirect_to('liste_users.php');
  }

  $user = User::find_by_id($_GET['id']);
  
  if($user && $user->destroy()) {
    $session->message("L'utilisateur {$user->username} a été supprimé.");
    redirect_to('liste_users.php');
  } else {
    $session->message("L'utilisateur ne peut pas être supprimé.");
    redirect_to('liste_users.php');
  }
  
?>
<?php if(isset($database)) { $database->close_connection(); } ?>
