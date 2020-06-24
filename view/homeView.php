<?php ob_start(); ?>

<div id="home">
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="title">Cod<span>'Flix</span></h1>
                    <p>
                        <strong>Bienvenue</strong>
                    </p>
                </div>
            </div>

            <div class="row btn-container flex-column">
                <div class="col mb-5"><a href="index.php?action=login" class="  btn btn-block bg-red">Connexion</a></div>
                    <div class="col mb-5"><a href="index.php?action=signup" class=" btn btn-block bg-red">Inscription</a></div>
                <div class="col mb-5"><a href="index.php?action=contact" class=" btn btn-block bg-blue">Contact</a></div>
            </div>

        </div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require('base.php'); ?>
