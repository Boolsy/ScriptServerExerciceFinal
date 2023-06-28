<?php


  if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== 'Oui') {
    $_SESSION['alert'] = 'Vous n\'avez pas les droits pour effectuer cette action.';
    $_SESSION['alert-color'] = 'danger';
    exit();
  }


  if (isset($_GET['id'])) {
    $userId = $_GET['id'];

    // Vérifier si l'ID de session est différent de l'ID récupéré dans GET(Tips: du 22/06)
    if ($_SESSION['id'] == $userId) {
      $_SESSION['alert'] = 'Vous n\'avez pas le droit de vous suicidez.';
      $_SESSION['alert-color'] = 'danger';
      exit();
    }

    $connect = connect();

// Supprime l'utilisateur de la db
    $delete = $connect->prepare('DELETE FROM user WHERE id = ?');
    $delete->execute([$userId]);

    if ($delete->rowCount()) {
      $_SESSION['alert'] = 'L\'utilisateur a été supprimé avec succès.';
      $_SESSION['alert-color'] = 'success';
    } else {
      $_SESSION['alert'] = 'La suppression de l\'utilisateur a échoué.';
      $_SESSION['alert-color'] = 'danger';
    }
  } else {
    $_SESSION['alert'] = 'ID utilisateur manquant.';
    $_SESSION['alert-color'] = 'danger';
  }


  header('Location: index.php?page=page/admin');


