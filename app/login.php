<?php
  include_once 'check.php';

  if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $login = trim($_POST['username']);

    $user = getUser('username', $_POST['username']);


    if ($user) {
      if (password_verify($_POST['password'], $user->password)) {
        $_SESSION['id'] = $user->id;

        if ($user->admin == 1) {
          $_SESSION['admin'] = 'Oui';
        } else {
          $_SESSION['admin'] = 'Non';
        }

        $sql = "UPDATE user SET lastlogin = NOW() WHERE id = ?";
        // QUERY
        $connect = connect();
        $update = $connect->prepare($sql);
        // EXECUTE
        $update->execute([$user->id]);

        if ($update->rowCount()) {
          echo 'Dernière précédente connexion : ' . $user->lastlogin;
        }

        $_SESSION['alert'] = 'Bienvenue ' . $user->username . '!';
        $_SESSION['alert-color'] = 'success';
        $url = 'index.php?page=page/profil';
      } else {
        $_SESSION['alert'] = 'Mot de passe incorrect';
        $url = 'index.php?page=page/login';
      }
    } else {
      $_SESSION['alert'] = 'Utilisateur non enregistré';
      $url = 'index.php?page=page/login';
    }


    header('Location: ' . $url);
    die;
  } else {
    $_SESSION['alert'] = 'Veuillez remplir tous les champs';
    header('Location: index.php?page=page/login');
    die;
  }