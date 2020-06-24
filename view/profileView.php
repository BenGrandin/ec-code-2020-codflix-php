<?php ob_start(); ?>

<div class="profileView container">

    <div class="row">
        <div class="">
	        <h1>Mon profil</h1>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
