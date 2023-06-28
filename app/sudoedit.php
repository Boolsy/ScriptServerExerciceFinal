<?php
  session_name('PP' . date('Ymd'));
  session_start();

  include_once '../config.php';
  include_once '../lib/pdo.php';
  include_once '../lib/user.php';

  if (isset($_POST['id']) && isset($_POST['username']) && isset($_POST['email']) && isset($_POST['admin'])) {
    $userId = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $admin = $_POST['admin'];

    // Appel fonction homemade
    $validationError = SudoCtrl($userId, $username, $email, $admin);

    if (!empty($validationError)) {
      // Il y a une erreur de validation, afficher le message d'erreur
      $_SESSION['alert'] = $validationError;
      $_SESSION['alert-color'] = 'danger';
    } else {
      // Tous les champs sont valides, effectuer la mise à jour
      $connect = connect();
      $update = $connect->prepare('UPDATE user SET username = ?, email = ?, admin = ? WHERE id = ?');
      $update->execute([$username, $email, $admin, $userId]);

      if ($update->rowCount()) {
        $_SESSION['alert'] = 'Utilisateur modifié avec succès';
        $_SESSION['alert-color'] = 'success';
      } else {
        $_SESSION['alert'] = 'Erreur lors de la modification de l\'utilisateur';
        $_SESSION['alert-color'] = 'danger';
      }
    }

    header('Location: ../index.php?page=page/admin');
    exit();
  }
