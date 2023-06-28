<?php
  if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== 'Oui') {
    $_SESSION['alert'] = 'Vous n\'avez pas les droits pour accéder à cette page';
    header('Location: /index.php?');
    exit();
  }

  // Afficher tous les utilisateurs de la base de données
  $connect = connect();
  $select = $connect->prepare('SELECT * FROM user');
  $select->execute();
  $result = $select->fetchAll(PDO::FETCH_OBJ);

  if ($result) {
    echo '<div class="table-container">';
    echo '<table class="table table-striped">';
    echo '<tr>';
    echo '<th>Id</th>';
    echo '<th>Username</th>';
    echo '<th>Email</th>';
    echo '<th>Admin</th>';
    echo '<th>Créé le</th>';
    echo '<th>Dernière connexion</th>';
    echo '<th>Actions</th>';
    echo '</tr>';

    foreach ($result as $row) {
      echo '<tr>';
      echo '<td>' . $row->id . '</td>';
      echo '<td>' . $row->username . '</td>';
      echo '<td>' . $row->email . '</td>';
      echo '<td>' . ($row->admin == 1 ? 'Oui' : 'Non') . '</td>';
      echo '<td>' . (new DateTime($row->created))->format('d/m/Y H:i') . '</td>';
      echo '<td>' . (new DateTime($row->lastlogin))->format('d/m/Y H:i') . '</td>';

      if ($row->admin == 1) {
        echo '<td><a href="index.php?page=page/sudoedit&id=' . $row->id . '">Modifier</a> | ';
        echo 'Indisponible</td>';
      } else {
        echo '<td><a href="index.php?page=page/sudoedit&id=' . $row->id . '">Modifier</a> | ';
        echo ($row->admin == 0) ? '<a href="index.php?page=app/sudo&id=' . $row->id . '" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer cet utilisateur ?\')">Supprimer</a>' : 'Supprimer</a>';
        echo '</td>';
      }

      echo '</tr>';
    }

    echo '</table>';
    echo '</div>';


  } else {
    echo '<div class="alert alert-danger">Aucun utilisateur trouvé.</div>';
  }
?>