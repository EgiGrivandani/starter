<div style="margin-bottom: 30px;">
	<label>Categories</label>
	<select name="categories" id="categories">
		<option value="" selected disabled>-select categories-</option>
		<?php foreach ($ctg as $row): ?>
			<option value="<?=$row['id_kategori']?>"><?=$row['name_kategori']?></option>
		<?php endforeach;?>
	</select>
</div>

<div>
	<label>Account</label>
	<select name="account" id="account">
		<!--ini default nya biarkan kosong, karna datanya dinamis sesuai option categories-->
		<option value="" selected disabled>-select account-</option>
	</select>
</div>


<script>
	let base = '<?= base_url()?>';
	let accID = ''; //dipakai untuk edit
	$(document).ready(function() {
		// Ketika categories berubah
		$('#categories').on('change', function() {
			const categoryId = $(this).val(); // Ambil nilai kategori yang dipilih
			const accountSelect = $('#account');

			// Kosongkan dropdown account
			accountSelect.html('<option value="" selected disabled>-select account-</option>');

			if (categoryId) {
				getAccount(categoryId)

			}
		});
	});

	function getAccount(categoryId){
		$.ajax({
			url: base + 'Welcome/option_acc',
			type: 'POST',
			data: { category_id: categoryId }, // Kirim parameter category_id
			dataType: 'json',
			success: function(response) {
				if(response.status){
					const accountSelect = $('#account');
					// Isi dropdown account dengan data yang diterima
					$.each(response.data, function(index, account) {

						accountSelect.append(`<option value="${account.id_code}">${account.code} - ${account.name_code}</option>`);

						//ini nanti dipakai untuk edit
						// const selected = accID == account.id_code ? 'selected' : '';
						// accountSelect.append(`<option value="${account.id_code}" ${selected}>${account.code} - ${account.name_code}</option>`);

					});
				}else{
					console.log('gagal');
				}

			},
			error: function(xhr, status, error) {
				console.error('Error:', error);
			}
		});
	}
</script>
