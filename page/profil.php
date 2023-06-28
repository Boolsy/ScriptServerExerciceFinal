<?php

  if (empty($_SESSION['id'])) {
    $_SESSION['alert'] = 'Vous devez vous connecter pour accéder à votre espace personnel';
    $_SESSION['alert-color'] = 'warning';
    $url = 'index.php?page=page/login';
    header('Location: ' . $url);
    exit;
  }
  $user = getUser('id', $_SESSION['id']);
?>

<div class="container">
    <div class="main-body">
        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="<?php echo $user->image; ?>" alt="Admin" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4><?php echo ucfirst($user->username) ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Username</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                              <?php echo $user->username ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                              <?php echo $user->email ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Date de création du compte</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                              <?php echo DateTime::createFromFormat('Y-m-d H:i:s', $user->created)->format('d/m/Y H:i:s') ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Dernière connexion</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                              <?php echo DateTime::createFromFormat('Y-m-d H:i:s', $user->lastlogin)->format('d/m/Y H:i:s') ?>
                            </div>

                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Droit administrateur</h6>
                            </div>
                            <div class="col-sm-9 text-secondary">
                              <?php echo $_SESSION['admin'] ?>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <a class="btn btn-info " href="index.php?page=page/update">Edit</a>
                            </div>
                            <div class="col-sm-6">
                                <a class="btn btn-info " href="app/export.php">Export Json</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>