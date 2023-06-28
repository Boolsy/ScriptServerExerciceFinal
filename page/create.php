<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="card p-3">
                <h5 class="text-center">Créer un compte</h5>
                <form action="index.php?page=app/create" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="login">Login</label>
                        <input type="text" class="form-control" id="login" name="username">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Mot de passe</label>
                        <input type="password" class="form-control" id="pwd" name="password">
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo de profil</label>
                        <input type="file" class="form-control-file" id="photo" name="photo"
                               accept="image/jpeg,image/png">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary btn-block">Créer un compte</button>
                    </div>
                </form>
                <p class="text-center">Déjà un compte ? <a href="index.php?page=app/login">Se connecter</a></p>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
