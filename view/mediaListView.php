<?php ob_start(); ?>
<script>
	// ToDo : #form - Prevent default onsubmit
	const onFormChange = () => {
		const {value: title} = document.getElementById('title');
		const {value: type} = document.getElementById('type');
		const {value: gender_id} = document.getElementById('gender_id');
		const {value: release_date} = document.getElementById('release_date');

		let queryParams = "";
		if (title.length) queryParams += `&title=${title}`;
		if (type.length) queryParams += `&type=${type}`;
		if (gender_id.length) queryParams += `&gender_id=${gender_id}`;
		if (release_date.length) queryParams += `&release_date=${release_date}`;
		const url = `index.php?action=mediaListDisplayer${queryParams}`;

		fetch(url)
			.then(data => data.text())
			.then(innerHTML => {
				const node = document.createElement("div");
				node.innerHTML = innerHTML;
				document.querySelector('.media-list').replaceWith(node);
			})
	};
	const toto = () => {
		console.log("toto")
	}
</script>

<form method="get" id="form">
    <div class="form-group row has-btn">
        <div class="col-6 col-lg-4">
            <input onkeypress="onFormChange()" type="search" id="title" name="title" value="<?= $title; ?>"
                   class="form-control"
                   placeholder="Titre">
        </div>

        <div class="col-auto">
            <select onchange="onFormChange();" class="custom-select mr-sm-2" id="type">
                <option value="" selected>Type</option>
                <option value="movie">Film</option>
                <option value="tvshow">Série</option>
            </select>
        </div>

        <div class="col-auto">
            <select onchange="onFormChange();" class="custom-select mr-sm-2" id="gender_id">
                <option value="" selected>Genre</option>
                <option value="1">Action</option>
                <option value="2">Horreur</option>
                <option value="3">Sci-Fi</option>
            </select>
        </div>

        <div class="col-auto">
            <select onchange="onFormChange()" class="custom-select mr-sm-2" id="release_date">
                <option value="" selected>Année</option>
				<?php
					for ($i = date("Y"); $i > 1900; $i--) {
						echo "<option value='$i'>$i</option>";
					}
				?>

            </select>
        </div>
    </div>
</form>
<hr class="w-75 my-4">
<?php require('components/mediaListDisplayer.php') ?>


<?php $content = ob_get_clean(); ?>

