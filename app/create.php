<?php
  if (isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $email = $_POST['email'];

// Error
    $errors = [];

    if (empty($username) || strlen($username) < 4 || strlen($username) > 20) {
      $errors[] = 'Le nom d\'utilisateur doit avoir entre 4 et 20 caractères.';
    }

    if (empty($password) || strlen($password) < 6) {
      $errors[] = 'Le mot de passe doit avoir au moins 6 caractères.';
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = 'L\'adresse email n\'est pas valide.';
    }

// Vérification de l'existence de l'utilisateur ou de l'adresse email
    if (empty($errors)) {
      if (userExists('username', $username)) {
        $_SESSION['alert'] = 'Le nom d\'utilisateur existe déjà !';
        $_SESSION['alert-color'] = 'danger';
        header('Location: index.php?page=page/create');
        die();
      }

      if (userExists('email', $email)) {
        $_SESSION['alert'] = 'L\'adresse email existe déjà !';
        $_SESSION['alert-color'] = 'danger';
        header('Location: index.php?page=page/create');
        die();
      }
    }

// Vérification de l'extension de l'image
    if (!empty($_FILES['photo']['name'])) {
      $imageExtensions = IMG_EXT;
      $uploadedImage = $_FILES['photo']['tmp_name'];
      $extension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

      if (!in_array($extension, $imageExtensions)) {
        $errors[] = 'L\'extension de fichier n\'est pas autorisée. Les extensions autorisées sont : ' . implode(', ', $imageExtensions);
      } elseif (!getimagesize($uploadedImage)) {
        $errors[] = 'Le fichier téléchargé n\'est pas une image valide.';
      }
    }


//check admin
    $connect = connect();

    $countQuery = $connect->prepare("SELECT COUNT(*) FROM user");
    $countQuery->execute();
    $userCount = $countQuery->fetchColumn();

    $isAdmin = ($userCount === 0) ? 1 : null;


    // Tout ok, on crée tout le bouzin

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $insert = $connect->prepare("INSERT INTO user (username, password, email, created, admin) VALUES (?, ?, ?, NOW(), ?)");
    $insert->execute([$username, $hashedPassword, $email, $isAdmin]);

    if ($insert->rowCount()) {
      // Création du sous-dossier pour l'image de profil
      $userid = $connect->lastInsertId(); // Récupérer l'ID de l'utilisateur nouvellement inséré
      $userDirectory = 'img/' . $userid;

      if (!file_exists($userDirectory)) {
        //Tips: du 22/06 jms 0777
        mkdir($userDirectory, 0755, true);
      }

      if (!empty($_FILES['photo']['name'])) {
        $newImagePath = $userDirectory . '/profil.' . $extension;
        if (move_uploaded_file($uploadedImage, $newImagePath)) {
          $updateImage = $connect->prepare("UPDATE user SET image = ? WHERE id = ?");
          $updateImage->execute([$newImagePath, $userid]);
        } else {
          $errors[] = 'Erreur lors du téléchargement de l\'image.';
        }
      }

// Affichage des erreurs
      if (!empty($errors)) {
        $_SESSION['alert'] = implode('<br>', $errors);
        $url = 'index.php?page=page/create';
        header('Location: ' . $url);
        die();
      }

      $_SESSION['alert'] = 'Utilisateur ' . $username . ' a été créé avec succès.';
      $_SESSION['alert-color'] = 'success';
      $url = 'index.php?page=page/profil';
      header('Location: ' . $url);
      die();
    } else {
      $_SESSION['alert'] = 'Erreur lors de la création de l\'utilisateur.';
      $url = 'index.php?page=page/create';
      header('Location: ' . $url);
      die();
    }
  }