<?php ob_start();

?>
<div class="tvshowView">

	<?php require('components/mediaDisplayer.php'); ?>

    <div class="row mt-4 mb-4">
        <div class="col">
            <h2>Liste des épisodes</h2>
        </div>
    </div>

    <!--    ToDo : Separate Episode by Season-->
	<?php require('components/mediaListDisplayer.php'); ?>

</div>
<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
