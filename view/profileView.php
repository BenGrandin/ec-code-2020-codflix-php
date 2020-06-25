<?php ob_start();	?>
<div class="profileView container">

    <div class="row justify-content-center">
        <div class="">
            <h1>Mon profil</h1>
        </div>
    </div>
    <div class="row justify-content-center mt-5">

		<?php if ($edit_mode) { ?>
            <form method="post" action="index.php?action=profile&edit_mode=1" class="custom-form">

                <div class="form-group">
                    <label for="email">Adresse email</label>
                    <input type="email" name="email" value="<?= $user['email'] ?>" id="email" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" id="password" class="form-control"/>
                </div>

                <div class="form-group">
                    <label for="new_password">Votre nouveau mot de passe</label>
                    <input type="password" name="new_password" id="new_password" class="form-control"/>
                </div>    <div class="form-group">
                    <label for="new_password_confirm">Confirmez votre nouveau mot de passe</label>
                    <input type="password" name="new_password_confirm" id="new_password_confirm" class="form-control"/>
                </div>

                <div class="form-group">
                    <div class="row">
                        <div class="col-md-6 col-md-6 mb-0 mb-sm-2">
                            <input type="submit" name="Valider" class="btn btn-block bg-red"/>
                        </div>
                        <div class="col-md-6">
                            <a href="index.php?action=profile" class="btn btn-block bg-blue">Retour</a>
                        </div>
                    </div>
                </div>

                <span class="error-msg">
              <?= isset($error_msg) ? $error_msg : ''; ?>
            </span>   <span class="text-success">
              <?= isset($success_msg) ? $success_msg : ''; ?>
            </span>
            </form>

			<?php
		} else {
			?>
            <div>

                <div class="">
                    <h4>Adresse email</h4>
                    <p id="email" class=""><?= $user['email'] ?></p>
                </div>

                <div class="">
                    <p id="email"
                       class=""><?= $user['emailVerified'] ? "Votre email est vérifié" : " Vous devez vérifier votre email" ?></p>
                </div>

                <div class="">
                    <a href="index.php?action=profile&edit_mode=1" class="btn btn-block bg-blue">Modifier son profil</a>
                </div>
            </div>

		<?php } ?>    </div>
</div>


</div>
<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
