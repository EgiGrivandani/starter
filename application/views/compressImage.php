<form id="imagePost" enctype="multipart/form-data">
	<input type="file" name="image">
	<button type="submit">upload</button>
</form>
<div id="response"></div>

<script>
	$(document).ready(function() {
		$('#imagePost').on('submit', function(e) {
			e.preventDefault(); // Mencegah form submit secara default

			// Ambil file dan form data
			var formData = new FormData(this);

			// Kirim data melalui AJAX
			$.ajax({
				url: '<?= base_url("Welcome/compressImage_Ajax") ?>', // Ganti dengan URL method CodeIgniter Anda
				type: 'POST',
				data: formData,
				processData: false,
				contentType: false,
				dataType: 'json',
				success: function(response) {
					// Tampilkan response dari server
					$('#response').html('<p>' + response.message + '</p>');
				},
				error: function(xhr, status, error) {
					// Tangani error
					$('#response').html('<p style="color:red;">Error: ' + error + '</p>');
				}
			});
		});
	});

</script>
