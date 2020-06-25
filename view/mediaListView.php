<?php ob_start(); ?>

<form method="get">
    <div class="form-group row has-btn">
        <div class="col-6 col-lg-4">
            <input type="search" id="search" name="title" value="<?= $search; ?>" class="form-control"
                   placeholder="Titre">
        </div>

        <div class="col-auto">
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                <option selected>Type</option>
                <option value="1">Film</option>
                <option value="2">Série</option>
            </select>
        </div>

        <div class="col-auto">
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                <option selected>Genre</option>
                <option value="1">Action</option>
                <option value="2">Horreur</option>
                <option value="3">Sci-Fi</option>
            </select>
        </div>

        <div class="col-auto">
            <select class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                <option selected>Année</option>
				<?php
					for ($i = date("Y"); $i > 1900; $i--) {
						echo "<option value='$i'>$i</option>";
					}
				?>

            </select>
        </div>
        <!--                <button type="submit" class="btn btn-block bg-red">Valider</button>-->
    </div>
</form>
<hr  class="w-75 my-4">
<?php require('components/mediaListDisplayer.php') ?>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
