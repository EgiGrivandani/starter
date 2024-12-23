<table id="dataTable">
	<thead>
	<tr>
		<th>Tanggal</th>
		<th>Tipe</th>
		<th>Jumlah</th>
		<th>Deskripsi</th>
		<th>Penanggung jawab</th>
		<th>Aksi</th>
	</tr>
	</thead>
	<tbody>

	</tbody>
</table>


<script>
	let table;
	let option = 'this_month';
	let startDate = '';
	let endDate = '';
	function callDT(){
		table = $('#dataTable').DataTable({
			responsive: false,
			autoWidth: false,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": base_url + 'Mainpage/history_ajax',
				"type": "POST",
				data:{
					option: option,
					startDate: startDate,
					endDate: endDate,
				}
			},
			columnDefs: [{
				"targets": "_all",
				orderable: false
			},
				{
					"targets": 0,
					"className": "text-start"
				}]
		})
	}

	$(document).ready(function() {
		callDT();

		//untuk filter, sesuaikan kondisinya
		$('#filterSelect').on('change', function () {
			let selectedValue = $(this).val();

			option = selectedValue;
			if (selectedValue === 'custom') {
				$('#customDateModal').modal('show');
			}else{
				table.destroy();
				callDT();
			}
		})


		//sesuaikan kondisinya
		$('#applyCustomDate').on('click', function () {
			startDate = $('#startDate').val();
			endDate = $('#endDate').val();

			if (!startDate || !endDate) {
				showSwalMessage('error', 'harap isi tanggal', 'error');
				return;
			}
			$('#customDateModal').modal('hide');
			table.destroy();
			callDT();
		});
	});
</script>
