<div class="media-list">

	<?php

		foreach ($medias as $media):
			$id = $media['id'];
			$type = $media['type'];
			$action = "movie";
			$is_episode = isset($media['show_id']);

			if ($type === 'tvshow' && !$is_episode) $action = 'tvshow';
			?>
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
		<?php endforeach; ?>
</div>
