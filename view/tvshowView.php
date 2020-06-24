<?php ob_start(); ?>

<div class="row flex-column">
    <div class="col ">

        <h1 class="title text-center"> <?= $media['title']; ?> </h1>
    </div>
    <div class="col mt-3">
        <div class="row">
            <div class="col">
                <div class="genre_id card-subtitle">
                    <span class="type"><?= $media['type']; ?></span> : <?= $media['genre_id']; ?>

                </div>
            </div>

            <div class="col text-right">
                <div class="release_date">
                    <span class="status"><?= $media['status']; ?> le </span> : <?= $media['release_date']; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col mt-4 text-justify">
        <div class="summary"> <?= $media['summary']; ?> </div>
    </div>
    <div class="col justify-content-center mt-5 ">
        <iframe class="trailer_url w-100" style="height: 70vh!important;" allowfullscreen frameborder="0"
                src="<?= $media['trailer_url']; ?>"></iframe>
    </div>
</div>
<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
