<div class="media-list justify-content-center">

	<?php foreach ($medias as $media):
		$id = $media['id'];
		$type = $media['type'];
		$action = "movie";
		$is_episode = isset($media['show_id']);

		if ($type === 'tvshow' && !$is_episode) $action = 'tvshow';
		?>

        <div class="media-list-container">

            <a class="item <?= $type; ?>"
               href="index.php?action=<?= $action ?>&id=<?= $id ?>&is_episode=<?= $is_episode ?>"
            >

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
					<?php if ($_GET['action'] !== 'tvshow') { ?>

                        <span class="type badge badge-secondary m-1">
					<?php
						if ($media['type'] === "movie") $media['type'] = "Film";
						if ($media['type'] === "tvshow") $media['type'] = "Série";
						echo $media['type']; ?>
                    </span>
					<?php } ?>
                </div>
                <div class="summary">
					<?= $media['summary']; ?>
                </div>
            </a>
			<?php if ($_GET['action'] === 'history') { ?>
                <button value="<?= $media['id'] ?>" class="button-delete rounded p-1 m-1 mr-1">
                    Supprimer
                </button>
			<?php } ?>
        </div>

	<?php endforeach; ?>


</div>


<script>

	const buttonsDelete = [...document.getElementsByClassName('button-delete')];
	console.log("buttonsDelete:", buttonsDelete[0]);
	for (const btn of buttonsDelete) {

		btn.addEventListener("click", ({target}) => {
			const {value} = target;
			const url = "index.php?action=history&history_id=" + 2;
			console.log(url);

			// Value is actually false because i get the id of the media
			//  and not the id of history
			fetch(url);
		})
		console.log(btn)
	}
</script>