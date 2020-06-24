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

<div class="media-list">
	<?php foreach ($medias as $media): ?>
        <a class="item <?= $media['type']; ?>" href="index.php?action=<?= $media['type']; ?>&id=<?= $media['id']; ?>">
            <div class="video">
                <div>
                    <iframe allowfullscreen="" frameborder="0"
                            src="<?= $media['trailer_url']; ?>"></iframe>
                </div>
            </div>
            <div class="title d-flex flex-column ">
                <div>
					<?= $media['title']; ?>
                </div>
                <span class="type badge badge-secondary m-1">
					<?php
						if ($media['type'] === "movie") $media['type'] = "Film";
						if ($media['type'] === "tvshow") $media['type'] = "Série";
						echo $media['type']; ?>
                    </span></div>
            <div class="summary">
				<?= $media['summary']; ?>
            </div>
        </a>
	<?php endforeach; ?>
</div>


<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
