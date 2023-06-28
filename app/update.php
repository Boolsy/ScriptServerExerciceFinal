<?php
  $user = getUser('id', $_SESSION['id']);

  if ($user->email === $_POST['email'] && $user->password === $_POST['password']) {
    $_SESSION['alert'] = 'Les valeurs sont identiques. Aucune modification n\'a été effectuée.';
    $_SESSION['alert-color'] = 'warning';
  } else {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $id = $_SESSION['id'];

// Vérification de l'existence de l'email pour un autre utilisateur
    $existingUser = getUser('email', $email);

    if ($existingUser && $existingUser->id !== $_SESSION['id']) {
      $_SESSION['alert'] = 'L\'adresse email est déjà utilisée par un autre utilisateur.';
      $_SESSION['alert-color'] = 'danger';
      header('Location: index.php?page=page/update');
      exit;
    } else {
      $password = $_POST['password'];
      $confirmPassword = $_POST['confirm_password'];

      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['alert'] = 'Veuillez saisir une adresse e-mail valide.';
        $_SESSION['alert-color'] = 'danger';
        header('Location: index.php?page=page/update');
        exit;
      } elseif ($password !== $confirmPassword) {
        $_SESSION['alert'] = 'Les mots de passe ne correspondent pas.';
        $_SESSION['alert-color'] = 'danger';
        header('Location: index.php?page=page/update');
        exit;
      } else {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


        $connect = connect();
        $update = $connect->prepare("UPDATE user SET email=?, password=? WHERE id=?");
        $update->execute([$email, $hashedPassword, $id]);

        if ($update->rowCount()) {
          $_SESSION['alert'] = 'Modification réussie';
          $_SESSION['alert-color'] = 'success';
        } else {
          $_SESSION['alert'] = 'Modification échouée';
          $_SESSION['alert-color'] = 'danger';
        }


        if ($_FILES['image']['error'] === UPLOAD_ERR_OK) {
          // Vérifier l'extension
          $extension = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

          if (!in_array($extension, IMG_EXT)) {
            $_SESSION['alert'] = 'Extension de fichier non autorisée. Veuillez sélectionner une image au format PNG, JPG ou JPEG.';
            $_SESSION['alert-color'] = 'danger';
            header('Location: index.php?page=page/profil');
            exit;
          }

          // Supprimer l'image
          $oldImagePath = $user->image;
          if (!empty($oldImagePath)) {
            unlink($oldImagePath);
          }

          $newImageName = $id . '.' . $extension;

          $destinationFolder = 'img/' . $id . '/';

          if (!file_exists($destinationFolder)) {
            mkdir($destinationFolder, 0755, true);
          }

          $newImagePath = $destinationFolder . $newImageName;

          move_uploaded_file($_FILES['image']['tmp_name'], $newImagePath);

          $updateImage = $connect->prepare("UPDATE user SET image=? WHERE id=?");
          $updateImage->execute([$newImagePath, $id]);


          if ($update->rowCount()) {
            $_SESSION['alert'] = 'Modification réussie';
            $_SESSION['alert-color'] = 'success';
          } else {
            $_SESSION['alert'] = 'Modification échouée';
            $_SESSION['alert-color'] = 'danger';
          }
        }
      }

// Redirection vers la page de profil
      header('Location: index.php?page=page/profil');
      exit;
    }
  }
