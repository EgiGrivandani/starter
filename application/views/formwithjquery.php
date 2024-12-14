<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport"
			  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Form jquery</title>

		<!--	JQUERY-->
		<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

		<!--	SWEETALERT-->
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	</head>
	<body>

		<!--FORM WITH JUERY-->
		<form method="post" id="form">
			<input type="text" name="username">
			<input type="password" name="password">
			<button type="submit">save</button>
		</form>



		<script>
			<!--SWEETALERT-->
			function swalMssg(stat, mssg){
				Swal.fire({
					title: stat,
					html: mssg,
					icon: stat
				});
			}

			$(function() {
				let base = '<?= base_url()?>';
				$('#form').on('submit', function(event) {
					event.preventDefault(); // Mencegah form submit secara default

					// Ambil data form
					var formData = $(this).serialize();

					// Kirim data dengan AJAX
					$.ajax({
						url: base + 'Welcome/submitWithAjax', // lokasi controller nya
						type: 'POST',
						data: formData,
						dataType: 'json',  //menerima returrn json
						success: function(response) {
							console.log(response);
							//mengecek status response
							if(response.status){
								// menampilkan ke swal
								swalMssg('success', response.message)
							}else{
								swalMssg('error', response.message)
							}
						},
						error: function(xhr, status, error) {
							//handle kesalahan ajax
							swalMssg('error', 'terjadi kesalahan : '+error)
						}
					});
				});
			});
		</script>
	</body>
</html>
