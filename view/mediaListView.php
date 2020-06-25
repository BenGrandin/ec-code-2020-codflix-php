<?php ob_start(); ?>
<script>
	// ToDo : #form - Prevent default onsubmit
	const onFormChange = () => {
		const {value: title} = document.getElementById('title');
		const {value: type} = document.getElementById('type');
		const {value: gender_id} = document.getElementById('gender_id');
		const {value: release_date} = document.getElementById('release_date');
		const {value: version} = document.getElementById('version');

		let queryParams = "";
		if (title.length) queryParams += `&title=${title}`;
		if (type.length) queryParams += `&type=${type}`;
		if (gender_id.length) queryParams += `&gender_id=${gender_id}`;
		if (release_date.length) queryParams += `&release_date=${release_date}`;
		if (release_date.length) queryParams += `&release_date=${release_date}`;
		if (version.length) queryParams += `&version=${version}`;
		const url = `index.php?action=mediaListDisplayer${queryParams}`;

		fetch(url)
			.then(data => data.text())
			.then(innerHTML => {
				const node = document.createElement("div");
				node.innerHTML = innerHTML;
				document.querySelector('.media-list').replaceWith(node);
			})
	};

</script>
<div class="row justify-content-center text-center">
    <input hidden id="version" value="<?= $action ?>"/>
    <h1 class="col"><?= $action === 'history' ? 'Mon historique' : 'Bienvenue !' ?></h1>
</div>

<hr class="d-sm-flex d-none w-75 my-3 my-md-5 bg-red">

<form method="get" id="form">
    <div class="form-group row has-btn justify-content-center bg-black py-4 flex-md-row flex-column ">
        <div class=" col-auto col-md-6 col-lg-4 my-2">
            <input type="search" id="title" name="title" value="<?= $title; ?>"
                   class="form-control"
                   placeholder="Titre">
        </div>

        <div class="col-auto  my-2">
            <select onchange="onFormChange();" class="custom-select mr-sm-2" id="type">
                <option value="" selected>Type</option>
                <option value="movie">Film</option>
                <option value="tvshow">Série</option>
            </select>
        </div>

        <div class="col-auto  my-2">
            <select onchange="onFormChange();" class="custom-select mr-sm-2" id="gender_id">
                <option value="" selected>Genre</option>
                <option value="1">Action</option>
                <option value="2">Horreur</option>
                <option value="3">Sci-Fi</option>
            </select>
        </div>

        <div class="col-auto  my-2">
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
<hr class=" d-sm-flex d-none w-75 my-3 my-md-5 bg-red">


<script>
	const titleDiv = document.getElementById('title');

	titleDiv.addEventListener("input", onFormChange);
</script>
<?php $content = ob_get_clean(); ?>

