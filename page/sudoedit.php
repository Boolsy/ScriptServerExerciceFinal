<div class="container">
    <h1>Modifier l'utilisateur</h1>

  <?php
    // Vérifier  l'ID
    if (!isset($_GET['id'])) {
    echo '<div class="alert alert-danger">ID utilisateur manquant.</div>';
  } else {
    $userId = $_GET['id'];

    // Récupérer les informations de l'utilisateur
    $connect = connect();
    $select = $connect->prepare('SELECT * FROM user WHERE id = ?');
    $select->execute([$userId]);
    $user = $select->fetch(PDO::FETCH_OBJ);

    if (!$user) {
    echo '<div class="alert alert-danger">Utilisateur introuvable.</div>';
  } else {
  ?>
    <div class="table-container">
        <div class="card p-3">
            <form action="app/sudoedit.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $user->id; ?>">

                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" class="form-control" id="username" name="username"
                           value="<?php echo $user->username; ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user->email; ?>"
                           required>
                </div>

                <div class="form-group">
                    <label for="admin">Administrateur</label>
                    <select class="form-control" id="admin" name="admin">
                        <option value="0" <?php echo ($user->admin == null) ? 'selected' : ''; ?>>Non</option>
                        <option value="1" <?php echo ($user->admin == 1) ? 'selected' : ''; ?>>Oui</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            </form>
        </div>
      <?php
        }
        }
      ?>

    </div>
</div>