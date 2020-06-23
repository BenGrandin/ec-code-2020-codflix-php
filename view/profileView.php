<?php ob_start(); ?>

<div class="row">
	<div class="col-md-4 offset-md-8">
		<form method="get">
			<div class="form-group has-btn">
				<input type="search" id="search" name="title" value="<?= $search; ?>" class="form-control"
				       placeholder="Rechercher un film ou une série">

				<button type="submit" class="btn btn-block bg-red">Valider</button>
			</div>
		</form>
	</div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
