<?php
  $user = getUser('id', $_SESSION['id']);
?>

<div class="container">
    <div class="main-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="<?php echo $user->image; ?>" alt="Admin" class="rounded-circle"
                                         width="110">
                                    <form action="index.php?page=app/update" method="POST"
                                          enctype="multipart/form-data">
                                        <input type="file" name="image" class="form-control-file mt-3">
                                </div>
                            </div>
                            <div class="col-lg-8">

                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        <input type="text" class="form-control" name="email"
                                               value="<?php echo $user->email; ?>">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Mot de passe</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4">
                                        <h6 class="mb-0">Confirmer le mot de passe</h6>
                                    </div>
                                    <div class="col-sm-8 text-secondary">
                                        <input type="password" class="form-control" name="confirm_password">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 text-center">
                                        <input type="hidden" id="uu-userid" name="id"
                                               value="<?php echo (int)$_SESSION['id']; ?>">
                                        <input type="submit" class="btn btn-primary px-4"
                                               value="Sauvegarder les modifications">
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
